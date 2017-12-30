<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Mail\TestMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AlertsController extends Controller
{
    public function create(Request $request)
    {
        $alert = new Alert();

        $alert->name = $request->get("name");
        $alert->user_id = JWTAuth::parseToken()->toUser()->id;
        $alert->long = $request->get("long");
        $alert->lat = $request->get("lat");
        $alert->description = $request->get("description");
        $alert->start_timestamp = Carbon::createFromTimestamp(strtotime($request->get("start_timestamp")));
        $alert->end_timestamp = Carbon::createFromTimestamp(strtotime($request->get("end_timestamp")));
        
        $alert->save();

        // send mail to all users
        $usersToNotify = User::where("email", "!=", $alert->user->email)->pluck("email")->toArray();
        foreach($usersToNotify as $email)
        {
            Mail::to($email)
                ->queue(new TestMail($alert));
        }

        return response()->json("Alert created succesfully");
    }

    public function index(Request $request)
    {
        $alerts = Alert::activeAlerts()->get();

        return $alerts->toJson();
    }
}
