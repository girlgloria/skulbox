<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','description','is_active',''];

    public function contents()
    {
        return $this->belongsToMany(Content::class,'category_content');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_category');
    }
}
