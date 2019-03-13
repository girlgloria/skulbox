<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestOffer extends Model
{
    protected $fillable = [
        'request_id',
        'offer',
        'user_id',
        'reason',
        'status',
        'is_deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
