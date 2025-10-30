<?php
namespace App\Controllers;

require __DIR__ . "/../models/materia.php";

use App\Models\Materia;

class MateriasController
{
    public function queryAllMaterias()
    {
        $materia = new Materia();
        return $materia->all();
    }

    public function saveNewMateria($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $materia = new Materia(
            $request['codigo'],
            $request['nombre'],
            $request['programa']
        );

        return $materia->insert();
    }

    public function deleteMateria($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }

        $materia = new Materia($request['codigo']);

 

        return $materia->delete();
    }

    public function updateMateria($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $materia = new Materia(
            $request['codigo'],
            $request['nombre'],
            $request['programa']
        );


        return $materia->update();
    }
}
