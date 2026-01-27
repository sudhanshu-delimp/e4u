<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MassageProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class makeDefaultMassagers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         

            DB::table('massage_services')->truncate();
            DB::table('massage_rate')->truncate();
            DB::table('massage_availability')->truncate();
            DB::table('massage_profiles')->truncate();
            DB::table('massage_medias')->truncate();
            DB::table('massage_gallery')->truncate();

            
            
            $users = User::where('type', '4')->get();
            foreach ($users as $user) 
            {
                $exists = MassageProfile::where('user_id', $user->id)->exists();
                if (!$exists) {
                    MassageProfile::create([
                        'user_id' => $user->id,
                        'default_setting' => 1,
                        'enabled' => 1,
                    ]);
                }
            }
    }
}
