<?php

namespace App\Http\Controllers\Center\Masseurs;

use Exception;
use App\Models\Masseur;
use App\Models\MasseurRate;
use App\Models\MassageMedia;
use Illuminate\Http\Request;
use App\Models\MasseurGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Duration\DurationInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Message\MasseurMediaInterface;
use App\Repositories\Message\MessageMediaInterface;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Http\Requests\Escort\StoreGalleryMediaRequest;
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
  
    
    public function __construct(MassageProfileInterface $massage_profile, MessageInterface $escort, MasseurMediaInterface $media, ServiceInterface $service, DurationInterface $duration)
    {
        $this->escort = $escort;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
    
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
        

        return view('center.dashboard.masseurs.add-masseurs',compact('durations','massage_durations','massage_default','page_token','media'));
    }

    public function add_masseur(Request $request)
    {
        try 
        {

            DB::beginTransaction();
            $user = auth()->user();
            $request_data = $request->all();
            $availability     = $this->makeAvailability($request_data);
            $availabilityJson = json_encode($availability);

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

            $masseur->token_id            = $request->filled('page_token') ? $request->page_token : null;

            $masseur->availability            = $availabilityJson;
            
            $masseur->save();
            $masseur_profile_id = $masseur->id;

            
        
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

           
            DB::commit();

            return response()->json([
                'success'   => true,
                'masseur_profile_id' => $masseur_profile_id,
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

    public function edit_masseur(Request $request, $id)
    {
        
        $masseur = Masseur::where('id',$id)->first();
        if(!$masseur || !$id){
        return redirect()->route('center.create-new-masseur');
        }

        $availability = $masseur ? json_decode($masseur->availability, true) : [];
        
        $durations = $this->duration->all();
        $user = auth()->user();

        ########## default profile data ############
        $massage_default = $this->massage_profile->findDefault($user->id,1);
        if(!$massage_default ) {
            $massage_default = $this->massage_profile->make();
        }
        $massage_durations = (isset($massage_default->durations) && count($massage_default->durations)>0) ? $massage_default->durations->toArray() : [];
        ########## End default profile data ########

         $media = $this->media->with_Or_withoutPosition(auth()->user()->id, $masseur->token_id,[]);

        

        return view('center.dashboard.masseurs.update-masseurs',compact('durations','massage_durations','availability','masseur','media'));
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
                            $availability     = $this->makeAvailability($request_data);
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




    public function getAccountMediaGallery(Request $request, $category=null,$page_token,)
    {
        try {
            $media = $this->media->with_Or_withoutPosition(auth()->user()->id,$page_token, []);
            $mediaCategory = match ($category) {
                'gallery' => $media->whereNotIn('position',[9,10]),
                'banner'  => $media->whereIn('position',[9])->where('template','0'),
                'pinup'   => $media->whereIn('position',[10]),
            };
            $path = $this->media;
            $response = [];
            $response['success'] = true;
            $response['category'] = $category;
            $response['gallery_container_html'] = view('center.masseur.media_gallery_container',compact('mediaCategory','media','path','category'))->render();
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

}
