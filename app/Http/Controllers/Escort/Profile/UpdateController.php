<?php

namespace App\Http\Controllers\Escort\Profile;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Models\Poli_transaction;
use App\Models\EscortGallery;
use App\Models\Escort;
use App\Models\Availability;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\Escort\UpdateRequestAboutMe;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\UpdateRequestAboutAll;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ResizeImage;
use App\Http\Controllers\AppController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Escort\EscortMediaInterface;
use App\Models\EscortCovidReport;
//use Illuminate\Http\Request;

class UpdateController extends AppController
{
    protected $escort;
    protected $availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability,  ServiceInterface $service, DurationInterface $duration, EscortMediaInterface $media)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
    }

    public function index()
    {
        return view('escort.dashboard.profile.createProfile');
    }


    public function update_escort(Request $request, $id = null)
    {
        $error = true;
        if ($id) {
            $escort = $this->escort->find($id);
            $input = [
                'profile_name' => $request->profile_name ?: $escort->profile_name,
                'name' => $request->name ?: $escort->name,
                'state_id' => $request->state_id ?: $escort->state_id,
                'city_id' => $request->city_id ?: $escort->city_id,
                'address' => $request->address ?: $escort->address,
                'covidreport' => $request->covidreport ?: $escort->getRawOriginal('covidreport'),
                'phone' => $request->phone ?: $escort->phone,
                //'about' => $request->about ?: $escort->about,
                //'about_title' => $request->about_title ?: $escort->about_title,
            ];
            if ($this->escort->update($id, $input)) {
                $error = false;
                $user = $this->user->find(auth()->user()->id);
                $escortNames = $user->escorts_names;
                if ($escortNames && !in_array($input['name'], $escortNames)) {
                    $escortNames[] = $input['name'];
                    $user->escorts_names = $escortNames;
                    $user->save();
                }
            }
        }
        return response()->json(compact('error'));
    }



    public function update_escort_default(Request $request)
    {

        $error = true;
        $user = auth()->user();
        $escortDefault = $this->escort->findDefault($user->id, 1);
        if (!empty(trim($request->name))) {

            $users = $this->user->find($user->id);

            $escortNames = $users->escorts_names;
            if ($escortNames == NULL || !in_array($request->name, $escortNames)) {
                $escortNames[] = trim($request->name);
                $users->escorts_names = $escortNames;
                $users->save();
            }
        }
        $cityId = 0;
        $cnt = 0;
        if (isset($request->state_id)) {
            $stateId = $request->state_id;

            $cities = config("escorts.profile.states.$stateId.cities");
            if (is_array($cities) && count($cities) > 0) {
                foreach ($cities as $key => $state) {
                    if ($cnt == 0) {
                        $cityId =   $key;
                    }
                    $cnt++;
                }
            }
        }

        $escortObj = (new Escort);

        $input = [
            //gender'=> $request->gender ?: $escortDefault->gender,
            'orientation' => $request->orientation ?: $escortDefault->getRawOriginal('orientation'),
            'ethnicity' => $request->ethnicity ?: $escortDefault->getRawOriginal('ethnicity'),
            'body_type' => $request->body_type ?: $escortDefault->getRawOriginal('body_type'),
            'hair_color' => $request->hair_color ?: $escortDefault->getRawOriginal('hair_color'),
            'hair_style' => $request->hair_style ?: $escortDefault->getRawOriginal('hair_style'),
            'height' => $request->height ?: $escortDefault->getRawOriginal('height'),
            'eyes' => $request->eyes ?: $escortDefault->getRawOriginal('eyes'),
            'skin_tone' => $request->skin_tone ?: $escortDefault->getRawOriginal('skin_tone'),
            'shaved' => $request->shaved ?: $escortDefault->getRawOriginal('shaved'),
            'breast' => $request->breast ?: $escortDefault->getRawOriginal('breast'),
            'dress_size' => $request->dress_size ?: $escortDefault->getRawOriginal('dress_size'),
            'endowment' => $request->endowment ?: $escortDefault->getRawOriginal('endowment'),
            'thickness' => $request->thickness ?: $escortDefault->getRawOriginal('thickness'),
            'circumcised' => $request->circumcised ?: $escortDefault->getRawOriginal('circumcised'),
            'butt' => $request->butt ?: $escortDefault->getRawOriginal('butt'),
            'preference' => $request->preference ?: $escortDefault->getRawOriginal('preference'),
            'hormones' => $request->hormones ?: $escortDefault->getRawOriginal('hormones'),
            'contact' => $request->contact ?: $escortDefault->getRawOriginal('contact'),
            'piercing' => $request->piercing ?: $escortDefault->getRawOriginal('piercing'),
            'drugs' => $request->drugs ?: $escortDefault->getRawOriginal('drugs'),
            'travel' => $request->travel ?: $escortDefault->getRawOriginal('travel'),
            'tattoos' => $request->tattoos ?: $escortDefault->getRawOriginal('tattoos'),
            'smoke' => $request->smoke ?: $escortDefault->getRawOriginal('smoke'),
            'license' => $request->license ? $request->license : $escortDefault->license,
            'age' => $request->age ? $request->age : $escortDefault->age,
            // 'name'=>$request->name ? $request->name : $escortDefault->name,
            'state_id' => $request->state_id ?: $escortDefault->getRawOriginal('state_id'),
            'weight' => $request->weight ?: $escortDefault->getRawOriginal('weight'),
            'payment_type' => $request->payment_type ?: $escortDefault->getRawOriginal('payment_type'),
            'covidreport' => $request->covidreport ?: $escortDefault->getRawOriginal('covidreport'),
            'nationality_id' => $request->nationality_id ?: $escortDefault->getRawOriginal('nationality_id'),
        ];
        $escortId = $escortDefault->id;
        if ($cityId > 0) {
            $input['city_id'] =  $cityId;
        }
        if (isset($request->language)) {
            $languageArr = explode(',', $request->language);
            $input['language'] =  json_encode($languageArr);
        }

        if (isset($request->available_to)) {
            $availables = explode(',', $request->available_to);
            $input['available_to'] =  json_encode($availables);
        }

        if (isset($request->play_type)) {
            $playTypes = explode(',', $request->play_type);
            $input['play_type'] =  json_encode($playTypes);
        }

        if (isset($request->gender)) {
            $input['gender'] =  $request->gender;
        }
        $rateField = "";
        $rateValue = 0;
        $durationId = 0;
        if (isset($request->massage_price[0])) {
            $rateField = 'massage_price';
            $rateValue = (int)$request->massage_price[0];
            $durationId =  $request->custom_id;
        } else if (isset($request->incall_price[0])) {
            $rateField = 'incall_price';
            $rateValue = (int)$request->incall_price[0];
            $durationId =  $request->custom_id;
        } else if (isset($request->outcall_price[0])) {
            $rateField = 'outcall_price';
            $rateValue = (int)$request->outcall_price[0];
            $durationId =  $request->custom_id;
        }
        if (!empty($rateField) && $durationId > 0) {
            $arr = [];
            $escort = $this->escort->find($escortId);
            $durationData = $escort->durations()->where('escort_id', $escortId)->get();
            if ($durationData->count() == 0) {
                $durations = $this->duration->all();
                foreach ($durations as $key => $value) {
                    $arr  += [
                        $value->id => [
                            "escort_id" => $escortId,
                            "massage_price" => ($rateField == 'massage_price' && $value->id == $durationId) ? $rateValue : 0,
                            "incall_price" => ($rateField == 'incall_price' &&  $value->id == $durationId) ? $rateValue : 0,
                            "outcall_price" => ($rateField == 'outcall_price' && $value->id == $durationId) ? $rateValue : 0
                        ],
                    ];
                }
                if ($data_durations  = $escort->durations()->sync($arr)) {
                    $error = 1;
                }
            } else {
                $arr  = [
                    $durationId => [
                        "escort_id" => $escortId,
                        $rateField => $rateValue,
                    ],
                ];

                $escort->durations()->updateExistingPivot($durationId, [$rateField => $rateValue]);
            }
        }

        if (isset($request->price[0])) {
            $serviceValue = (int)$request->price[0];
            $serviceId =  (int)$request->custom_id;
            if ($serviceId > 0) {
                $escort = Escort::with('services')->find($escortId);
                $escort->services()->syncWithoutDetaching([
                    $serviceId => ['price' => $serviceValue]
                ]);
            }
        }
        $weekday = "";
        $dateTime = "";
        $longDays = config('escorts.days.long_form');
        if (isset($request->day_key_from)) {
            $dateTime = $request->day_key_from;
            $dayKey = $request->custom_id;
            $weekday = isset($longDays[$dayKey]) ? $longDays[$dayKey] . "_from" : "";
        }
        if (isset($request->day_key_to)) {
            $dateTime = $request->day_key_to;
            $dayKey = $request->custom_id;
            $weekday = isset($longDays[$dayKey]) ? $longDays[$dayKey] . "_to" : "";
        }

        if (!empty($weekday) && !empty($dateTime)) {
            $time = date('H:i:s', strtotime($dateTime));
            //echo $time. " ".$dateTime. " " .  $weekday;die;
            $availability = Availability::where('escort_id', $escortId)->first();
            if ($availability) {
                $availabilityTime = $availability->availability_time;
                unset($availabilityTime[$longDays[$dayKey]]);
                $availability->{$weekday} = $time;
                $availability->availability_time = $availabilityTime;
                $availability->save();
            } else {
                $availability = (new  Availability);
                $availability->escort_id = $escortId;
                $availability->{$weekday} = $time;
                $availability->save();
            }
            $error = false;
        }

        if (isset($request->availability_time)) {
            $availabilityValue = $request->availability_time;
            $dayKey = $request->custom_id;
            $weekday = isset($longDays[$dayKey]) ? $longDays[$dayKey] : "";
            if (!empty($weekday) && !empty($dayKey)) {

                $availability = Availability::where('escort_id', $escortId)->first();
                if ($availability) {
                    $availabilityTime = $availability->availability_time;
                    $availabilityTime[$weekday] = $availabilityValue;

                    $availability->{$weekday . "_from"} = null;
                    $availability->{$weekday . "_to"} = null;
                    $availability->availability_time = $availabilityTime;
                    $availability->save();
                } else {
                    $availability = (new  Availability);
                    $availability->escort_id = $escortId;
                    $availability->{$weekday . "_from"} = null;
                    $availability->{$weekday . "_to"} = null;
                    $availability->availability_time = [$weekday => $availabilityValue];
                    $availability->save();
                }
                $error = false;
            }
        }

        //echo $escortDefault->id;die;
        // echo "<pre/>";print_r($input);die;
        if ($this->escort->update($escortDefault->id, $input)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }


    /***
     * UpdatedBy::Bikash Chhualsingh
     * UpdateDate: 12-June-2023
     */
    public function createBySetting(UpdateRequestAboutAll $request, $id = null)
    {
        $user = auth()->user();

        $successFlashMsg = $id ? 'Profile updated successfully' : 'Profile created successfully';
        $escortStatus = 0;
        $createOrUpdate = 'C';
        if ($id) {
            $escort_data = $this->escort->find($id);

            if (Carbon::parse($escort_data->end_date)->format('Y-m-d') < date('Y-m-d')) {
                $escort_data->enabled = 0;
                $escort_data->save();
            }
            $escortStatus = $escort_data->enabled;
            $createOrUpdate = 'U';
        }

        /*if(!empty($id) && $request->membership != 4) {

            $escort_data = $this->escort->find($id);
            if(Carbon::parse($escort_data->start_date)->format('Y-m-d') != $request->start_date || Carbon::parse($escort_data->end_date)->format('Y-m-d') != $request->end_date || $escort_data->membership != $request->membership) {
                $my_data['change_amount'] = true;
                $my_data['start_date'] = $request->start_date;
                $my_data['end_date'] = $request->end_date;
                $my_data['membership'] = $request->membership;
                $my_data['enabled'] = 1;
                //return redirect()->route('escort.poli.paymentUrl', [$id]);
            }
        }*/

        $galleryStorageFull = false;
        $escortDefault = $this->escort->findDefault($user->id, 1);

        $input = [
            'name' => $request->name ? $request->name : ($escortDefault->name ?: null),
            'city_id' => $request->city_id ? $request->city_id : ($escortDefault->city_id ?: null),
            'phone' => $request->phone ? $request->phone : ($escortDefault->phone ?: null),
            'address' => $request->address ? $request->address : ($escortDefault->address ?: null),
            'state_id' => $request->state_id  ? $request->state_id : ($escortDefault->state_id ?: null),
            'playmate' => $request->playmate  ? $request->playmate : 'N',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,

            // 'membership'=>$request->membership ? $request->membership : null,
            //'gender'=>$request->gender ? $escort->getRawOriginal('gender') : NULL,
            'profile_name' => $request->profile_name ? $request->profile_name : ($escortDefault->profile_name ?: null),
            'gender' => $request->gender ? $request->gender : ($escortDefault->gender ?: NULL),
            'nationality_id' => $request->nationality_id ? $request->nationality_id : ($escortDefault->nationality_id ?: NULL),
            'height' => $request->height ? $request->height : ($escortDefault->height ?: NULL),
            'eyes' => $request->eyes ? $request->eyes : ($escortDefault->eyes ?: NULL),
            'orientation' => $request->orientation ? $request->orientation : ($escortDefault->orientation ?: NULL),
            'age' => $request->age ? $request->age : ($escortDefault->age ?: NULL),
            'hair_color' => $request->hair_color ? $request->hair_color : ($escortDefault->hair_color ?: NULL),
            'skin_tone' => $request->skin_tone ? $request->skin_tone : ($escortDefault->skin_tone ?: NULL),
            'breast' => $request->breast ? $request->breast : ($escortDefault->breast ?: NULL),
            'endowment' => $request->endowment ? $request->endowment : ($escortDefault->endowment ?: NULL),
            'thickness' => $request->thickness ? $request->thickness : ($escortDefault->thickness ?: NULL),
            'circumcised' => $request->circumcised ? $request->circumcised : ($escortDefault->circumcised ?: NULL),
            'butt' => $request->butt ? $request->butt : ($escortDefault->butt ?: NULL),
            'preference' => $request->preference ? $request->preference : ($escortDefault->preference ?: NULL),
            'hormones' => $request->hormones ? $request->hormones : ($escortDefault->hormones ?: NULL),
            'contact' => $request->contact ? $request->contact : ($escortDefault->contact ?: NULL),
            'ethnicity' => $request->ethnicity ? $request->ethnicity : ($escortDefault->ethnicity ?: NULL),
            'body_type' => $request->body_type ? $request->body_type : ($escortDefault->body_type ?: NULL),
            'hair_style' => $request->hair_style ? $request->hair_style : ($escortDefault->hair_style ?: NULL),
            'weight' => $request->weight ? $request->weight : ($escortDefault->weight ?: NULL),
            'dress_size' => $request->dress_size ? $request->dress_size : ($escortDefault->dress_size ?: NULL),
            'shaved' => $request->shaved ? $request->shaved : ($escortDefault->shaved ?: NULL),
            'covidreport' => $request->covidreport ? $request->covidreport : ($escortDefault->covidreport ? $escortDefault->getRawOriginal('covidreport') : NULL),
            'piercing' => $request->piercing ? $request->piercing : ($escortDefault->piercing ?: NULL),
            'drugs' => $request->drugs ? $request->drugs : ($escortDefault->drugs ?: NULL),
            'travel' => $request->travel ? $request->travel : ($escortDefault->travel ?: NULL),
            'tattoos' => $request->tattoos ? $request->tattoos : ($escortDefault->tattoos ?: NULL),
            'smoke' => $request->smoke ? $request->smoke : ($escortDefault->smoke ?: NULL),
            'available_to' => $request->available_to ? $request->available_to : ($escortDefault->available_to ?: NULL),
            'license' => $request->license ? $request->license : ($escortDefault->license ?: NULL),
            'play_type' => $request->play_type ? $request->play_type : ($escortDefault->play_type ?: NULL),
            'payment_type' => $request->payment_type ? $request->payment_type : ($escortDefault->payment_type ?: NULL),
            'language' => $request->language ? $request->language : ($escortDefault->language ?: NULL),
            'social_links' => $request->social_links ? $request->social_links : ($escortDefault->social_links ?: NULL),
            'enabled' => $escortStatus,
            'user_id' => $user->id,
            'default_setting' => 0,
            'about' => $request->about ? $request->about : ($escortDefault->about ?: null),
            'about_title' => $request->about_title ? $request->about_title : ($escortDefault->about_title ?: null),
        ];
        //        $errors = [];
        $errors = '';
        if ($escort = $this->escort->store($input, $id)) {
            $id = $escort->id;
            //$error = 1;

            // $user = $this->user->find(auth()->user()->id);

            // $escortNames = $user->escorts_names;
            // if($escortNames == NULL || !in_array($input['name'], $escortNames)) {
            //     $escortNames[] = $input['name'];
            //     $user->escorts_names = $escortNames;
            //     $user->save();
            // }
        } else {
            //            $errors['profile_save'] = 'Error while saving the profile';
            $errors = 'Error while saving the profile';
        }

        if ($id) {
            $arr = [];
            if (isset($request->duration_id)) {
                foreach ($request->duration_id as $key => $value) {
                    $arr  += [
                        $value => [
                            "massage_price" => $request->massage_price[$key],
                            "incall_price" => $request->incall_price[$key],
                            "outcall_price" => $request->outcall_price[$key]
                        ],
                    ];
                }
            }

            
            if ($data_durations  = $escort->durations()->sync($arr)) {
                $error = 1;
            }

            /**
             * Start:- Store Rates to My Information , if does not eixst there
             */
            $existDefaultRate = $escortDefault->durations()
            ->get()
            ->filter(function ($duration) {
                return $duration->pivot->massage_price > 0 ||
                       $duration->pivot->incall_price > 0 ||
                       $duration->pivot->outcall_price > 0;
            })
            ->values()
            ->toArray();

            if(empty($existDefaultRate)){
                $escortDefault->durations()->sync($arr);
            }

            /**
             * End:- Store Rates to My Information , if does not eixst there
             */

            $data = [];
            $shortDays = config('escorts.days.short_form');
            foreach ($shortDays as $day => $shortDay) {
                if (!empty($request->{$shortDay . "_from"})) {
                    $data  += [
                        $day . "_from" => date('H:i:s', strtotime($request->{$shortDay . "_from"} . $request->{$shortDay . "_time_from"})),
                        $day . "_to" => date('H:i:s', strtotime($request->{$shortDay . "_to"} . $request->{$shortDay . "_time_to"}))
                    ];
                } else {
                    $data  += [
                        $day . "_from" => null,
                        $day . "_to" => null,
                    ];
                }
            }
            $data  += [
                "escort_id" => $id,
            ];
            //dd($data);
            //$escort = $this->escort->find($escortId);
            $availability = $escort->availability;
            if (!empty($request->availability_time)) {
                $data  += [
                    "availability_time" => $request->availability_time,
                ];
            }

            if ($data_massage_availability = $this->availability->store($data, $availability ? $availability->id : null)) {
                $my_data['new_availability'] = 1;
            }

            /**
             * Start:- Store Availability to My Information , if does not eixst there
             */
            $existDefaultAvailability = $escortDefault->availability()->exists();
            if(empty($existDefaultAvailability)){
                $data["escort_id"] = $escortDefault->id;
                $defaultAvailability = $escortDefault->availability;
                $this->availability->store($data, $defaultAvailability ? $defaultAvailability->id : null);
            }

            /**
             * End:- Store Availability to My Information , if does not eixst there
             */
            $service_arr = [];

            if (!empty($request->service_id)) {
                foreach ($request->service_id as $key => $value) {
                    $service_arr  += [$value => ["price" => $request->price[$key]]];
                }
            }
            //dd($arr);

            if ($data_service = $escort->services()->sync($service_arr)) {
                $my_data['new_services'] = 1;
            }

            /**
             * Start:- Store Service Tags to My Information , if does not eixst there
            */
            $existDefaultService = $escortDefault->services()->exists();
            if(empty($existDefaultService)){
                $escortDefault->services()->sync($service_arr);
            }

            /**
             * End:- Store Service Tags to My Information , if does not eixst there
             */


            //********FILE UPLOAD AREA**********//
            //dd($request->file('img'));
            $media_arr = [];
            $noOfFilesInGallery = $this->media->get_user_row(auth()->user()->id, [8, 10])->count();
            foreach ($request->position as $position => $mediaId) {
                if ($mediaId) {
                    $media_arr[$position]  = [
                        'escort_media_id' => $mediaId,
                        'position' => $position,
                    ];
                }
            }
            if ($noOfFilesInGallery  <= 30) {
                if ($request->hasFile('img')) {
                    foreach ($request->file('img') as $position => $image) {
                        $mime = $image->getMimeType();
                        if (strstr($mime, "video/")) {
                            $prefix = 'videos/';
                            $type = 1;  //0=>image; 1=>video
                        } else {
                            $prefix = 'images/';
                            $type = 0;
                        }
                        list($width, $height) = getimagesize($image);
                        //list($type, $prefix) = $this->getPrefix($image);
                        $encryptedFileName = $this->_generateUniqueFilename(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                        $file_path = $prefix . $user->id . '/' . Str::slug($encryptedFileName) . '.' . $image->getClientOriginalExtension();
                        //dd($file_path);
                        Storage::disk('escorts')->put($file_path, file_get_contents($image));

                        if (!$media = $this->media->findByPath('escorts/' . $file_path)) {
                            $data = [
                                'escort_id' => $id,
                                'user_id' => $user->id,
                                'type' => $type,
                                'position' => $position,
                                'path' => 'escorts/' . $file_path,
                            ];
                            // $media = $this->media->updateOrCreate($data,$user->id,$position);
                            $noOfFilesInGallery++;
                            $media = $this->media->create($data);
                            $media_arr[$position]  = [
                                'escort_id' => $id,
                                'escort_media_id' => $media['id'],
                                'position' => $position,
                                'created_at' => date('Y-m-d H:i:s'),
                                // 'position' => $media['position'],
                            ];
                        } else {
                            $media_arr[$position]  = [
                                'escort_id' => $id,
                                'escort_media_id' => $media->id,
                                'position' => $position,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
                        }
                    }
                }
            } else {
                //                $errors['gallery_full'] = "Opss... You have already 30 Images uploaded";
                $errors .= "\nOpss... You have already 30 Images uploaded";
            }
            //********FILE UPLOAD AREA CLOSE**********//


            $escortImages = EscortGallery::where('escort_id', $id)->get();
            foreach ($escortImages as $escortImage) {
                if (isset($media_arr[$escortImage->position])) {
                    $escortImage->escort_media_id = $media_arr[$escortImage->position]['escort_media_id'];
                    $escortImage->updated_at = date('Y-m-d H:i:s');
                    $escortImage->save();
                    unset($media_arr[$escortImage->position]);
                }
            }
            foreach ($media_arr as $newRecord) {
                $gallery = new EscortGallery;
                $gallery->escort_id = $id;
                $gallery->escort_media_id = $newRecord['escort_media_id'];
                $gallery->position = $newRecord['position'];
                $gallery->created_at = date('Y-m-d H:i:s');
                $gallery->save();
            }
            //            $return = $escort->gallary()->syncWithoutDetaching($media_arr);

            //$my_data['poliLink'] = route('escort.poli.paymentUrl', [$escortId]);
            if ($errors) {
                return redirect()->route('escort.update.profile', $id)->with('error', $errors);
            } else {
                return redirect()->route('escort.update.profile', $id)->with('success', $successFlashMsg);
            }
        } else {
            return redirect()->route('escort.list')->with('error', $errors);
        }
    }


    /***
     * UpdatedBy::Bikash Chhualsingh
     * UpdateDate: 12-June-2023
     */
    public function saveProfileMedia(UpdateRequestAboutAll $request, $id = null)
    {
        $user = auth()->user();
        $media_arr = [];
        $errors = "";
        $error = true;
        $successFlashMsg = $id ? 'Profile updated successfully' : 'Profile created successfully';
        $galleryStorageFull = false;
        $noOfFilesInGallery = $this->media->get_user_row(auth()->user()->id, [8, 10])->count();
        //echo $noOfFilesInGallery;die;

        if ($noOfFilesInGallery  <= 30) {
            $error = false;
            if ($request->hasFile('img')) {
                foreach ($request->file('img') as $position => $image) {
                    $mime = $image->getMimeType();
                    if (strstr($mime, "video/")) {
                        $prefix = 'videos/';
                        $type = 1;  //0=>image; 1=>video
                    } else {
                        $prefix = 'images/';
                        $type = 0;
                    }
                    list($width, $height) = getimagesize($image);
                    //list($type, $prefix) = $this->getPrefix($image);
                    $encryptedFileName = $this->_generateUniqueFilename(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                    $file_path = $prefix . $user->id . '/' . Str::slug($encryptedFileName) . '.' . $image->getClientOriginalExtension();
                    //dd($file_path);
                    Storage::disk('escorts')->put($file_path, file_get_contents($image));

                    if (!$media = $this->media->findByPath('escorts/' . $file_path)) {
                        $data = [
                            'escort_id' => $id,
                            'user_id' => $user->id,
                            'type' => $type,
                            'position' => $position,
                            'path' => 'escorts/' . $file_path,
                        ];
                        // $media = $this->media->updateOrCreate($data,$user->id,$position);
                        $noOfFilesInGallery++;
                        $media = $this->media->create($data);
                        $media_arr[$position]  = [
                            'escort_id' => $id,
                            'escort_media_id' => $media['id'],
                            'position' => $position,
                            'created_at' => date('Y-m-d H:i:s'),
                            // 'position' => $media['position'],
                        ];
                    } else {
                        $media_arr[$position]  = [
                            'escort_id' => $id,
                            'escort_media_id' => $media->id,
                            'position' => $position,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                    }
                }
            }
        } else {
            $errors .= "\nOpss... You have already 30 Images uploaded";
        }
        //********FILE UPLOAD AREA CLOSE**********//


        $escortImages = EscortGallery::where('escort_id', $id)->get();
        foreach ($escortImages as $escortImage) {
            if (isset($media_arr[$escortImage->position])) {
                $escortImage->escort_media_id = $media_arr[$escortImage->position]['escort_media_id'];
                $escortImage->updated_at = date('Y-m-d H:i:s');
                $escortImage->save();
                unset($media_arr[$escortImage->position]);
            }
        }
        foreach ($media_arr as $newRecord) {
            $gallery = new EscortGallery;
            $gallery->escort_id = $id;
            $gallery->escort_media_id = $newRecord['escort_media_id'];
            $gallery->position = $newRecord['position'];
            $gallery->created_at = date('Y-m-d H:i:s');
            $gallery->save();
        }

        return response()->json(compact('error'));
    }



    public function updateBasicProfile($id = null)
    {
        $latest = $this->escort->latest();
        $user = auth()->user();
        if ($id == null) {
            $update_id = $latest->id;
            $profile = $this->escort->findDefault($user->id, 1);
        } else {
            $update_id = $id;
            $profile = $this->escort->find($id);
        }
        //dd($latest->id);

        $path = $this->media->findByVideoposition(auth()->user()->id, 1)['path'];



        return view('escort.dashboard.profile.create-profile', compact('path', 'profile', 'update_id'));
    }

    public function updateProfile($id)
    {
        // dd($id);
        $escort = $this->escort->find($id);
        if ($escort->user_id != auth()->user()->id) {
            return redirect()->route('escort.list', 'current')->with('error', "This profile doesn't belongs to you");
        } else {
            // $poli_payment = Poli_transaction::where('MerchantReference',auth()->user()->member_id."_".$id)->latest()->first();
            //dd($poli_payment);
            $user = auth()->user();
            list($service_one, $service_two, $service_three) = $this->service->findByCategory([1, 2, 3]);
            $durations = $this->duration->all();
            $availability = $escort->availability;
            $service = $this->service;
            //dd($escort->nation);
            $path = $this->media->findByVideoposition(auth()->user()->id, 1)['path'];
            $media = $this->media->with_Or_withoutPosition(auth()->user()->id, [8, 10], $id);
            $users_for_available_playmate = $this->user->findPlaymates(auth()->user()->id);
            $defaultImages = $this->media->findDefaultMedia($user->id, 0);

            //dd($durations );

            return view('escort.dashboard.profile.update', compact('defaultImages', 'media', 'users_for_available_playmate', 'path', 'escort', 'service', 'availability', 'service_one', 'service_two', 'service_three', 'durations', 'user'));
        }
    }
    public function agentUpdateProfile($id, $uid)
    {

        $escort = $this->escort->find($id);
        // $poli_payment = Poli_transaction::where('MerchantReference',auth()->user()->member_id."_".$id)->latest()->first();
        //dd($poli_payment);
        $user = $this->user->find($uid);
        // $user = auth()->user();
        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1, 2, 3]);
        $durations = $this->duration->all();
        $availability = $escort->availability;
        $service = $this->service;
        //dd($escort->nation);
        $path = $this->media->findByVideoposition($user->id, 1)['path'];
        return view('agent.dashboard.profile.update', compact('path', 'escort', 'service', 'availability', 'service_one', 'service_two', 'service_three', 'durations', 'user'));
    }
    public function updatePolicy(UpdateRequestPolicy $request, $id)
    {
        $escort = $this->escort->find($id);
        $input = [
            'pricing_policy' => $request->pricing_policy,
            'disclaimer' => $request->disclaimer,
        ];
        $error = true;
        if (isset($request->pricing_policy) || isset($request->disclaimer)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }

        //return redirect()->back()->with('status','Record successfully inserted!..');
        return response()->json(compact('error'));
    }

    public function agentCreateBySetting(UpdateRequestAboutAll $request, $id = null, $uid = null)
    {

        $user = $this->user->find($uid);
        // $user = auth()->user();

        $my_data = [];
        //echo "draft ==".$request->draft;
        if (isset($request->draft)) {
            $my_data['draft'] = 1;
        }


        $user_days = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($user->created_at));


        //if(!empty($user->plan_type) && $user_days > 14 && $id == null &&  $user->plan_type == 4 && $request->membership == 4) {

        if (!empty($user->plan_type) && $id == null &&  $user->plan_type == 4 && $request->membership == 4) {

            $my_data['new_profile'] = 2;
            // dd($id);
            // dd($request->membership);
        } else {
            $my_data['change_amount'] = false;
            if (!empty($id) && $request->membership != 4) {

                $escort_data = $this->escort->find($id);
                if (Carbon::parse($escort_data->start_date)->format('Y-m-d') != $request->start_date || Carbon::parse($escort_data->end_date)->format('Y-m-d') != $request->end_date || $escort_data->membership != $request->membership) {
                    $my_data['change_amount'] = true;
                    $my_data['start_date'] = $request->start_date;
                    $my_data['end_date'] = $request->end_date;
                    $my_data['membership'] = $request->membership;
                    $my_data['enabled'] = 1;
                    //return redirect()->route('escort.poli.paymentUrl', [$id]);
                }
            }

            //dd("hii");
            $error = 0;

            $escort = $this->escort->findDefault($user->id, 1);
            $input = [
                'name' => $request->name ? $request->name : null,
                'city_id' => $request->city_id ? $request->city_id : null,
                'phone' => $request->phone ? $request->phone : null,
                'address' => $request->address ? $request->address : null,
                'state_id' => $request->state_id  ? $request->state_id : null,
                // 'start_date' => $request->start_date,
                // 'end_date' => $request->end_date,

                // 'membership'=>$request->membership ? $request->membership : null,
                //'gender'=>$request->gender ? $escort->getRawOriginal('gender') : NULL,
                'profile_name' => $request->profile_name ? $request->profile_name : null,
                'gender' => $request->gender ? $request->gender : NULL,
                'nationality_id' => $request->nationality_id ? $request->nationality_id : NULL,
                'height' => $request->height ? $request->height : NULL,
                'eyes' => $request->eyes ? $request->eyes : NULL,
                'orientation' => $request->orientation ? $request->orientation : NULL,
                'age' => $request->age ? $request->age : NULL,
                'hair_color' => $request->hair_color ? $request->hair_color : NULL,
                'skin_tone' => $request->skin_tone ? $request->skin_tone : NULL,
                'breast' => $request->breast ? $request->breast : NULL,
                'contact' => $request->contact ? $request->contact : NULL,
                'ethnicity' => $request->ethnicity ? $request->ethnicity : NULL,
                'body_type' => $request->body_type ? $request->body_type : NULL,
                'hair_style' => $request->hair_style ? $request->hair_style : NULL,
                'weight' => $request->weight ? $request->weight : NULL,
                'dress_size' => $request->dress_size ? $request->dress_size : NULL,
                'shaved' => $request->shaved ? $request->shaved : NULL,
                'covidreport' => $request->covidreport ? $request->covidreport : NULL,
                'piercing' => $request->piercing ? $request->piercing : NULL,
                'drugs' => $request->drugs ? $request->drugs : NULL,
                'travel' => $request->travel ? $request->travel : NULL,
                'tattoos' => $request->tattoos ? $request->tattoos : NULL,
                'smoke' => $request->smoke ? $request->smoke : NULL,
                'available_to' => $request->available_to ? $request->available_to : NULL,
                'license' => $request->license ? $request->license : NULL,
                'play_type' => $request->play_type ? $request->play_type : NULL,
                'payment_type' => $request->payment_type ? $request->payment_type : NULL,
                'language' => $request->language ? $request->language : NULL,
                'social_links' => $request->social_links ? $request->social_links : NULL,
                // 'enabled'=>1,
                'user_id' => $user->id,
                'default_setting' => 0,
                'about' => $request->about ? $request->about : null,
                'about_title' => $request->about_title ? $request->about_title : null,
            ];

            if ($request->membership == 4) {
                $input['start_date'] = $request->start_date;
                $input['end_date'] = $request->end_date;
                $input['membership'] = $request->membership;
                $input['enabled'] = 1;
            }

            if ($new_escort = $this->escort->store($input, $id)) {
                if (isset($request->draft)) {
                    $new_escort->enabled = 2;
                    // $new_escort->start_date = $request->start_date;
                    // $new_escort->end_date = $request->end_date;
                    // $new_escort->membership = $request->membership;
                    // $new_escort->enabled = 1;
                    $new_escort->save();
                }
                $escortId = $new_escort->id;
                $error = 1;
                $my_data['new_profile'] = 1;
                $my_data['escortId'] = $escortId;
                if ($request->membership != 4) {
                    $my_data['change_amount'] = true;
                    $my_data['start_date'] = $request->start_date;
                    $my_data['end_date'] = $request->end_date;
                    $my_data['membership'] = $request->membership;
                    $my_data['enabled'] = 1;
                }
                $user->plan_type = $request->membership;
                $user->save();
            }

            $arr = [];

            foreach ($request->duration_id as $key => $value) {
                //dd($durations->pivot);
                // $id = $durations->pivot->duration_id;
                // $arr[$id] = [
                //     'massage_price' => $durations->pivot->massage_price,
                //     'incall_price' => $durations->pivot->incall_price,
                //     'outcall_price' => $durations->pivot->outcall_price,
                // ];
                $arr  += [
                    $value => [
                        "massage_price" => $request->massage_price[$key],
                        "incall_price" => $request->incall_price[$key],
                        "outcall_price" => $request->outcall_price[$key]
                    ],
                ];
            }

            //dd($arr);
            if ($data_durations  = $new_escort->durations()->sync($arr)) {
                $error = 1;
            }
            $data = [];
            if (!empty($request->mon_hh_from)) {
                $data  += [
                    "monday_from" => $this->parseTime($request->mon_hh_from, $request->mon_mm_from, $request->mon_time_from),
                    "monday_to" => $this->parseTime($request->mon_hh_to, $request->mon_mm_to, $request->mon_time_to),
                ];
            } else {
                $data  += [
                    "monday_from" => null,
                    "monday_to" => null,
                ];
            }
            if (!empty($request->tue_hh_from)) {
                $data  += [
                    "tuesday_from" => $this->parseTime($request->tue_hh_from, $request->tue_mm_from, $request->tue_time_from),
                    "tuesday_to" => $this->parseTime($request->tue_hh_to, $request->tue_mm_to, $request->tue_time_to),
                ];
            } else {
                $data  += [
                    "tuesday_from" => null,
                    "tuesday_to" => null,
                ];
            }
            if (!empty($request->wed_hh_from)) {
                $data  += [
                    "wednesday_from" => $this->parseTime($request->wed_hh_from, $request->wed_mm_from, $request->wed_time_from),
                    "wednesday_to" => $this->parseTime($request->wed_hh_to, $request->wed_mm_to, $request->mon_time_to),
                ];
            } else {
                $data  += [
                    "wednesday_from" => null,
                    "wednesday_to" => null,
                ];
            }
            if (!empty($request->thu_hh_from)) {
                $data  += [
                    "thursday_from" => $this->parseTime($request->thu_hh_from, $request->thu_mm_from, $request->thu_time_from),
                    "thursday_to" => $this->parseTime($request->thu_hh_to, $request->thu_mm_to, $request->thu_time_to),
                ];
            } else {
                $data  += [
                    "thursday_from" => null,
                    "thursday_to" => null,
                ];
            }
            if (!empty($request->fri_hh_from)) {
                $data  += [
                    "friday_from" => $this->parseTime($request->fri_hh_from, $request->fri_mm_from, $request->fri_time_from),
                    "friday_to" => $this->parseTime($request->fri_hh_to, $request->fri_mm_to, $request->fri_time_to),
                ];
            } else {
                $data  += [
                    "friday_from" => null,
                    "friday_to" => null,
                ];
            }
            if (!empty($request->sat_hh_from)) {
                $data  += [
                    "saturday_from" => $this->parseTime($request->sat_hh_from, $request->sat_mm_from, $request->sat_time_from),
                    "saturday_to" => $this->parseTime($request->sat_hh_to, $request->sat_mm_to, $request->sat_time_to),
                ];
            } else {
                $data  += [
                    "saturday_from" => null,
                    "saturday_to" => null,
                ];
            }
            if (!empty($request->sun_hh_from)) {
                $data  += [
                    "sunday_from" => $this->parseTime($request->sun_hh_from, $request->sun_mm_from, $request->sun_time_from),
                    "sunday_to" => $this->parseTime($request->sun_hh_to, $request->sun_mm_to, $request->sun_time_to),
                ];
            } else {
                $data  += [
                    "sunday_from" => null,
                    "sunday_to" => null,
                ];
            }
            if (!empty($request->availability_time)) {
                $data  += [
                    "availability_time" => $request->availability_time,
                ];
            }
            $data  += [
                "escort_id" => $escortId,
            ];
            //dd($data);
            //$escort = $this->escort->find($escortId);
            $availability = $new_escort->availability;


            if ($data_massage_availability = $this->availability->store($data, $availability ? $availability->id : null)) {
                $my_data['new_availability'] = 1;
            }



            $service_arr = [];

            if (!empty($request->service_id)) {
                foreach ($request->service_id as $key => $value) {
                    $service_arr  += [$value => ["price" => $request->price[$key]]];
                }
            }
            //dd($arr);

            if ($data_service = $new_escort->services()->sync($service_arr)) {
                $my_data['new_services'] = 1;
            }


            //dd($request->file('img'));
            $media_arr = [];
            if ($request->hasFile('img')) {
                $names = [];

                foreach ($request->file('img') as $position => $image) {

                    $mime = $image->getMimeType();
                    if (strstr($mime, "video/")) {
                        $prefix = 'videos/';
                        $type = 1;  //0=>image; 1=>video
                    } else {
                        $prefix = 'images/';
                        $type = 0;
                    }
                    list($width, $height) = getimagesize($image);
                    //list($type, $prefix) = $this->getPrefix($image);
                    $file_path = $prefix . $user->id . '/' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                    //dd($file_path);
                    Storage::disk('escorts')->put($file_path, file_get_contents($image));

                    if (!$media = $this->media->findByPath('escorts/' . $file_path)) {
                        $data = [
                            'user_id' => $user->id,
                            'type' => $type,
                            //'position' => $position,
                            'path' => 'escorts/' . $file_path,
                        ];
                        // $media = $this->media->updateOrCreate($data,$user->id,$position);
                        if ($this->media->get_user_row($user->id)->count() < 30) {
                            $media = $this->media->create($data);
                            $media_arr[]  = [
                                'escort_media_id' => $media['id'],
                                'position' => $position,
                                // 'position' => $media['position'],
                            ];
                        } else {
                            $my_data['msg'] = "Opss... There are 30 Images";
                        }


                        //echo "mmid=".$media['id'];
                    } else {
                        $media_arr[]  = [
                            'escort_media_id' => $media->id,
                            'position' => $position,
                        ];
                        //echo "elseid=".$media->id;
                    }
                    $my_data['status'] = 200;
                    //$destinationPath = 'content_images/';
                    // $filename = $image->getClientOriginalName();
                    // $image->move($file_path, $filename);
                    // array_push($names, $filename);
                }
            }
            //dd($media_arr);

            if ($request->position) {
                foreach ($request->position as $position) {

                    if ($media = $this->media->find($position)) {
                        $media_arr[]  = [
                            'escort_media_id' => $media->id,
                            'position' => $media->position,
                        ];
                        //echo  "id =".$media->id."--p=".$media->position."</br>";
                    }
                }
            }

            if ($this->media->get_user_row($user->id)->count() <= 30) {
                foreach ($media_arr as $key => $value) {
                    $result = EscortGallery::where('position', $value['position'])
                        //->where('massage_media_id',$value['massage_media_id'])
                        ->where('escort_id', $escortId)
                        ->delete();
                }
            }
            $new_escort->gallary()->syncWithoutDetaching($media_arr);

            //$my_data['poliLink'] = route('escort.poli.paymentUrl', [$escortId]);

            $my_data['url'] = route('agentby.update.profile', [$escortId, $uid]);
            $my_data['uid'] = $uid;
        }
        return response()->json(compact('my_data'));
        //return redirect()->route('escort.poli.paymentUrl', [$massage_profile_id]);

        //return response()->json(compact('error','escortId'));
        //return redirect()->route('escort.update.profile', [$escortId]);
    }

    public function storeAboutMe(UpdateRequestAboutMe $request, $id)
    {

        $input = [
            'gender' => $request->gender,
            'nationality_id' => $request->nationality_id,
            //'statistics'=>$request->statistics,
            'height' => $request->height,
            'eyes' => $request->eyes,
            'orientation' => $request->orientation,
            'age' => (int)$request->age,
            'hair_color' => $request->hair_color,
            'skin_tone' => $request->skin_tone,
            'breast' => $request->breast,
            'contact' => $request->contact,
            'ethnicity' => $request->ethnicity,
            'body_type' => $request->body_type,
            'hair_style' => $request->hair_style,
            'weight' => $request->weight,
            'dress_size' => $request->dress_size,
            'profile_name' => $request->profile_name,
            'membership' => $request->membership,
            'shaved' => $request->shaved,
            'endowment' => $request->endowment,
            'thickness' => $request->thickness,
            'circumcised' => $request->circumcised,
            'butt' => $request->butt,
            'preference' => $request->preference,
            'hormones' => $request->hormones,
            //'covidreport' => $request->covidreport,
        ];
        $user = auth()->user();
        $escort = $this->escort->findDefault($user->id, 1);
        if ($escort->id == $id) {
            $id = null;
            $input['user_id'] = $user->id;
        }

        $request->start_date ? $input['start_date'] = $request->start_date : NULL;
        $request->end_date ? $input['end_date'] = $request->end_date : NULL;
        $error = true;

        if ($escort = $this->escort->store($input, $id)) {
            $error = false;
            if ($request->file('banner_image')) $this->uploadFile($request->file('banner_image'), $escort);
            if ($request->file('banner_video')) $this->uploadFile($request->file('banner_video'), $escort);
        }

        if (($escort->covidreport == 1 || $escort->covidreport == 2) && $request->file('covid_report_file')) {
            $this->uploadCovidReport($request->file('covid_report_file'), $escort->id);
        } else {
            $escort->covidReport()->delete();
        }

        return response()->json(compact('escort', 'error'));
    }

    public function uploadCovidReport($file, $escort_id)
    {
        $file_path = 'escort-covid-report/' . $escort_id . '/' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        Storage::disk('escorts')->put($file_path, file_get_contents($file));

        $data = [
            'escort_id' => $escort_id,
            'path' => 'escorts/' . $file_path,
        ];

        EscortCovidReport::create($data);

        return true;
    }

    public function storeReadMore(UpdateRequestReadMore $request, $id)
    {
        $input = [
            'piercing' => $request->piercing,
            'drugs' => $request->drugs,
            'travel' => $request->travel,
            'tattoos' => $request->tattoos,
            'smoke' => $request->smoke,
            'available_to' => $request->available_to,
            'license' => $request->license,
            'play_type' => $request->play_type,
            'payment_type' => $request->payment_type,

        ];
        $request->language ? $input['language'] = $request->language : NULL;
        $error = true;
        if ($data = $this->escort->store($input, $id)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }
    public function storeAbout(UpdateRequestAbout $request, $id)
    {
        $input = [
            'about' => $request->about,
        ];

        if (isset($request->about_title)) {
            $input['about_title'] = $request->about_title;
        }


        $error = true;
        if (isset($request->about)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function createProfile(StoreRequest $request)
    {

        $input = [
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'pincode' => $request->pincode,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'social_links' => $request->social_links,
            'user_id' => auth()->user()->getMemberIdAttribute(),
            'enabled' => 1,
        ];

        $error = true;
        if ($data = $this->escort->store($input, $id = null)) {
            $error = false;
            $url = route('update.profile', [$data->id]);
        }
        return response()->json(compact('data', 'error', 'url'));
    }

    public function storeServices(StoreServiceRequest $request,  $id)
    {
        $escort = $this->escort->find($id);
        $arr = [];
        if (!empty($request->service_id)) {
            foreach ($request->service_id as $key => $value) {
                $arr += [$value => ["price" => $request->price[$key]]];
            }
        }

        $error = true;
        if ($data = $escort->services()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }
    public function storeRates(StoreRateRequest $request, $id)
    {
        $escort = $this->escort->find($id);
        $arr = [];
        foreach ($request->duration_id as $key => $value) {
            $arr  += [
                $value => [
                    "massage_price" => $request->massage_price[$key],
                    "incall_price" => $request->incall_price[$key],
                    "outcall_price" => $request->outcall_price[$key]
                ],
            ];
        }
        $error = true;
        if ($data = $escort->durations()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }

    public function parseTime($hour, $minutes, $meridian)
    {
        if (($hour && $minutes && $meridian) == null) {
            return null;
        } else {
            return Carbon::createFromFormat('g:i A', $hour . ":" . $minutes . " " . $meridian)->toTimeString();
        }
    }

    public function storeAvailability(StoreAvailabilityRequest $request, $escortId)
    {
        $data = [];
        $shortDays = config('escorts.days.short_form');
        foreach ($shortDays as $day => $shortDay) {
            if (!empty($request->{$shortDay . "_from"})) {
                $data  += [
                    $day . "_from" => date('H:i:s', strtotime($request->{$shortDay . "_from"} . $request->{$shortDay . "_time_from"})),
                    $day . "_to" => date('H:i:s', strtotime($request->{$shortDay . "_to"} . $request->{$shortDay . "_time_to"}))
                ];
            } else {
                $data  += [
                    $day . "_from" => null,
                    $day . "_to" => null,
                ];
            }
        }
        if (!empty($request->availability_time)) {
            $data  += [
                "availability_time" => $request->availability_time,
            ];
        }

        $escort = $this->escort->find($escortId);
        $availability = $escort->availability;
        $error = true;
        if ($data = $this->availability->store($data, $availability ? $availability->id : null)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }
    public function deleteProfile($id)
    {
        $escort = $this->escort->find($id);

        $escort->services()->sync([]);
        $escort->durations()->sync([]);
        $escort->medias()->delete();
        $escort->images()->delete();
        $escort->videos()->delete();
        $escort->messages()->delete();
        $this->escort->destroy($id);
        $error = 1;


        return response()->json(compact('error'));
    }
    public function saveMembership(Request $request, $id)
    {
        $escort = $this->escort->find($id);
        $data = [];
        $enable = [];
        $data = ['plan_type' => $request->plan_type];
        $enable = ['enabled' => 1];
        $user = $this->user->store($data, $escort->user_id);
        $escort_update = $this->escort->store($enable, $id);
        $error = 1;


        return response()->json(compact('error'));
    }

    public function uploadFile($attachment, $escort)
    {
        $escort_id = $escort->id;

        list($type, $prefix) = $this->getPrefix($attachment);

        $file_path = $prefix . $escort_id . '/banner/' . Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $attachment->getClientOriginalExtension();
        Storage::disk('escorts')->put($file_path, file_get_contents($attachment));

        if (!$media = $this->media->findByPath('escorts/' . $file_path)) {
            $data = [
                'escort_id' => $escort_id,
                'type' => $type,
                'path' => 'escorts/' . $file_path,
            ];
            $media = $this->media->store($data);
        }

        return true;
    }

    public function getPrefix($file)
    {
        $mime = $file->getMimeType();
        if (strstr($mime, "video/")) {
            $str = 'videos/';
            $type = 3;  //2=>image; 3=>video (banner)
        } else {
            $str = 'images/';
            $type = 2;  //2=>image; 3=>video (banner)
        }
        return [$type, 'attatchment/' . $str];
    }

    public function duplicateProfile(Request $request)
    {
        $escort_id = $request->escort_id;
        $escortDefault = $this->escort->find($escort_id);
        $user = auth()->user();
        $stage_name = $request->duplicate_profile ? $request->name : ($escortDefault->name ?: null);
        $error = '';
        if(isset($request->duplicate_profile) && $request->duplicate_profile == "duplicate"){
          $existWithStageName = Escort::where(['user_id' => $user->id, 'profile_name' => $request->profile_name])->first();
          if (!empty($existWithStageName)) {
            $error = 'Profilename already exist';
        }
        } else {
        $existWithStageName = Escort::where(['user_id' => $user->id, 'name' => $stage_name, 'city_id' => $request->city_id])->first();
        if (!empty($existWithStageName)) {
            $error = 'Profile with same stage name and with same location already exist';
        }
    }
        if (empty($error)) {
            $input = [
                'name' => $stage_name,
                'city_id' => $request->city_id ? $request->city_id : ($escortDefault->city_id ?: null),
                'phone' => $request->phone ? $request->phone : ($escortDefault->phone ?: null),
                'address' => $request->address ? $request->address : ($escortDefault->address ?: null),
                'state_id' => $request->state_id  ? $request->state_id : ($escortDefault->state_id ?: null),
                'playmate' => $request->playmate  ? $request->playmate : 'N',
                'start_date' => null,
                'end_date' => null,
                'profile_name' => $request->profile_name ? $request->profile_name : ($escortDefault->profile_name ?: null),
                'gender' => $request->gender ? $request->gender : ($escortDefault->GenderType ?: NULL),
                'nationality_id' => $request->nationality_id ? $request->nationality_id : ($escortDefault->nationality_id ?: NULL),
                'height' => $request->height ? $request->height : ($escortDefault->height ?: NULL),
                'eyes' => $request->eyes ? $request->eyes : ($escortDefault->eyes ?: NULL),
                'orientation' => $request->orientation ? $request->orientation : ($escortDefault->orientation ?: NULL),
                'age' => $request->age ? $request->age : ($escortDefault->age ?: NULL),
                'hair_color' => $request->hair_color ? $request->hair_color : ($escortDefault->hair_color ?: NULL),
                'skin_tone' => $request->skin_tone ? $request->skin_tone : ($escortDefault->skin_tone ?: NULL),
                'breast' => $request->breast ? $request->breast : ($escortDefault->breast ?: NULL),
                'endowment' => $request->endowment ? $request->endowment : ($escortDefault->endowment ?: NULL),
                'thickness' => $request->thickness ? $request->thickness : ($escortDefault->thickness ?: NULL),
                'circumcised' => $request->circumcised ? $request->circumcised : ($escortDefault->circumcised ?: NULL),
                'butt' => $request->butt ? $request->butt : ($escortDefault->butt ?: NULL),
                'preference' => $request->preference ? $request->preference : ($escortDefault->preference ?: NULL),
                'hormones' => $request->hormones ? $request->hormones : ($escortDefault->hormones ?: NULL),
                'contact' => $request->contact ? $request->contact : ($escortDefault->contact ?: NULL),
                'ethnicity' => $request->ethnicity ? $request->ethnicity : ($escortDefault->ethnicity ?: NULL),
                'body_type' => $request->body_type ? $request->body_type : ($escortDefault->body_type ?: NULL),
                'hair_style' => $request->hair_style ? $request->hair_style : ($escortDefault->hair_style ?: NULL),
                'weight' => $request->weight ? $request->weight : ($escortDefault->weight ?: NULL),
                'dress_size' => $request->dress_size ? $request->dress_size : ($escortDefault->dress_size ?: NULL),
                'shaved' => $request->shaved ? $request->shaved : ($escortDefault->shaved ?: NULL),
                'covidreport' => $request->covidreport ? $request->covidreport : ($escortDefault->covidreport ? $escortDefault->getRawOriginal('covidreport') : NULL),
                'piercing' => $request->piercing ? $request->piercing : ($escortDefault->piercing ?: NULL),
                'drugs' => $request->drugs ? $request->drugs : ($escortDefault->drugs ?: NULL),
                'travel' => $request->travel ? $request->travel : ($escortDefault->travel ?: NULL),
                'tattoos' => $request->tattoos ? $request->tattoos : ($escortDefault->tattoos ?: NULL),
                'smoke' => $request->smoke ? $request->smoke : ($escortDefault->smoke ?: NULL),
                'available_to' => $request->available_to ? $request->available_to : ($escortDefault->available_to ?: NULL),
                'license' => $request->license ? $request->license : ($escortDefault->license ?: NULL),
                'play_type' => $request->play_type ? $request->play_type : ($escortDefault->play_type ?: NULL),
                'payment_type' => $request->payment_type ? $request->payment_type : ($escortDefault->payment_type ?: NULL),
                'language' => $request->language ? $request->language : ($escortDefault->language ?: NULL),
                'social_links' => $request->social_links ? $request->social_links : ($escortDefault->social_links ?: NULL),
                'enabled' => 0,
                'user_id' => $user->id,
                'default_setting' => 0,
                'about' => $request->about ? $request->about : ($escortDefault->about ?: null),
                'about_title' => $request->about_title ? $request->about_title : ($escortDefault->about_title ?: null),
            ];

            if ($escort = $this->escort->store($input, null)) {
                if (!empty(trim($request->name)) && !empty(trim($request->update_stage_name))) {

                    $users = $this->user->find($user->id);

                    $escortNames = $users->escorts_names;
                    if ($escortNames == NULL || !in_array($request->name, $escortNames)) {
                        $escortNames[] = trim($request->name);
                        $users->escorts_names = $escortNames;
                        $users->save();
                    }
                }
                /**
                 * Copy Escort Profile Images..
                 */
                $escortImages = EscortGallery::where('escort_id', $escort_id)->get();
                foreach ($escortImages as $image) {
                    $gallery = new EscortGallery;
                    $gallery->escort_id = $escort->id;
                    $gallery->escort_media_id = $image['escort_media_id'];
                    $gallery->position = $image['position'];
                    $gallery->created_at = date('Y-m-d H:i:s');
                    $gallery->save();
                }
                /**
                 * Copy Escort Profile Availability...
                 */
                $sourceEscort = Escort::with('availability')->find($escort_id);
                if ($sourceEscort && $sourceEscort->availability) {
                    $newAvailability = $sourceEscort->availability->replicate();
                    $escort->availability()->save($newAvailability);
                }

                /**
                 * Copy Escort Profile Services...
                 */

                $sourceEscort = Escort::with('services')->find($escort_id);
                $service_arr = [];
                foreach ($sourceEscort->services as $service) {
                    $service_arr[$service->id] = [
                        'price' => $service->pivot->price ?? null
                    ];
                }
                $escort->services()->sync($service_arr);
                /**
                 * Copy Escort Rates...
                 */
                $sourceEscort = Escort::with('durations')->find($escort_id);
                $duration_arr = [];
                foreach ($sourceEscort->durations as $duration) {
                    $duration_arr[$duration->id] = [
                        'massage_price' => $duration->pivot->massage_price ?? null,
                        'incall_price' => $duration->pivot->incall_price ?? null,
                        'outcall_price' => $duration->pivot->outcall_price ?? null
                    ];
                }
                $escort->durations()->sync($duration_arr);


                $response = [
                    'success' => true,
                    'message' => 'Profile has been created for the selected location.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Profile Duplication failed.'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => $error
            ];
        }
        return response()->json(compact('response'));
    }

    public function checkProfileName(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $profile_name =  $request->input('profile_name');
        $escort_id =  $request->input('escort_id');
        $query = Escort::where('user_id', $user_id)
            ->where('profile_name', $profile_name);

        if (!empty($escort_id)) {
            $query->where('id', '!=', $escort_id);
        }

        $exists = $query->exists();
        return  $exists ? response()->json(false, 422) : response()->json(true, 200);
    }
}
