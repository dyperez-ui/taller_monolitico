<?php
namespace App\Controllers;

require __DIR__ . "/../models/estudiante.php";

use App\Models\estudiante;

class EstudianteController
{
    public function queryAllEstudiantes()
    {
        $estudiante = new Estudiante();
        return $estudiante->all();
    }

    public function saveNewEstudiante($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['email']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $estudiante = new Estudiante(
            $request['codigo'],
            $request['nombre'],
            $request['email'],
            $request['programa']
        );

        return $estudiante->insert();
    }

    public function deleteEstudiante($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }

        $estudiante = new Estudiante($request['codigo']);

        return $estudiante->delete();
    }


    public function updateEstudiante($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) ||
            empty($request['email']) ||
            empty($request['programa'])
        ) {
            return false;
        }

        $estudiante = new Estudiante(
            $request['codigo'],
            $request['nombre'],
            $request['email'],
            $request['programa']
        );

        

        return $estudiante->update();
    }
    public function queryEstudiantePorCodigo($codigo)
{
    $estudianteModel = new \App\Models\Estudiante();
    return $estudianteModel->BuscarPorCodigo($codigo);
}

public function queryEstudiantesPorPrograma($codigoPrograma)
{
    $model = new Estudiante();
    $todos = $model->all();

    $filtrados = [];
    foreach ($todos as $e) {
        if ($e->get('programa') == $codigoPrograma) {
            $filtrados[] = $e;
        }
    }
    return $filtrados;
}

}
