<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public static $limitValues = [
        "nitrate" => 50,
        "ph" => 9,
        "conductivity" => 550,
        "turbidity" => 20,
        "tds" => 300,
        "gh" => 40,
    ];

    public $timestamps = false;
}
