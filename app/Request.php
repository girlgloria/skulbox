<?php

namespace App;

use App\Repository\Contracts\BaseModel;

class Request extends BaseModel
{
    protected $fillable = [
        'user_id',
        'doc_link',
        'content_id',
        'status',
        'accepted_by',
        'accepted_at',
        'completed_at',
        'due_date',
        'start_date',
        'cancelled_at',
        'is_deleted'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function bids()
    {
        return $this->hasMany(RequestOffer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
