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
    
    // ✅ CAPTURAR el objeto que retorna find()
    $materiaEncontrada = $materia->find();
    
    if (!$materiaEncontrada) {
        return false; // No existe
    }
    
    // ✅ Usar el objeto CON DATOS COMPLETOS para las validaciones
    if ($materiaEncontrada->tieneNotas()) {
        return "tiene_notas";
    }

    // ✅ Eliminar usando el objeto con datos completos
    return $materiaEncontrada->delete();
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
    public function queryMateriaPorCodigo($codigo)
    {
        $materiaModel = new Materia();
        return $materiaModel->BuscarPorCodigo($codigo);
    }

}

