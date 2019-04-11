<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'report',
        'action',
        'content_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
