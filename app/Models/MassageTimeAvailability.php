<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MassageTimeAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
    'purchase_id',
    'masseur_id',
    'masseur_availibility',
    'massage_profile_id',
    'massage_availibility',
];


    public function masseur()
    {
        return $this->hasOne(Masseur::class,  'id','masseur_id');
    }



    public static function  saveOrUpdateAvailability($purchaseId, array $data)
    {

       try 
       {

                Log::info($purchaseId);
                Log::info($data);

                $updateData = [];

                if (isset($data['masseur_id']) || isset($data['masseur_availibility'])) {
                    $updateData['masseur_id'] = $data['masseur_id'] ?? null;
                    $updateData['masseur_availibility'] = is_array($data['masseur_availibility'] ?? null)
                        ? json_encode($data['masseur_availibility'])
                        : ($data['masseur_availibility'] ?? null);

                     $availability =  MassageTimeAvailability::where(['purchase_id' => $purchaseId, 'masseur_id' => $data['masseur_id']])->first();  
                     if ($availability) 
                     {
                        $availability->massage_availibility = $updateData['masseur_availibility'];
                        $availability->save();
                     }
                     else
                     {
                        MassageTimeAvailability::create([

                            'purchase_id' => $purchaseId,
                            'masseur_availibility' => $updateData['masseur_availibility'],
                            'masseur_id' => $updateData['masseur_id'],

                        ]); 
                     }

                }

            
                if (isset($data['massage_profile_id']) || isset($data['massage_availibility'])) 
                {
                    $updateData['massage_profile_id'] = $data['massage_profile_id'] ?? null;
                    $updateData['massage_availibility'] = is_array($data['massage_availibility'] ?? null)
                        ? json_encode($data['massage_availibility'])
                        : ($data['massage_availibility'] ?? null);

                    $availability =  MassageTimeAvailability::where(['purchase_id' => $purchaseId, 'massage_profile_id' => $data['massage_profile_id']])->first();  
                    if ($availability ) 
                    {
                    $availability->massage_availibility = $updateData['massage_availibility'];
                    $availability->save();
                    }
                    else
                    {
                    MassageTimeAvailability::create([
                        'purchase_id' => $purchaseId,
                        'massage_availibility' => $updateData['massage_availibility'],
                        'massage_profile_id' => $updateData['massage_profile_id'],

                    ]); 
                    }


                }

                // return MassageTimeAvailability::updateOrCreate(
                //     ['purchase_id' => $purchaseId],
                //     $updateData
                // );


       } catch (\Throwable $e) {
         Log::info($e->getMessage());
       }

    }



    public static function makeProfleTimeAvalibility($massage_profile_id, $purchase_id)
    {
         
        Log::info('massage_profile_id '. $massage_profile_id);
        Log::info('purchase_id '.$purchase_id);


        try 
        {
            $masseurIds = MassagerMasseur::where('massage_profile_id', $massage_profile_id)->pluck('masseur_profile_id');  
            $messures = Masseur::whereIn('id', $masseurIds)->get();
            $massage_avail  = MassageAvailability::where('massage_profile_id', $massage_profile_id)->first();

             foreach ($messures as $messure) 
             {
                if($purchase_id!="")
                {
                    $data = [];

                    $availabilityTime = is_string($massage_avail->availability_time) 
                    ? json_decode($massage_avail->availability_time, true) 
                    : $massage_avail->availability_time;

                    $availability_time = json_decode($massage_avail->availability_time, true);
                    $data['masseur_id'] = $messure->id;
                    $data['masseur_availibility'] =  $messure->availability;
                    $data['massage_profile_id'] = $massage_profile_id;
                    $data['massage_availibility'] = $availabilityTime ;
                    self::saveOrUpdateAvailability($purchase_id, $data);
                }
            }


        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }

    }

}
