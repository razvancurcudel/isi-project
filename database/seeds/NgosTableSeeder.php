<?php

use Illuminate\Database\Seeder;

class NgosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ngos')->insert(
            [
                'name' => "ONG 1",
            ],
            [
                'name' => "ONG 2",
            ],
            [
                'name' => "ONG 3",
            ],
            [
                'name' => "ONG 4",
            ]
        );
    }
}
