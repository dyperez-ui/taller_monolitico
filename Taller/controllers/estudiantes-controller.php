<?php
namespace App\Controllers;

require __DIR__ . "/../models/Estudiante.php";

use App\Models\Estudiante;

class EstudiantesController
{

    public function queryAllContactos()
    {
        $estudiante = new Estudiante();
        return $estudiante -> all();
    }

}