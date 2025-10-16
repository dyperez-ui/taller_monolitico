<?php
namespace App\Controllers;

require __DIR__ . "/../models/contacto.php";

use App\Models\Estudiante;

class EstudiantesController
{

    public function queryAllContactos()
    {
        $contacto = new Estudiante();
        return $contacto->all();
    }

    public function saveNewContacto($request)
    {
        if (empty($request['nombre'])) {
            return false;
        }
        $contacto = new  Estudiante();
        $contacto->set('nombre', $request['nombre']);
        $contacto->set('telefono', $request['telefono']);
        $contacto->set('email', $request['email']);
        return $contacto->insert();
    }

    public function deleteContacto($request)
    {
        if (empty($request['id'])) {
            return false;
        }
        $contacto = new  Estudiante();
        $contacto->set('id', $request['id']);
        return $contacto->delete();
    }

    public function updateContacto($request)
    {
        if (
            empty($request['id'])
            || empty($request['nombre'])
            || empty($request['telefono'])
        ) {
            return false;
        }
        $contacto = new  Estudiante ();
        $contacto->set('nombre', $request['nombre']);
        $contacto->set('telefono', $request['telefono']);
        $contacto->set('email', $request['email']);
        $contacto->set('id', $request['id']);
        return $contacto->update();
    }

}