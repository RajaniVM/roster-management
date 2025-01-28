<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RosterEvent extends Model
{
    use HasFactory;

    protected $table = 'rosters';

    protected $fillable = [
        'date',
         'checkin_local',
         'checkin_utc',
         'checkout_local',
        'checkout_utc',
         'activity_type',
         'activity',
         'from_station',
          'to_station',
          'std_local',
          'std_utc',
         'sta_local',
         'sta_utc',
    ];
    
}
