<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MassageMediasBannerTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('massage_medias')->insert([
            [
                'type'      => 0,
                'banner_group'  => '1',
                'path'      => 'massageProfile/images/template/banner/default/mc_banner_1.jpg',
                'template'     => '1',
                'position' => 9,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
