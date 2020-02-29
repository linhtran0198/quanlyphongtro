<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotelRoomTableSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motelrooms')->insert([
            'title' => str_random(10),
            'description' => str_random(10),
            'price' => str_random(10),
            'area' => str_random(10),
            'count_view' => str_random(10),
            'address' => str_random(10),
            'latlng' => str_random(10),
            'images' => '{"0":"no_img_room.png"}',
            'user_id' => '5',
            'category_id' => '1',
            'district_id' => '7',
            'utilities' => str_random(10),
            'phone' => str_random(10),
            'approve' => '1',
            'slug' => str_random(10),
        ]);
    }
}
