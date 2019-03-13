<?php
/**
 * Created by PhpStorm.
 * User: marvincollins
 * Date: 3/6/19
 * Time: 5:12 PM
 */

namespace App\Repository\Contracts;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

class ControllerRepository extends Repository
{
    public function makeModel()
    {
        $model = \app()->make($this->controllerModel);

        if (! $model instanceof Model){
            dd("Not instance of model");
        }

        return $this->model = $model->newQuery();
    }

    public function getModel($model)
    {
        $this->controllerModel = $model;
        $this->makeModel();

        return $this;
    }


}