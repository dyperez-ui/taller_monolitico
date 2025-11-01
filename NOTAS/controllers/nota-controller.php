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
        // Verificar que TODOS los campos estén presentes, incluyendo actividad
        if (
            empty($request['cod_estudiante']) ||
            empty($request['cod_materia']) ||
            empty($request['actividad']) ||  // ← AÑADIR ESTA VALIDACIÓN
            !isset($request['nota']) || $request['nota'] === ''
        ) {
            return false;
        }

        // Enviar los 5 parámetros en el orden correcto
        $nota = new Nota(
            null,                       // id
            $request['cod_estudiante'], // cod_estudiante
            $request['cod_materia'],    // cod_materia  
            $request['actividad'],      // actividad ← NUEVO PARÁMETRO
            $request['nota']            // nota
        );

        return $nota->insert();
    }

    public function updateNota($request)
    {
        if (empty($request['id']) || !isset($request['nota'])) {
            return false;
        }

        $nota = new Nota(
            $request['id'], 
            null, 
            null, 
            null, 
            $request['nota']
        );
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