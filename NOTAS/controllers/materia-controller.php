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
        if (empty($request['codigo']) || empty($request['nombre']) || empty($request['programa'])) {
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
        if (!is_array($request) || empty($request['codigo'])) {
            return false;
        }

        $materia = new Materia($request['codigo']);
        $materiaEncontrada = $materia->find();

        if (!$materiaEncontrada) {
            return false;
        }

        if ($materiaEncontrada->tieneNotas()) {
            return "tiene_notas";
        }

        if ($materiaEncontrada->tieneEstudiantes()) {
            return "tiene_estudiantes";
        }

        return $materiaEncontrada->delete();
    }

    public function updateMateria($request)
    {
        if (empty($request['codigo']) || empty($request['nombre']) || empty($request['programa'])) {
            return false;
        }

        $materia = new Materia($request['codigo']);
        $materiaEncontrada = $materia->find();

        if (!$materiaEncontrada) {
            return false;
        }

        // ✅ VERIFICAR SI TIENE ESTUDIANTES CON NOTAS ANTES DE MODIFICAR
        if ($materiaEncontrada->tieneNotas()) {
            return "tiene_notas";
        }

        // Si no tiene notas, proceder con la actualización
        $materiaActualizada = new Materia(
            $request['codigo'],
            $request['nombre'],
            $request['programa']
        );

        return $materiaActualizada->update();
    }

    public function queryMateriaPorCodigo($codigo)
    {
        $materiaModel = new Materia();
        return $materiaModel->BuscarPorCodigo($codigo);
    }
}