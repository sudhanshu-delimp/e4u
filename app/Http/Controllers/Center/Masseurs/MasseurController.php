<?php

namespace App\Http\Controllers\Center\Masseurs;

use Exception;
use App\Models\Masseur;
use App\Models\MasseurRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Duration\DurationInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Message\MessageMediaInterface;
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
  
    


    public function __construct(MassageProfileInterface $massage_profile, MessageInterface $escort, MessageMediaInterface $media, ServiceInterface $service, DurationInterface $duration)
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
        $durations = $this->duration->all();
        $user = auth()->user();

        ########## default profile data ############
        $massage_default = $this->massage_profile->findDefault($user->id,1);
        if(!$massage_default ) {
            $massage_default = $this->massage_profile->make();
        }
        $massage_durations = (isset($massage_default->durations) && count($massage_default->durations)>0) ? $massage_default->durations->toArray() : [];
        ########## End default profile data ########

        return view('center.dashboard.masseurs.add-masseurs',compact('durations','massage_durations'));
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
            // if (!empty($request->position)) {
            //     foreach ($request->position as $position => $mediaId) {
            //         if ($mediaId) {
            //             MassageGallery::create([
            //                 'massage_profile_id' => $massage_profile_id,
            //                 'massage_media_id'   => isMassageGalleryTemplate($mediaId),
            //                 'position'           => $position,
            //                 'type'               => 0,
            //             ]);
            //         }
            //     }
            // }

            // /* ================== Gallery (Videos) ================== */
            // if (!empty($request->video_position)) {
            //     foreach ($request->video_position as $key => $video) {
            //         if (!empty($video)) {
            //             MassageGallery::create([
            //                 'massage_profile_id' => $massage_profile_id,
            //                 'massage_media_id'   => $video,
            //                 'position'           => $key,
            //                 'type'               => 1,
            //             ]);
            //         }
            //     }
            // }

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

        return view('center.dashboard.masseurs.update-masseurs',compact('durations','massage_durations','availability','masseur'));
    }

    public function update_masseur(Request $request)
    {
        try 
        {

            DB::beginTransaction();
            $user = auth()->user();
            $request_data = $request->all();
            $availability     = $this->makeAvailability($request_data);
            $availabilityJson = json_encode($availability);

            /* ================== Masseur Profile ================== */
            $masseur = Masseur::where(['id'=> $request->masseur_id])->first();

           
            $masseur->name                  = $request->name;
            $masseur->stage_name            = $request->stage_name;
            $masseur->mobile                = $request->mobile;
           
            $masseur->nationality           = $request->nationality;

            $masseur->ethnicity             = $request->ethnicity ;
            $masseur->age                   = $request->age;

            $masseur->vaccination           = $request->vaccination;
            $masseur->commentary            = $request->commentary;

            $masseur->availability          = $availabilityJson;
            
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
                        'masseur_profile_id' => $request->masseur_id,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }

                if(!empty($rates))
                MasseurRate::where(['masseur_profile_id' => $request->masseur_id])->delete();  

                MasseurRate::insert($rates);
            }

            // /* ================== Gallery (Images) ================== */
            // if (!empty($request->position)) {
            //     foreach ($request->position as $position => $mediaId) {
            //         if ($mediaId) {
            //             MassageGallery::create([
            //                 'massage_profile_id' => $massage_profile_id,
            //                 'massage_media_id'   => isMassageGalleryTemplate($mediaId),
            //                 'position'           => $position,
            //                 'type'               => 0,
            //             ]);
            //         }
            //     }
            // }

            // /* ================== Gallery (Videos) ================== */
            // if (!empty($request->video_position)) {
            //     foreach ($request->video_position as $key => $video) {
            //         if (!empty($video)) {
            //             MassageGallery::create([
            //                 'massage_profile_id' => $massage_profile_id,
            //                 'massage_media_id'   => $video,
            //                 'position'           => $key,
            //                 'type'               => 1,
            //             ]);
            //         }
            //     }
            // }

            DB::commit();

            return response()->json([
                'success'   => true,
                'masseur_profile_id' => $request->masseur_id,
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
    
    

}
