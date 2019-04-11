<?php

namespace App\Repository\Contracts;


use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements BaseRepository
{
    protected $app;
    protected $model;
    public $controllerModel;

    public function     create($data)
    {
        return $this->model->create($data);
    }

    abstract function makeModel();

    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        $item = $this->find($id);
        $item->is_deleted = true;
        $item->save();

        return $item;
    }

    public function all($columns = ['*'])
    {
        return $this->model->active()->get();
    }

    public function paginate($perPage, $columns = ['*'])
    {
        return $this->model->where('is_deleted', false)->paginate($perPage);
    }

    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id);
    }

    public function findBy($field, $value, $condition = '=', $columns = ['*'])
    {
        return $this->model->active()->where($field, $condition, $value)->get($columns);
    }

    public function logActivity($activity_type, $user_id, $activity, $request_id = null)
    {
        return $this->create([
            'activity_type' => $activity_type,
            'request_id' => $request_id,
            'activity' => $activity,
            'user_id' => $user_id
        ]);
    }


}