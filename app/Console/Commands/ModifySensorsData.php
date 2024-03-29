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
//        $sensorsMaxIdentifier = DB::table("sensors")->max("identifier");
//
//        $sensorIdentifier = rand(1, $sensorsMaxIdentifier);
//        $sensor = Sensor::where("identifier", "=", $sensorIdentifier)->orderBy("update_timestamp", "DESC")->first();
//
//        $sensor = $sensor->replicate();
//
//        $paramToModify = array_keys($this->limits)[rand(0, count($this->limits) - 1)];
//        $sign = rand(1, 2) == 1 ? "+" : "-";
//        $limit = $this->limits[$paramToModify];
//
//		$oldValue = $sensor[$paramToModify];
//        if ($sign === "+") {
//			if($paramToModify) {
//				$sensor[$paramToModify] += rand($limit[0], $limit[1]);
//			}
//			else {
//				$sensor[$paramToModify] += $this->random_float($limit[0], $limit[1]);
//			}
//        } else {
//			if($paramToModify) {
//				$sensor[$paramToModify] -= rand($limit[0], $limit[1]);
//			}
//			else {
//				$sensor[$paramToModify] -= $this->random_float($limit[0], $limit[1]);
//			}
//            $sensor[$paramToModify] = $sensor[$paramToModify] > 0 ? $sensor[$paramToModify] : 0;
//		}
//		$newValue = $sensor[$paramToModify];
//
//		$this->info($paramToModify . " modified on sensor " . $sensor->identifier . ". Old value: " . $oldValue . ". New value " . $newValue);
//
//        $sensor->update_timestamp = Carbon::now();
//        $sensor->save();

		$sensorsMaxIdentifier = DB::table("sensors")->max("identifier");
		$sensorIdentifier = rand(1, $sensorsMaxIdentifier);
        $sensor = Sensor::where("identifier", "=", $sensorIdentifier)->orderBy("update_timestamp", "DESC")->first();

		$parameters = array_keys(Sensor::$limitValues);

		$this->info("Changing data for sensor " . $sensorIdentifier . " - " . $sensor->collection_point);

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

		if($sensor[$parameter] >= Sensor::$limitValues[$parameter])
		{
			$usersEmails = User::all()->pluck("email")->toArray();
			foreach($usersEmails as $email)
			{
				Mail::to($email)
					->queue(new SensorMail($sensor, ["name" => $parameter, "value" => $sensor[$parameter]]));
			}
		}
    }

    function random_float($min, $max)
    {
        return round(($min + lcg_value() * (abs($max - $min))), 2);
    }
}
