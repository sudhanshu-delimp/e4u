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
      ['code' => 'CM01',  'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>Pure Pink', 'qty' => 144, 'size' => "54mm", 'price' => 45, 'image' => 'pure-pink.jpg',  'created_at' => now(), 'updated_at' => now()],
      ['code' => 'CM02',  'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>Closer Fit', 'qty' => 144, 'size' => "49mm", 'price' => 45, 'image' => 'four_seasons_naked_closerFit.jpg', 'created_at' => now(), 'updated_at' => now()],
      ['code' => 'CM03',  'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>Large', 'qty' => 144, 'size' => "60mm", 'price' => 45, 'image' => 'four_seasons_naked_larger.jpg', 'created_at' => now(), 'updated_at' => now()],
      ['code' => 'CM04', 'description' => '<strong>Four Seasons - Naked bulk pack</strong><br>King Size', 'qty' => 144, 'size' => "64mm", 'price' => 50, 'image' => 'four_seasons_naked_king_size.jpg', 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM05', 'description' => '<strong>Lifestyles - Bulk pack</strong><br>Regular', 'qty' => 144, 'size' => "53mm", 'price' => 45, 'image' => 'lifestyle_reg.jpg',  'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM06', 'description' => '<strong>Glyde Maxi - bulk pack</strong><br>Gold', 'qty' => 100, 'size' => "56mm", 'price' => 35, 'image' => 'glyde_maxi_gold.jpg', 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM07', 'description' => '<strong>Wet Stuff - Lubricant</strong><br>Gold', 'qty' => 1, 'size' => "550g", 'price' => 30, 'image' => 'wet-stuff-gold-550g-pump-lubricant.png', 'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM08', 'description' => '<strong>Four Seasons - Lubricant</strong><br>Pure Water Based Personal', 'qty' => 1, 'size' => "500ml", 'price' => 25, 'image' => 'lube500ml.jpg',  'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM09', 'description' => '<strong>Beppy - pack of 10 </strong><br>Wet sponges', 'qty' => 1, 'size' => "N/A", 'price' => 50, 'image' => 'Beppy-Wet-Sponge.jpg',   'created_at' => now(), 'updated_at' => now()],

      ['code' => 'CM10', 'description' => '<strong>Soft Tampons - pack of 10 </strong><br>Sponges', 'qty' => 1, 'size' => "N/A", 'price' => 40, 'image' => 'Soft-Tampons_sponges packof10.png', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
