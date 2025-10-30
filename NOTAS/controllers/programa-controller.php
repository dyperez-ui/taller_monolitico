<?php
namespace App\Controllers;

require __DIR__ . "/../models/programa.php";

use App\Models\Programa;

class ProgramaController
{
    public function queryAllProgramas()
    {
       
    }

    public function saveNewPrograma($request)
    {
        if (
            empty($request['codigo']) ||
            empty($request['nombre']) 
        ) {
            return false;
        }

        $programa = new Programa(
            $request['codigo'],
            $request['nombre'],
        );

        return $programa->insert();
    }

    public function BorrarPrograma($codigo)
    {
        if (empty($codigo)) {
            return false;
        }

        $programa = new Programa($codigo);

        if ($programa->tieneEstudiantes() || $programa->tieneMaterias()) {
            return "relaciones";
        }

        return $programa->delete();
    }

    public function updatePrograma($request)
    {
        if (empty($request['codigo']) || empty($request['nombre'])) {
            return false;
        }

        $programa = new Programa($request['codigo'], $request['nombre']);

        if ($programa->tieneEstudiantes() || $programa->tieneMaterias()) {
            return "relaciones"; 
        }

        return $programa->update();
    }
}
