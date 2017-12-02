<?php

namespace App\Console\Commands;

use App\Mail\SensorMail;
use App\Sensor;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ModifySensorsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sensors:modify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modify sensors data with a random value';

    private $limits = [
        "nitrate" => [1, 8],
        "ph" => [0.1, 1],
        "conductivity" => [1, 70],
        "turbidity" => [0.2, 8],
        "tds" => [1, 20],
        "gh" => [1, 5],
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sensorsMaxIdentifier = DB::table("sensors")->max("identifier");

        $sensorIdentifier = rand(1, $sensorsMaxIdentifier);
        $sensor = Sensor::where("identifier", "=", $sensorIdentifier)->orderBy("update_timestamp", "DESC")->first();

        $sensor = $sensor->replicate();

        $paramToModify = array_keys($this->limits)[rand(0, count($this->limits) - 1)];
        $sign = rand(1, 2) == 1 ? "+" : "-";
        $limit = $this->limits[$paramToModify];

        if ($sign === "+") {
            $sensor[$paramToModify] += $this->random_float($limit[0], $limit[1]);
        } else {
            $sensor[$paramToModify] -= $this->random_float($limit[0], $limit[1]);
            $sensor[$paramToModify] = $sensor[$paramToModify] > 0 ? $sensor[$paramToModify] : 0;
        }

        $sensor->update_timestamp = Carbon::now();
        $sensor->save();

        if($sensor[$paramToModify] >= Sensor::$limitValues[$paramToModify])
        {
            $usersEmails = User::all()->pluck("email")->toArray();
            foreach($usersEmails as $email)
            {
                Mail::to($email)
                    ->queue(new SensorMail($sensor, ["name" => $paramToModify, "value" => $sensor[$paramToModify]]));
            }
        }
    }

    function random_float($min, $max)
    {
        return round(($min + lcg_value() * (abs($max - $min))), 2);
    }
}
