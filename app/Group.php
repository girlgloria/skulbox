<?php

namespace App;

use App\Repository\Contracts\BaseModel;

class Group extends BaseModel
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
