<?php

namespace App;

use App\Repository\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Content extends BaseModel
{
    protected $fillable = [
        'user_id',
        'title',
        'content_type',
        'background_path',
        'type',
        'content_path',
        'description',
        'detail',
        'status',
        'number_of_download',
        'number_of_sales',
        'cost',
        'is_deleted'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_content');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->hasOne(Request::class);
    }
}
