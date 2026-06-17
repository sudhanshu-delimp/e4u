<?php

namespace App\Http\Controllers\Center\Masseurs;

use Exception;
use App\Models\Masseur;
use App\Models\MasseurRate;
use App\Models\MassageMedia;
use Illuminate\Http\Request;
use App\Models\MasseurGallery;
use App\Models\MassagerMasseur;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Duration\MassageDurationInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Message\MasseurMediaInterface;
use App\Repositories\Message\MessageMediaInterface;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Http\Requests\Escort\StoreGalleryMediaRequest;
use App\Models\MasseurMedia;
use App\Models\MasseurVerification;
use App\Models\MediaVerification;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;

class MasseurController extends AppController
{


    protected $escort;
   
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_media;
    protected $massage_profile;
  
    
    public function __construct(MassageProfileInterface $massage_profile, MessageInterface $escort, MasseurMediaInterface $media, ServiceInterface $service, MassageDurationInterface $duration)
    {
        $this->escort = $escort;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
    
    }


    public function validate_phone(Request $request)
    {
        if($request->form_type=='add')
        {
            $exist =  Masseur::where(['user_id' => auth()->user()->id,'mobile' => $request->phone])->exists();
            if($exist)
            return response()->json(['valid'   => false,'message'=> 'Mobile number already exists']);
            else
            return response()->json(['valid'   => true,'message'=> 'mobile number not found']);
                
        }

        if($request->form_type=='edit')
        {
            $exist =  Masseur::where('id', '!=', $request->masseur_id)
                                ->where('user_id',  '=',  auth()->user()->id)
                                ->where('mobile',   '=',   $request->phone)
                                ->exists();
            if($exist)
            return response()->json(['valid'   => false,'message'=> 'Mobile number already exists']);
            else
            return response()->json(['valid'   => true,'message'=> 'mobile number not found']);
                
        }
         
    }   

    public function make_masseur_availability($request_data)
    {

        $time = $request_data['time'] ?? [];
        $availability = $request_data['availability_time'] ?? [];

        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

        $result = [];

        foreach ($days as $day) {

            $status = $availability[$day] ?? 'closed';

            $from = $time[$day]['hh_from'] ?? null;
            $to   = $time[$day]['hh_to'] ?? null;


            if ($status === 'closed') {
                $from = null;
                $to   = null;
            }

            if ($status === 'til_late') {
                $to = null;
            }

            if ($status === 'custom') {
                $from = $from ?: null;
                $to   = $to ?: null;
            }

            $result[$day] = [
                'status' => $status,
                'from'   => $from,
                'to'     => $to,
            ];
        }

        return $result;
    }


    public function makeAvailability($request_data)
    {
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $availability = [];

        foreach ($days as $day) {

            $status = $request_data['availability_time'][$day] ?? 'closed';

            if ($status === 'closed') {
                $availability[$day] = [
                    'status' => 'closed',
                    'from' => null,
                    'to' => null,
                ];
                continue;
            }

            if ($status === '24_hours') {
                $availability[$day] = [
                    'status' => '24_hours',
                    'from' => '12:00 AM',
                    'to' => '11:59 PM',
                ];
                continue;
            }

            // custom / til_late
            $from = null;
            $to   = null;

            if (!empty($request_data['time'][$day]['hh_from']) &&
                !empty($request_data['time'][$day]['ampm_from'])) {
                $from = $request_data['time'][$day]['hh_from'].' '.$request_data['time'][$day]['ampm_from'];
            }

            if (!empty($request_data['time'][$day]['hh_to']) &&
                !empty($request_data['time'][$day]['ampm_to'])) {
                $to = $request_data['time'][$day]['hh_to'].' '.$request_data['time'][$day]['ampm_to'];
            }

            $availability[$day] = [
                'status' => $status,
                'from' => $from,
                'to' => $to,
            ];
        }

        return $availability;
    }


    public function index(Request $request)
    {
        $page_token = bin2hex(random_bytes(32));
        $durations = $this->duration->all();
        $user = auth()->user();

        ########## default profile data ############
        $massage_default = $this->massage_profile->findDefault($user->id,1);
        if(!$massage_default ) {
            $massage_default = $this->massage_profile->make();
        }
        $massage_durations = (isset($massage_default->durations) && count($massage_default->durations)>0) ? $massage_default->durations->toArray() : [];
        ########## End default profile data ########

        $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
        // $path = $this->media;
        // $defaultImages = $this->media->findDefaultMedia($user->id, 0);
        // //$escortDefault = $this->escort->findDefault(auth()->user()->id, 1);

        $availability = $massage_default->availability ? json_decode($massage_default->availability->availability_time, true) : [];
        $default_duration = find_massage_default_duration($user->id);

       //dd($availability );

      
  
        return view('center.dashboard.masseurs.add-masseurs',compact('durations','massage_durations','massage_default','page_token','media','default_duration','availability'));
    }


    public function count_default_masseur($user_id)
    {
       return  Masseur::where(['user_id'=>$user_id,'is_default'=>'1'])->count();
    }



