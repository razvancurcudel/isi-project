<?php

namespace App\Http\Controllers;

use App\Sensor;
use Illuminate\Http\Request;

class SensorsController extends Controller
{
    function show(int $id, string $parameter)
    {
        $sensors = Sensor::where("identifier", "=", $id)
            ->orderBy("update_timestamp", "DESC")
			->take(10)
			->get(["update_timestamp",$parameter]);

        return $sensors;
    }

    function index(Request $request)
    {
        // @TODO maybe do this a little better

        $sensors = [];
        $sensorsNumber = Sensor::distinct()->get(['identifier'])->count();

        for ($i = 1; $i <= $sensorsNumber; $i++)
        {
            $sensors[] = Sensor::where("identifier", "=", $i)
                ->orderBy("update_timestamp", "DESC")
                ->first();
        }

        return response()->json($sensors);
    }
}
