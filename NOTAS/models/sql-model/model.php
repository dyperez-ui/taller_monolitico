<?php
namespace App\Models\SQLModels;

abstract class Model
{
    abstract public function all();
    abstract public function find();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();
}