    public function add_masseur(Request $request)
    {

        try 
        {

            DB::beginTransaction();
            $user = auth()->user();
            $request_data = $request->all();

            // Log::info('$request_data');
            // Log::info($request_data);

            if($request->redirect_page)
            $redirect_same_page = true ;
            else
            $redirect_same_page = false;     



            $availability     = $this->make_masseur_availability($request_data);
            $availabilityJson = json_encode($availability);

            // Log::info($availabilityJson);

            $make_defailt = false;
            $message = 'Profile created successfully';

            if(isset($request->make_default) && $request->make_default=='1')
            {
                $count = $this->count_default_masseur($user->id); 

                Log::info('count');
                Log::info($count);

                if($count<8) 
                {
                    $make_defailt = true;
                }
                else
                {
                    $message = 'You have reached the limit of 8 default Listings.<br>Profile created successfully.';
                }
                
            }

            /* ================== Masseur Profile ================== */
            $masseur = new Masseur();

            $masseur->user_id               = $user->id;
            $masseur->name                  = $request->filled('name') ? $request->name : null;
            $masseur->stage_name            = $request->filled('stage_name') ? $request->stage_name : null;
            $masseur->mobile                = $request->filled('mobile') ? $request->mobile : null;
           
            $masseur->nationality           = $request->filled('nationality') ? $request->nationality : null;

            $masseur->ethnicity             = $request->filled('ethnicity') ? $request->ethnicity : null;
            $masseur->age                   = $request->filled('age') ? $request->age : null;

            $masseur->vaccination           = $request->filled('vaccination') ? $request->vaccination : null;
            $masseur->commentary            = $request->filled('commentary') ? $request->commentary : null;

            $masseur->token_id              = $request->filled('page_token') ? $request->page_token : null;

            $masseur->availability          = $availabilityJson;

            $masseur->service = $request->filled('service') ? $request->service : [];
            $masseur->massage_service_types = $request->filled('massage_service_list') ? $request->massage_service_list : [];
            $masseur->other_service_types = $request->filled('massage_other_service_list') ? $request->massage_other_service_list : [];
            
            $masseur->is_default = $make_defailt ? '1' : '0';
            $masseur->created_by = $request->isImpersonated ? $request->impersonatedId : $user->id;
                        
            $masseur->save();
            $masseur_profile_id = $masseur->id;
            $member_id = generate_masseur_member_id($masseur_profile_id);
            
            $masseur->member_id   = ($member_id) ? $member_id : '';
            $masseur->save();

            
        
            /* ================== Rates ================== */
            if (!empty($request->duration_id)) {
                $rates = [];

                foreach ($request->duration_id as $key => $value) {
                    $rates[] = [
                        'massage_price'      => $request->massage_price[$key],
                        'incall_price'       => $request->incall_price[$key],
                        'outcall_price'      => $request->outcall_price[$key],
                        'duration_id'        => $value,
                        'masseur_profile_id' => $masseur_profile_id,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }

                MasseurRate::insert($rates);
            }

            // /* ================== Gallery (Images) ================== */
            if (!empty($request->position)) {
                foreach ($request->position as $position => $mediaId) {
                    if ($mediaId) {
                        MasseurGallery::create([

                            'masseur_token_id'   => $request->page_token,
                            'masseur_profile_id' => $masseur_profile_id,
                            'masseur_media_id'   => isMasseursGalleryTemplate($mediaId),
                            'position'           => $position,
                            'type'               => 0,
                        ]);
                    }
                }
            }

            if ($request->hasFile('verification_image')) {
                $this->mediaVerificationUpload(
                    $masseur_profile_id,
                    $request->file('verification_image'),
                    $request->verification_type
                );
            }
           

            DB::commit();

            return response()->json([
                'success'   => true,
                'message' => $message,
                'masseur_profile_id' => $masseur_profile_id,
                'redirect_same_page' => $redirect_same_page
            ]);

        } 
        catch (Exception $e) 
        {
            DB::rollBack();
            Log::error('Massage profile creation failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
        
    }


    public function uploadMasseurVerification(Request $request)
    {
        $request->validate([
            'masseur_profile_id' => 'required',
            'verification_image' => 'required|image'
        ]);

        $verification_type =  $request->verification_type;

        $result = $this->mediaVerificationUpload(
            $request->masseur_profile_id,
            $request->file('verification_image'),
            $verification_type
        );

        return response()->json($result);
    }

    public function mediaVerificationUpload($masseur_profile_id, $verification_image, $verification_type)
    {
        $user = auth()->user();

        // 🔹 Validation
        if (empty($verification_image)) {
            return [
                'success' => false,
                'message' => 'Please upload a verification image.'
            ];
        }

        // Upload image
        $fileName = time() . '_' . uniqid() . '.' . $verification_image->getClientOriginalExtension();
        $destination_path = $masseur_profile_id . '/verifications/' . $fileName;

        \Storage::disk('escorts')->put(
            $destination_path,
            file_get_contents($verification_image)
        );

        // Check existing pending verification
        $verification = MasseurVerification::where('user_id', $user->id)
         ->where('masseur_id', $masseur_profile_id)
            ->where('status', '0')
            ->first();

        if ($verification) {

            // Update existing
            $verification->update([
                'image_path' => $destination_path,
                'type' => $verification_type,
            ]);

        } else {

            // Create new
            $verification = MasseurVerification::create([
                'user_id'     => $user->id,
                'image_path'  => $destination_path,
                'masseur_id'  => $masseur_profile_id,
                'status'      => '0',
                'submited_by' => $masseur_profile_id,
                'type' => $verification_type,
            ]);
            $masseur_token_id = MasseurGallery::where('masseur_profile_id', $verification->masseur_id)->value('masseur_token_id'); 
              
            // Reset all media to pending
            MasseurMedia::where('user_id', $user->id)
                ->where('type', '0')
                ->whereNull('media_verification_id')
                ->where('masseur_token_id', $masseur_token_id)
                ->update([
                    'varified' => '0'
                ]);
        }

        return [
            'success' => true,
            'message' => "Verification uploaded successfully.\nPlease allow 24 hours for the verification to be completed."
        ];
    }

    public function edit_masseur(Request $request, $id)
    {
         if($request->isImpersonated && $id) {
           //$masseur = Masseur::where('id', $id)->where('created_by', $request->impersonatedId)->first();
           $masseur = Masseur::where('id',$id)->first(); 
           if(!$masseur){
             return redirect()->route('center.dashboard')->with('error', accessDeniedMsg());
           }

        } else {
           $masseur = Masseur::where('id',$id)->first(); 
        }
       
        if(!$masseur || !$id){
        return redirect()->route('center.create-new-masseur');
        }

        //$isMasseurUsed = MassagerMasseur::where('masseur_profile_id', $masseur->id)->exists();
        $masseur_availability = $masseur ? json_decode($masseur->availability, true) : [];
        
        $durations = $this->duration->all();
        $user = auth()->user();

        // $exists = DB::table('massager_masseurs')
        // ->where('masseur_profile_id', $id)
        // ->exists();
        $exists = false;

        $default_duration = find_massage_default_duration($user->id);

        ########## default profile data ############
        $massage_default = $this->massage_profile->findDefault($user->id,1);
        if(!$massage_default ) {
            $massage_default = $this->massage_profile->make();
        }
        $massage_durations = (isset($massage_default->durations) && count($massage_default->durations)>0) ? $massage_default->durations->toArray() : [];
        ########## End default profile data ########

        $media = $this->media->with_Or_withoutPosition(auth()->user()->id, $masseur->token_id,[]);
        $services = $masseur->service ?? [];
        $verification = MasseurVerification::where('masseur_id', $id)->where('status' , '0')->first();
        
        $imageUrl = $verification && $verification->image_path
            ? asset('escorts/' . $verification->image_path)
            : asset('assets/app/img/upload-media.png');
        
        $availability = $massage_default->availability ? json_decode($massage_default->availability->availability_time, true) : [];

        //dd($masseur_availability);

        return view('center.dashboard.masseurs.update-masseurs',compact('durations','massage_durations','availability','masseur_availability','masseur','media','services','default_duration','exists','imageUrl','massage_default','verification'));
    }

    public function update_masseur(Request $request)
    {

        
            /* ================== profile ================== */

                if($request->type=='profile')
                {
                    DB::beginTransaction();
                    try 
                    {
                        $user = auth()->user();
                        $request_data = $request->all();
                    
                        $masseur = Masseur::where(['id'=> $request->masseur_id])->first();

                        $masseur->name                  = $request->name;
                        $masseur->stage_name            = $request->stage_name;
                        $masseur->mobile                = $request->mobile;
                    
                        $masseur->nationality           = $request->nationality;

                        $masseur->ethnicity             = $request->ethnicity ;
                        $masseur->age                   = $request->age;

                        $masseur->vaccination           = $request->vaccination;
                        $masseur->commentary            = $request->commentary;
                        $masseur->updated_by = $request->isImpersonated ? $request->impersonatedId : $user->id;

                        $masseur->service = $request->filled('service') ? $request->service : [];

                    
                        $masseur->save();
                

                        DB::commit(); 
                        $message = "Updated Successfully."; 
                        $error = false;

                    } 
                    catch (Exception $e)
                    {
                        DB::rollBack();
                        $message = "Error occured while updating."; 
                        $error = true; 
                    }

                    return response()->json(compact('error','message'));
                }

            /* ================== End profile ================== */


            /* ================== media ================== */

                if($request->type=='media')
                {
                    DB::beginTransaction();
                    try 
                    {
                        $id = $request->masseur_id;
                        $user = auth()->user();
                        $media_arr = [];
                        $errors = "";
                        $successFlashMsg = $id ? 'Profile updated successfully' : 'Profile created successfully';
                        $galleryStorageFull = false;
                        $noOfFilesInGallery = $this->media->get_user_row(auth()->user()->id, [8, 10])->count();
                    
                        if($request->position){
                            foreach($request->position as $position=>$media_id){
                                if(!empty($media_id)){
                                    $media_arr[$position]  = [
                                        'masseur_token_id'   => $request->page_token,
                                        'masseur_profile_id' => $id,
                                        'masseur_media_id' => isMasseursGalleryTemplate($media_id),
                                        'position' => $position,
                                        'created_at' => date('Y-m-d H:i:s')
                                    ];
                                }
                            }
                        }

                        $escortImages = MasseurGallery::where(['masseur_profile_id'=>$id,'type'=>'0'])->get();
                        if($escortImages->count() > 0)
                        {
                            foreach ($escortImages as $escortImage) {
                                if (isset($media_arr[$escortImage->position])) {
                                    $escortImage->masseur_media_id = $media_arr[$escortImage->position]['masseur_media_id'];
                                    $escortImage->updated_at = date('Y-m-d H:i:s');
                                    $escortImage->save();
                                    unset($media_arr[$escortImage->position]);
                                }
                            }
                            if(count($media_arr) > 0){
                                MasseurGallery::insert($media_arr);
                            }
                        }
                        else
                        {
                            MasseurGallery::insert($media_arr);
                        }

                        DB::commit(); 
                        $message = "Updated Successfully."; 
                        $error = false;
                    } 
                    catch (Exception $e)
                    {
                        DB::rollBack();
                        $message = "Error occured while updating."; 
                        $error = true; 
                    }

                    return response()->json(compact('error','message'));
            
                }

            /* ================== End media ================== */




            /* ================== Aavailibility ================== */  
            
                if($request->type=='availibility')
                {
                        DB::beginTransaction();
                        try 
                        {
                            $user = auth()->user();
                            $request_data     = $request->all();
                            $availability     = $this->make_masseur_availability($request_data);
                            $availabilityJson = json_encode($availability);
                            $masseur = Masseur::where(['id'=> $request->masseur_id])->first();
                            $masseur->availability          = $availabilityJson;
                            $masseur->save();
                    
                            DB::commit(); 
                            $message = "Updated Successfully."; 
                            $error = false;

                        } 
                        catch (Exception $e)
                        {
                            DB::rollBack();
                            $message = "Error occured while updating."; 
                            $error = true; 
                        }

                        return response()->json(compact('error','message'));
                }

            /* ================== End Aavailibility ================== */ 

             /* ================== My Services ================== */  
            
                if($request->type=='my_services')
                {
                        DB::beginTransaction();
                        try 
                        {
                            $masseur = Masseur::where(['id'=> $request->masseur_id])->first();
                            $masseur->massage_service_types = $request->filled('massage_service_list') ? $request->massage_service_list : [];
                            $masseur->other_service_types = $request->filled('massage_other_service_list') ? $request->massage_other_service_list : [];
                            $masseur->save();
                            DB::commit(); 
                            $message = "Updated Successfully."; 
                            $error = false;

                        } 
                        catch (Exception $e)
                        {
                            DB::rollBack();
                            $message = "Error occured while updating."; 
                            $error = true; 
                        }

                        return response()->json(compact('error','message'));
                }

            /* ================== End Aavailibility ================== */ 




            /* ================== Rates ================== */

                if($request->type=='rates')
                {
                    DB::beginTransaction();
                    try 
                    {
                        if (!empty($request->duration_id)) 
                        {
                            $rates = [];

                            foreach ($request->duration_id as $key => $value) {
                                $rates[] = [
                                    'massage_price'      => $request->massage_price[$key],
                                    'incall_price'       => $request->incall_price[$key],
                                    'outcall_price'      => $request->outcall_price[$key],
                                    'duration_id'        => $value,
                                    'masseur_profile_id' => $request->masseur_id,
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                ];
                            }

                            if(!empty($rates))
                            MasseurRate::where(['masseur_profile_id' => $request->masseur_id])->delete();  
                            MasseurRate::insert($rates);
                        }

                        DB::commit(); 
                        $message = "Updated Successfully."; 
                        $error = false;
                    } 
                    catch (Exception $e)
                    {
                        DB::rollBack();
                        $message = "Error occured while updating."; 
                        $error = true; 
                    }

                    return response()->json(compact('error','message'));
            
                }

            /* ================== End Rates ================== */

    }
    
    public function masseur_list(Request $request)
    {

        
        return view('center.dashboard.masseurs.archives-listing');
    }



    public function uploadGallery(StoreGalleryMediaRequest $request)
    {
        try 
        {
        $userId = auth()->user()->id;
        $response['status'] = '';
        $prefix = 'images/';
        $type = 0;
        $file_path = $prefix.$userId;
        $page_token = $request->page_token;

      
        if($request->hasFile('img'))
        {
            if ($request->hasFile('img')) {
                foreach($request->file('img') as $key => $image){
                    $encryptedFileName = $this->_generateUniqueFilename($image->getClientOriginalName());
                    $destination_path = $file_path.'/gallery_'.$encryptedFileName;
                    $manager = new ImageManager(new GdDriver());
                    $extension = strtolower($image->getClientOriginalExtension());
                    $orgImage = $manager->read($image->getPathname());
                    Storage::disk('escorts')->put($destination_path, file_get_contents($image));
                    if(!$media = $this->media->findByPath('escorts/'.$destination_path)) {
                    $data = [
                    'user_id' => $userId,
                    'type' => $type,
                    'masseur_token_id' => $page_token,
                    'path' => 'escorts/'.$destination_path,
                    ];
                    $response['status'] = 200;
                    $media = $this->media->store($data);
                    }
                    else {
                        $response['status'] = 200;
                    }
                }
            }
        }
        } 
        catch (Exception $e) {

            Log::info(json_decode($e->getMessage(),true));

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json($response);
    }




    public function getAccountMediaGallery(Request $request, $category=null,$page_token, $status = null)
    {
        try {
            $media = $this->media->with_Or_withoutPosition(auth()->user()->id,$page_token, []);
          
            $statusMap = [
                'all'   => ['0','1','2'],
                'verified'   => ['1'],
                'unverified' => ['0','2'],
            ];
            $status = $statusMap[$status] ?? null;
            $mediaCategory = match ($category) {
                'gallery' => $media->whereNotIn('position',[9,10]),
                'banner'  => $media->whereIn('position',[9])->where('template','0'),
                'pinup'   => $media->whereIn('position',[10]),
            };
            if ($status !== null) {
                $mediaCategory = $mediaCategory->whereIn('varified', $status);
            }
            $path = $this->media;
            $response = [];
            $response['success'] = true;
            $response['category'] = $category;
            $currentStatus =  $request->status ?? 'all';
            $response['gallery_container_html'] = view('center.masseur.media_gallery_container',compact('mediaCategory','media','path','category','currentStatus'))->render();
            $response['gallery_modal_container_html'] = view('center.masseur.gallery_modal_container',compact('media','path'))->render();
            //$response['banner_modal_container_html'] = view('escort.dashboard.profile.partials.banner_modal_container',compact('media','path'))->render();
            
            // if(auth()->user()->type!='4')
            // $response['pinup_modal_container_html'] = view('escort.dashboard.profile.partials.pinup_modal_container',compact('media','path'))->render();
            
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function ImagesDelete(Request $request, $id)
    {

        $error = false;
        $this->media->nullPosition(auth()->user()->id,$request->position);
        if($media = $this->media->find($id)) {
            @unlink(Storage::disk('escorts')->path("../".$media->path));
            $media->delete();
            $error = true;
        }
        return response()->json(compact('error'));
    }

    public function defaultImages(Request $request)
    {
        $error = false;
        $msg = '';

        $media = $this->media->find($request->meidaId);

        
        $labels = [
            9 => 'Banner',
            10 => 'Pin Up',
        ];
        $repositoryName = array_key_exists($request->position,$labels)?$labels[$request->position]:'Gallery';
        if((in_array($request->position,[9,10]) && $request->position != $media->position) || ($request->position < 9 && in_array($media->position,[9,10]))) {
            $msg = "The photo you selected is not a {$repositoryName} image.  Please select a {$repositoryName} image from your repository.";
        } 
        else if(!in_array($media->position,[9,10]) && !empty($media->default)){
            $msg = "The photo you selected is already set as the default. Please select a {$repositoryName} image from your repository.";
        }
        else 
        {
            $this->media->nullPosition(auth()->user()->id, $request->position);

            if($media->template)
            MassageMedia::where(['template'=>'1','user_id'=>auth()->user()->id])->delete();

            if($media->template){
                $copy = $media->replicate();
                $copy->user_id = auth()->user()->id;
                $copy->default = 1;
                $copy->save();
            }
            else
            {
                $media->position = $request->position;
                $media->default = 1;
                $media->save();
            }
            $error = true;
        }
        return response()->json(compact('error','msg'));
    }


    public function  get_load_default_masseur_list(Request $request)
    {

            $massageTime = $request->availability; 
            $masseurProfileIds = $request->selectedList;
            $masseurLists = Masseur::where(['user_id' => auth()->user()->id,'status'=>'1','is_default'=>'1']);
            
            if(!empty($masseurProfileIds))
            $masseurLists = $masseurLists->whereNotIn('id', $masseurProfileIds);    

            $masseurLists = $masseurLists->get();
            $countries = getCountryList();

        
             $data = $masseurLists->map(function ($row) use ($countries) {

               $avail_arr  = $row->availability ? json_decode($row->availability, true) : [];
               $avail_list = $this->weeklyAvailibility($avail_arr);

               $default_profile = "";
               if($row->is_default =='1')
                $default_profile = '<span class="profile_icon_box">
            <sup class="text-muted superfix">D</sup>
            <span class="profile_icon_item">Default Masseur in Profile</span>
            </span>';
            

                return [
                   
                    'id' => $row->id,
                    'member_id' => $row->member_id,
                    'checkbox' => '<input type="checkbox" class="select-masseur" value="'.$row->id.'">',
                    
                    'profile' => '<img src="'.asset('assets/dashboard/img/avatar.png').'" class="custompopicon"><span class="list_profile_name">'.$row->name.$default_profile.'</span>',

                    'days' => $avail_list,

                    'ethnicity' => config('escorts.profile.ethnicities')[$row->ethnicity] ?? 'NA',

                    'nationality' => $countries[$row->nationality] ?? 'NA',
                    'action' => '<button type="button" class="btn-cancel-modal py-1 btn-sm remove-row">Remove</button>'
                    

                ];
            });  

            return response()->json([
                'data' => $data
            ]);
           
    }

    public function  masseur_option_list(Request $request)
    {

            $massageTime = $request->availability; 
            $masseurProfileIds = $request->selectedList;
            $masseurLists = Masseur::where(['user_id' => auth()->user()->id,'status'=>'1']);
            
            if(!empty($masseurProfileIds))
            $masseurLists = $masseurLists->whereNotIn('id', $masseurProfileIds);    

            $masseurLists = $masseurLists->get();
            $countries = getCountryList();

        
             $data = $masseurLists->map(function ($row) use ($countries) {

               $avail_arr  = $row->availability ? json_decode($row->availability, true) : [];
               $avail_list = $this->weeklyAvailibility($avail_arr);

               $default_profile = "";
               if($row->is_default =='1')
                $default_profile = '<span class="profile_icon_box">
            <sup class="text-muted superfix">D</sup>
            <span class="profile_icon_item">Default Masseur in Profile</span>
            </span>';



                return [
                   
                    'checkbox' => '<input type="checkbox" class="select-masseur" value="'.$row->id.'">',
                    'member_id' => $row->member_id,
                    
                    'profile' => '<img src="'.asset('assets/dashboard/img/avatar.png').'" class="custompopicon"><span class="list_profile_name">'.$row->name.$default_profile.'</span>',

                    'days' => $avail_list,

                    'ethnicity' => config('escorts.profile.ethnicities')[$row->ethnicity] ?? 'NA',

                    'nationality' => $countries[$row->nationality] ?? 'NA',
                    

                ];
            });  


            return response()->json([
                'data' => $data
            ]);
           
    }


    public function weeklyAvailibility($avail_arr)
    {


            $avail = "";

            if((isset($avail_arr['monday']) && $avail_arr['monday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">M</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">M</span><small class="legend_text">Available</small></div>';
            }


            if((isset($avail_arr['tuesday']) && $avail_arr['tuesday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">T</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">T</span><small class="legend_text">Available</small></div>';
            }

            if((isset($avail_arr['wednesday']) && $avail_arr['wednesday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">W</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">W</span><small class="legend_text">Available</small></div>';
            }

            if((isset($avail_arr['thursday']) && $avail_arr['thursday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">T</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">T</span><small class="legend_text">Available</small></div>';
            }

            if((isset($avail_arr['friday']) && $avail_arr['friday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">F</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">F</span><small class="legend_text">Available</small></div>';
            }

            if((isset($avail_arr['saturday']) && $avail_arr['saturday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">S</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">S</span><small class="legend_text">Available</small></div>';
            }


            if((isset($avail_arr['sunday']) && $avail_arr['sunday']['status'] == 'closed'))
            {
            $avail .=  '<div class="legend_item not_available"><span class="legend_box">S</span><small class="legend_text">Not Available</small></div>';
            }
            else
            {
            $avail .=  '<div class="legend_item"><span class="legend_box">S</span><small class="legend_text">Available</small></div>';
            }


            return ' <div class="legend_container">'.$avail.'</div>';


    
    } 

    public function  get_filter_masseur_option_list(Request $request)
    {

        $selected_masseur = $request->selectedList;
        $query = Masseur::where('user_id',auth()->user()->id)
                            ->whereNotIn('id', $selected_masseur)
                            ->where('status','1')
                            ->get();



            $countries = getCountryList();
            $data = $query->map(function ($row) use ($countries) {

            $avail_arr  = $row->availability ? json_decode($row->availability, true) : [];
            $avail_list = $this->weeklyAvailibility($avail_arr);


            $default_profile = "";
            if($row->is_default =='1')
             $default_profile = '<span class="profile_icon_box">
            <sup class="text-muted superfix">D</sup>
            <span class="profile_icon_item">Default Masseur in Profile</span>
            </span>';


            return [
                
                'checkbox' => '<input type="checkbox" class="select-masseur" value="'.$row->id.'">',
                
                'profile' => '<img src="'.asset('assets/dashboard/img/avatar.png').'" class="custompopicon"><span>'.$row->name.$default_profile.'</span>',

                'days' => $avail_list,

                'ethnicity' => config('escorts.profile.ethnicities')[$row->ethnicity] ?? 'NA',

                'nationality' => $countries[$row->nationality] ?? 'NA',
                

            ];
        });  

        return response()->json([
            'data' => $data
        ]);
    }

    public function  get_masseur_option_list(Request $request)
    {
            $masseur  = MassagerMasseur::with('masseur')->where(['massage_profile_id'=>$request->massage_profile_id])->get();
            $masseurs = $masseur->pluck('masseur')->filter();
            $countries = getCountryList();

            $data = $masseurs->map(function ($row) use ($countries) {

                $avail_arr  = $row->availability ? json_decode($row->availability, true) : [];
                $avail_list = $this->weeklyAvailibility($avail_arr);

                $default_profile = "";
                if($row->is_default =='1')
                $default_profile = '<span class="profile_icon_box">
            <sup class="text-muted superfix">D</sup>
            <span class="profile_icon_item">Default Masseur in Profile</span>
            </span>';

                return [
                    
                    'id' => $row->id,
                    'member_id' => $row->member_id,
                    'profile' => '<img src="'.asset('assets/dashboard/img/avatar.png').'" class="custompopicon"> <span class="list_profile_name">'.$row->name.$default_profile.'</span>',

                    'days' => $avail_list,

                    'ethnicity' => config('escorts.profile.ethnicities')[$row->ethnicity] ?? 'NA',

                    'nationality' => $countries[$row->nationality] ?? 'NA',

                    // class="btn-danger btn-sm remove-row delete-masseur" data-id="'.$row->id.'"
                    
                     'action' => '<button 
                        type="button"  
                        class="btn-danger btn-sm remove-row">
                        Remove
                    </button>',

                ];
            });  


            return response()->json([
                'data' => $data
            ]);


    }


    public function  get_all_masseur_list(Request $request)
    {
        if($request->isImpersonated) {
            //$masseurs  = Masseur::where('user_id', auth()->user()->id)->where('created_by', $request->impersonatedId)->get();
            $masseurs  = Masseur::where('user_id', auth()->user()->id)->get(); 

        } else {
           $masseurs  = Masseur::where('user_id', auth()->user()->id)->get(); 
        }
        $countries = getCountryList();
        $totalActive = $masseurs->where('status', 1)->count();

        $data = $masseurs->map(function ($row) use ($countries) {

            if($row->status==1)
            $status = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action '.canManageClass().'" data-row-id="'.$row->id.'" id="row_deactive" href="javascript:void(0)">   <i class="fa fa-ban"></i> Deactivate</a>';   
                else
            $status = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action '.canManageClass().'" data-row-id="'.$row->id.'" id="row_active"  href="javascript:void(0)">   <i class="fa fa-circle"></i> Activate</a>';     
            
            
            if($row->is_default==1)
            $default = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action '.canManageClass().'" data-row-id="'.$row->id.'" id="row_undefault" href="javascript:void(0)">   <i class="fa fa-ban"></i> Remove Default Listing</a>';   
                else
            $default = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center masseur_action '.canManageClass().'" data-row-id="'.$row->id.'" id="row_default"  href="javascript:void(0)">   <i class="fa fa-circle"></i> Make Default Listing</a>';     
            

            
                $action = '<div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                
                                                
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="update-masseur/'.$row->id.'"> <i class="fa fa-pen"></i> Edit profile </a>
                                                <div class="dropdown-divider '.canManageClass().'"></div>'.$status.'<div class="dropdown-divider '.canManageClass().'"></div>'.$default;
                                                
                                                
                                                
                        '</div>';
            //<a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#viewMasseur">  <i class="fa fa-eye "></i> View Profile</a>            


            return [
                
                'member_id' => $row->member_id,
                'name' => $row->name,
                'stage_name' => $row->stage_name,
                'mobile' => $row->mobile,
                'ethnicity' => config('escorts.profile.ethnicities')[$row->ethnicity] ?? 'NA',
                'nationality' => $countries[$row->nationality] ?? 'NA',
                'created_at' => date('d M Y', strtotime($row->created_at)),
                'status' => ($row->status==1) ? '<span class="custom_badge badge_active">Active</span>' : '<span class="custom_badge badge_inactive">Deactived</span>',
                'default_profile' => ($row->is_default==1) ? 'Yes' : 'No',
                'action' => $action

            ];
        });  


        return response()->json([
            'data' => $data,
            'total_active' => $totalActive
        ]);


    }



    public function count_messure_profile(Request $request)
    {
        $masseurs  = Masseur::where('user_id', auth()->user()->id)->count();
         return response()->json([
                'messure_count' => $masseurs
         ]);
    }
    

    public function action_messure_profile(Request $request)
    {
        $masseurs  = Masseur::where(['user_id' => auth()->user()->id,'id'=>$request->profile_id])->first();
        if($masseurs)
        {

            if($request->action == 'row_deactive')
            {
                $masseurs->status = '0';    
                $mess = 'Profile deactivated successfully.';  
                MassagerMasseur::where('masseur_profile_id',$request->profile_id)->delete();
            }
            else if($request->action == 'row_active')
            {
                $masseurs->status = '1';  
                $mess = 'Profile activated successfully.'; 
            }

            else if($request->action == 'row_default')
            {
                 $count = $this->count_default_masseur(auth()->user()->id); 
                if($count<8) 
                {
                    $make_defailt = '1';
                    $message = 'Profile set as default successfully';
                   
                }
                else
                {
                    $make_defailt = '0';
                    $message = 'You have reached the limit of 8 default Listings.';
                }
                
                 $masseurs->is_default = $make_defailt;  
                 $mess = $message; 
            }

            else if($request->action == 'row_undefault')
            {
                $masseurs->is_default = '0';  
                $mess = 'Profile removed as default successfully.'; 
            }


             $masseurs->save();

            return response()->json([
                'success' =>true,
                'message' => $mess
            ]);
        }
        
    }

































    ################## Validate Mmasseur ##########################

    public function validate_masseur($massageTime,$massaureTime)
    {
        
            $newDataarr = []; 
            $j=0;

            //Log::info($massageTime);

            for($i=0;$i<count($massaureTime);$i++)
            {

                $exit = false;
                $massure = $massaureTime[$i]['availability'];
                $user_id = $massaureTime[$i]['id']; 
                $status = "";

                //Log::info($massageTime);


                $proceed_to_next = $this->proceed_to_next($massure,$massageTime);

                if($proceed_to_next)
                continue; 

                $monday_proceed_to_next = $this->check_time_status($massure,$massageTime,'monday');
                if($monday_proceed_to_next)
                continue; 

                $tuesday_proceed_to_next = $this->check_time_status($massure,$massageTime,'tuesday');
                if($tuesday_proceed_to_next)
                continue; 


                $wednesday_proceed_to_next = $this->check_time_status($massure,$massageTime,'wednesday');
                if($wednesday_proceed_to_next)
                continue; 

                $thursday_proceed_to_next = $this->check_time_status($massure,$massageTime,'thursday');
                if($thursday_proceed_to_next)
                continue;

                $friday_proceed_to_next = $this->check_time_status($massure,$massageTime,'friday');
                if($friday_proceed_to_next)
                continue;

                $saturday_proceed_to_next = $this->check_time_status($massure,$massageTime,'saturday');
                if($saturday_proceed_to_next)
                continue;

                $sunday_proceed_to_next = $this->check_time_status($massure,$massageTime,'sunday');
                if($sunday_proceed_to_next)
                continue;

                $newDataarr[$j]  = $user_id;
                $j++; 

            }


            return $newDataarr;
    }


    public function massure_till_Range($massure_from, $massage_from, $massage_to)
    {

        if ($massure_from === false || $massage_from === false || $massage_to === false) {
            return false;
        }

        return ($massure_from >= $massage_from);
    }

    public function massage_till_Range($massure_from, $massure_to, $massage_from)
    {

        if ($massure_from === false || $massure_to === false || $massage_from === false) {
            return false;
        }

        return ($massure_from>=$massage_from);
    }


    public function isInRange($massure_from, $massure_to, $massage_from, $massage_to)
    {

            try 
            {
                if ($massure_from === false || $massure_to === false || $massage_from === false || $massage_to === false) 
                {
                return false;
                }

                
                return ($massure_from >= $massage_from && $massure_to <= $massage_to);
            } 
            catch (Exception $e) {
             Log::info('Invalid Time');
             Log::info($e->getMessage());
            return false;
            }
    }



    

    public function check_time_status($massure,$massageTime,$day)
    {
        
            $proceed_to_next = false;
            
            if($massure[$day]['status'] == 'custom' &&  $massageTime[$day]['status'] == 'custom')
            {
                $massure_from   = strtotime($massure[$day]['from']);
                $massure_to     = strtotime($massure[$day]['to']);
                $massage_from   = strtotime($massageTime[$day]['from']);
                $massage_to     = strtotime($massageTime[$day]['to']);

                //echo $this->isInRange($massure_from, $massure_to, $massage_from, $massage_to).'<br>';
                
                if($this->isInRange($massure_from, $massure_to, $massage_from, $massage_to))
                $proceed_to_next  = false; 
                else
                $proceed_to_next  = true;
            }

            //echo $proceed_to_next.'<br>';

            elseif($massure[$day]['status'] == 'til_late' &&  $massageTime[$day]['status'] == 'custom')
            {
                
                $massure_from  =  strtotime($massure[$day]['from']);
                $massage_from  =  strtotime($massageTime[$day]['from']);
                $massage_to    =  strtotime($massageTime[$day]['to']);

                
                if($this->massure_till_Range($massure_from, $massage_from, $massage_to))
                $proceed_to_next  = false; 
                else
                $proceed_to_next  = true;
            }


            else if($massure[$day]['status'] == 'custom' &&  $massageTime[$day]['status'] == 'til_late')
            {
                $massure_from  = strtotime($massure[$day]['from']);
                $massure_to    = strtotime($massure[$day]['to']);

                $massage_from = strtotime($massageTime[$day]['from']);
                
                
                if($this->massage_till_Range($massure_from, $massure_to, $massage_from))
                $proceed_to_next  = false; 
                else
                $proceed_to_next  = true;
            }

            else if($massure[$day]['status'] == '24_hours' &&  $massageTime[$day]['status'] == '24_hours')
            {
                $proceed_to_next  = false; 
            }

            if($massure[$day]['status'] == '24_hours' &&  $massageTime[$day]['status'] != '24_hours')
            {
                $proceed_to_next  = false; 
            }

            if($massure[$day]['status'] != '24_hours' &&  $massageTime[$day]['status'] == '24_hours')
            {
                $proceed_to_next  = false; 
            }


            return $proceed_to_next;
    }


    public function proceed_to_next($massure,$massageTime)
    {
        $proceed_to_next = false;
        
        if($massure['monday']['status'] == 'closed' && $massageTime['monday']['status'] != 'closed')
        $proceed_to_next = true;

        if($massure['tuesday']['status'] == 'closed' && $massageTime['tuesday']['status'] != 'closed')
        $proceed_to_next = true;

        if($massure['wednesday']['status'] == 'closed' && $massageTime['wednesday']['status'] != 'closed')
        $proceed_to_next = true;

        if($massure['thursday']['status'] == 'closed' && $massageTime['thursday']['status'] != 'closed')
        $proceed_to_next = true;

        if($massure['friday']['status'] == 'closed' && $massageTime['friday']['status'] != 'closed')
        $proceed_to_next = true;

        if($massure['saturday']['status'] == 'closed' && $massageTime['saturday']['status'] != 'closed')
        $proceed_to_next = true;

        if($massure['sunday']['status'] == 'closed' && $massageTime['sunday']['status'] != 'closed')
        $proceed_to_next = true;

        return $proceed_to_next;
    }

    ################## End Validate Mmasseur ##########################


    public function getImageInfo(Request $request)
    {
        $media_id = $request->media_id;
        $media = MasseurMedia::findOrFail($media_id);
        if (!$media) {
            return response()->json([
                'status' => false,
                'message' => 'Media not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Media fetched successfully',
            'data' => $media
        ]);
    }


      public function getMediaCOunt(Request $request)
        {
            $masseur_token_id = MasseurGallery::where('masseur_profile_id', $request->masseur_id)->pluck('masseur_token_id');
            $query = MasseurMedia::whereIn('masseur_token_id',$masseur_token_id);
            // Total media count
            $total_media_count = (clone $query)->count();
          
            // Media count for verification
            $media_count_for_verification = (clone $query)
                ->whereIn('varified', ['0', '2'])
                ->whereNull('media_verification_id')
                ->count();

            return response()->json([
                'success' => true,
                'media_count_for_verification' => $media_count_for_verification,
                'total_media_count' => $total_media_count
            ]);
        }
}
