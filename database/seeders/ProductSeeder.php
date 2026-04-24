<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('products')->insert([
      ['code' => 'CM01',  'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>Pure Pink', 'qty' => 144, 'size' => "54mm", 'price' => 45, 'image' => 'services/img1.png', 'color' => "Pure Pink", 'created_at' => now(), 'updated_at' => now()],
      ['code' => 'CM02',  'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>Closer Fit', 'qty' => 144, 'size' => "49mm", 'price' => 45, 'image' => 'services/img1.png', 'color' => "Closer Fit", 'created_at' => now(), 'updated_at' => now()],
      ['code' => 'CM03',  'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>Large', 'qty' => 144, 'size' => "60mm", 'price' => 45, 'image' => 'services/img1.png', 'color' => "Large", 'created_at' => now(), 'updated_at' => now()],
      ['code' => 'CM04', 'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>King Size', 'qty' => 144, 'size' => "64mm", 'price' => 50, 'image' => 'services/img1.png', 'color' => "King Size", 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM05', 'description' => '<strong>Lifestyles - Bulk pack</strong><br>Regular', 'qty' => 144, 'size' => "53mm", 'price' => 45, 'image' => 'services/img1.png', 'color' => "Regular", 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM06', 'description' => '<strong>Glyde Maxi - bulk pack</strong><br>Gold', 'qty' => 100, 'size' => "56mm", 'price' => 35, 'image' => 'services/img1.png', 'color' => "Gold", 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM07', 'description' => '<strong>Wet Stuff - Lubricant</strong><br>Gold', 'qty' => 1, 'size' => "550g", 'price' => 30, 'image' => 'services/img1.png', 'color' => "Gold", 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM08', 'description' => '<strong>Four Seasons - Lubricant</strong><br>Pure Water Based Personal', 'qty' => 1, 'size' => "500ml", 'price' => 25, 'image' => 'services/img1.png', 'color' => "Pure Water Based Personal", 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM09', 'description' => '<strong>Beppy - pack of 10 </strong><br>Wet sponges', 'qty' => 1, 'size' => "N/A", 'price' => 50, 'image' => 'services/img1.png', 'color' => "Wet sponges", 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM10', 'description' => '<strong>Soft Tampons - pack of 10 </strong><br>Sponges', 'qty' => 1, 'size' => "N/A", 'price' => 40, 'image' => 'services/img1.png', 'color' => "Sponges", 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
