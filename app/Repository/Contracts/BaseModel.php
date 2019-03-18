<?php
/**
 * Created by PhpStorm.
 * User: marvincollins
 * Date: 3/17/19
 * Time: 11:25 PM
 */

namespace App\Repository\Contracts;


use Illuminate\Database\Eloquent\Model;

abstract  class BaseModel extends Model
{
    public function scopeActive($query)
    {
        return $query->where('is_deleted', false);
    }
}