<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDownload extends Model
{
    protected $fillable = ['user_id','content_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
