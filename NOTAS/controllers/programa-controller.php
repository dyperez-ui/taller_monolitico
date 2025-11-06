<?php
namespace App\Controllers;

require __DIR__ . "/../models/programa.php";
require __DIR__ . '/../models/materia.php';
    

use App\Models\Programa;
use App\Models\Materia;

class ProgramaController
{
    public function queryAllProgramas()
    {

        $programa = new Programa();
         return $programa->all();
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

    public function getMateriasPorPrograma($codigoPrograma)
{
    
    $materia = new Materia();
    $sql = "SELECT * FROM materias WHERE programa = ?";
    $db = new \App\Models\Databases\NotasDB();
    $result = $db->execSQL($sql, true, "s", $codigoPrograma);

    $materias = [];
    while ($row = $result->fetch_assoc()) {
        $materias[] = new Materia(
            $row['codigo'],
            $row['nombre'],
            $row['programa']
        );
    }

    $db->close();
    return $materias;
}

}
