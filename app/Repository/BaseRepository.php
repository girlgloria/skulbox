<?php
/**
 * Created by PhpStorm.
 * User: marvincollins
 * Date: 3/4/19
 * Time: 11:20 PM
 */

namespace App\Repository;


interface BaseRepository
{
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function all($columns = ['*']);
    public function paginate($perPage, $columns = ['*']);
    public function find($id, $columns = ['*']);
    public function findBy($field, $value, $condition = '=', $columns = ['*']);
}