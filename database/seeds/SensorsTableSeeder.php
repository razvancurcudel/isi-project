<?php

use Illuminate\Database\Seeder;

class SensorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::raw("ALTER TABLE sensors set AUTO_INCREMENT = 1");
        DB::table('sensors')->insert([
            [
                "collection_point" => "Hidrocentrala Mandra",
                "lat" => 45.84759,
                "long" => 25.05178,
                "nitrate" => 17.93,
                "ph" => 7.38,
                "conductivity" => 304,
                "salinity" => 0.1,
                "turbidity" => 15.1,
                "tds" => 144,
                "gh" => 19.1,
                "identifier" => 1
            ],
            [
                "collection_point" => "Paraul Berivoi",
                "lat" => 45.83003,
                "long" => 24.96581,
                "nitrate" => 15,
                "ph" => 6.83,
                "conductivity" => 128.9,
                "salinity" => 0.1,
                "turbidity" => 0.07,
                "tds" => 61,
                "gh" => 13.2,
                "identifier" => 2
            ],
            [
                "collection_point" => "Paraul Beclean",
                "lat" => 45.83531,
                "long" => 24.92121,
                "nitrate" => 21.62,
                "ph" => 6.04,
                "conductivity" => 96.3,
                "salinity" => 0,
                "turbidity" => 0.4,
                "tds" => 46,
                "gh" => 12.1,
                "identifier" => 3
            ],
            [
                "collection_point" => "Hidrocentrala Voila",
                "lat" => 45.84315,
                "long" => 24.89262,
                "nitrate" => 36.28,
                "ph" => 7.5,
                "conductivity" => 309,
                "salinity" => 0.1,
                "turbidity" => 5.7,
                "tds" => 147,
                "gh" => 19.7,
                "identifier" => 4
            ],
            [
                "collection_point" => "Paraul Voila",
                "lat" => 45.80351,
                "long" => 24.83864,
                "nitrate" => 31.6,
                "ph" => 6.24,
                "conductivity" => 118.1,
                "salinity" => 0.1,
                "turbidity" => 0,
                "tds" => 56,
                "gh" => 12.3,
                "identifier" => 5
            ],
            [
                "collection_point" => "Paraul Sambata",
                "lat" => 45.76312,
                "long" => 24.82224,
                "nitrate" => 21.86,
                "ph" => 6.33,
                "conductivity" => 108.1,
                "salinity" => 0.1,
                "turbidity" => 5.39,
                "tds" => 51,
                "gh" => 11.8,
                "identifier" => 6
            ],
            [
                "collection_point" => "Paraul Oltet",
                "lat" => 45.79198,
                "long" => 24.77175,
                "nitrate" => 30.5,
                "ph" => 7.23,
                "conductivity" => 101.5,
                "salinity" => 0,
                "turbidity" => 0.28,
                "tds" => 48,
                "gh" => 11.4,
                "identifier" => 7
            ],
            [
                "collection_point" => "Hidrocentrala Vistea",
                "lat" => 45.80674,
                "long" => 24.75552,
                "nitrate" => 35.2,
                "ph" => 7.52,
                "conductivity" => 329,
                "salinity" => 0.2,
                "turbidity" => 14.42,
                "tds" => 157,
                "gh" => 19.7,
                "identifier" => 8
            ],
            [
                "collection_point" => "Paraul Corbul Ucii",
                "lat" => 45.73933,
                "long" => 24.69223,
                "nitrate" => 46.7,
                "ph" => 7.68,
                "conductivity" => 348.2,
                "salinity" => 0.2,
                "turbidity" => 11.24,
                "tds" => 170,
                "gh" => 18.7,
                "identifier" => 9
            ],
            [
                "collection_point" => "Paraul Ucea",
                "lat" => 45.76570,
                "long" => 24.66189,
                "nitrate" => 21.3,
                "ph" => 6.78,
                "conductivity" => 78.8,
                "salinity" => 0,
                "turbidity" => 0,
                "tds" => 37,
                "gh" => 12.1,
                "identifier" => 10
            ],
            [
                "collection_point" => "Paraul Ghirlotel-Arpas",
                "lat" => 45.79865,
                "long" => 24.65744,
                "nitrate" => 23.03,
                "ph" => 6.23,
                "conductivity" => 75,
                "salinity" => 0,
                "turbidity" => 0,
                "tds" => 35,
                "gh" => 11.8,
                "identifier" => 11
            ],
            [
            "collection_point" => "Hidrocentrala Arpas",
                "lat" => 45.79518,
                "long" => 24.59633,
                "nitrate" => 36.44,
                "ph" => 7.1,
                "conductivity" => 345,
                "salinity" => 0.2,
                "turbidity" => 11.07,
                "tds" => 164,
                "gh" => 20.1,
                "identifier" => 12
            ]
        ]);
    }
}
