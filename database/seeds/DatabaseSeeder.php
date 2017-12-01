<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SensorsTableSeeder::class);
//        DB::table("users")->insert([
//            'name' => "razvan",
//            "email" => "razvan@gmail.com",
//            "password" => bcrypt("secret")
//        ]);
    }
}
