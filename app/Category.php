<?php

namespace App;

use App\Repository\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    protected $fillable = ['name','description','is_active','is_deleted'];

    public function contents()
    {
        return $this->belongsToMany(Content::class,'category_content');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_category');
    }
}
