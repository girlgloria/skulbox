<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'activity_type',
        'request_id',
        'activity',
        'user_id'
    ];
}
