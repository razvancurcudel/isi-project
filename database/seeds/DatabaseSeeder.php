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
        $this->call(NgosTableSeeder::class);
        DB::table("users")->insert([
            'name' => "user",
            "email" => "user@gmail.com",
            "password" => bcrypt("secret"),
            "ngo_id" => 1
        ]);
    }
}
