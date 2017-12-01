<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'name', 'lat', 'long', 'description', 'start_timestamp', 'end_timestamp'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function scopeActiveAlerts($query)
    {
        return $query->where('end_timestamp', ">", Carbon::now()->toDateTimeString());
    }
}
