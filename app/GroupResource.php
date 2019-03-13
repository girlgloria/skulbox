<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupResource extends Model
{
    protected $fillable = [
        'group_id',
        'shared_by',
        'content_id',
        'is_active'
    ];
}
