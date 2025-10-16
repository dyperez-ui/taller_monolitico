<?php
namespace App\Controllers;

require __DIR__ . "/../models/Estudiante.php";

use App\Models\Estudiante;

class ContactosController
{

    public function queryAllContactos()
    {
        $contacto = new Estudiante();
        return $contacto->all();
    }

}