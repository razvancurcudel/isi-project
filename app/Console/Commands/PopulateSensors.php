<?php

namespace App\Console\Commands;

use App\Sensor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateSensors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sensors:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate sensors table with data';

    private $limits = [
        "nitrate" => [1, 8],
        "ph" => [0.1, 1],
        "conductivity" => [1, 70],
        "turbidity" => [0.2, 8],
        "tds" => [1, 10],
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
        $parameters = array_keys(Sensor::$limitValues);

        for($i = 0; $i < 10; $i++)
        {
            for($sensorId = 1; $sensorId <= $sensorsMaxIdentifier; $sensorId++)
            {
                $sensor = Sensor::where("identifier", "=", $sensorId)->orderBy("update_timestamp", "DESC")->first();
                $this->info("Generating data for sensor " . $sensorId);

                $sensor = $sensor->replicate();
                foreach ($parameters as $parameter)
                {
                    $sign = rand(1, 2) == 1 ? "+" : "-";
                    $limit = $this->limits[$parameter];
                    if ($sign === "+") {
                        if($parameter) {
                            $sensor[$parameter] += rand($limit[0], $limit[1]);
                        }
                        else {
                            $sensor[$parameter] += $this->random_float($limit[0], $limit[1]);
                        }
                    } else {
                        if($parameter) {
                            $sensor[$parameter] -= rand($limit[0], $limit[1]);
                        }
                        else {
                            $sensor[$parameter] -= $this->random_float($limit[0], $limit[1]);
                        }
                        $sensor[$parameter] = $sensor[$parameter] > 0 ? $sensor[$parameter] : 0;
                    }
                }
                $sensor->update_timestamp = Carbon::parse($sensor->update_timestamp)->addMinutes(10);
                $sensor->save();
            }
        }

        return;
    }

    function random_float($min, $max)
    {
        return round(($min + lcg_value() * (abs($max - $min))), 2);
    }
}
