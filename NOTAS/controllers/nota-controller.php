<?php
namespace App\Controllers;

require __DIR__ . "/../models/nota.php";
use App\Models\Nota;

class NotasController
{
    public function queryAllNotas()
    {
        $nota = new Nota();
        return $nota->all();
    }

    public function NewNota($request)
    {
        if (
            empty($request['cod_estudiante']) ||
            empty($request['cod_materia']) ||
            !isset($request['nota'])
        ) {
            return false;
        }
        $nota = new Nota(
            null,
            $request['cod_estudiante'],
            $request['cod_materia'],
            $request['nota']
        );

        return $nota->insert();
    }

    public function updateNota($request)
    {
        if (empty($request['id']) || !isset($request['nota'])) {
            return false;
        }

        $nota = new Nota($request['id'], null, null, $request['nota']);
        return $nota->update();
    }

    public function deleteNota($request)
    {
        if (empty($request['id'])) {
            return false;
        }

        $nota = new Nota($request['id']);
        return $nota->delete();
    }
}
