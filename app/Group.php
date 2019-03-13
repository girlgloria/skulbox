<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'admin_id',
        'description',
        'is_active',
        'is_deleted'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_group');
    }
}
