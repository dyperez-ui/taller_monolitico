<?php
namespace Taller\Models\Sql_models;
abstract class Model
{
    abstract public function all();
     abstract public function find();
     abstract public function insert();
     abstract public function update();
    abstract public function delete();
}

echo __DIR__ ."";