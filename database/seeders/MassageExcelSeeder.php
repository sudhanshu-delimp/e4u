<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MassageExcel;

class MassageExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['abbr' => 'WA', 'id' => 3906, 'name' => 'Western Australia'],
            ['abbr' => 'VIC', 'id' => 3903, 'name' => 'Victoria'],
            ['abbr' => 'NSW', 'id' => 3909, 'name' => 'New South Wales'],
        ];

        foreach ($states as $state) {
            MassageExcel::factory()
                ->count(600)
                ->state([
                    'state_abbr' => $state['abbr'],
                    'state_id' => $state['id'],
                    'territory_name' => $state['name'],
                ])
                ->create();
        }
    }
}
