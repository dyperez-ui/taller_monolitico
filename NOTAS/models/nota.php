<?php
namespace App\Models;

require __DIR__ . "/sql_models/sql-nota.php";
require __DIR__ . "/databases/notas-DB.php";

use App\Models\SQLModels\Sql_nota;
use App\Models\Databases\NotasDB;

class Nota
{
    public $id;
    public $cod_estudiante;
    public $cod_materia;
    public $nota;

    public function __construct($id = null, $cod_estudiante = null, $cod_materia = null, $nota = null)
    {
        $this->id = $id;
        $this->cod_estudiante = $cod_estudiante;
        $this->cod_materia = $cod_materia;
        $this->nota = $nota;
    }

    public function all()
    {
        $db = new NotasDB();
        $sql = Sql_nota::selectAll();
        $result = $db->execSQL($sql, true);
        $notas = [];

        while ($row = $result->fetch_assoc()) {
            $nota = new Nota($row['id'], $row['estudiante'], $row['materia'], $row['nota']);
            array_push($notas, $nota);
        }

        $db->close();
        return $notas;
    }

    public function insert()
    {
        // Verificar si ya existe nota para ese estudiante y materia
        if ($this->existeNota()) {
            return "existe";
        }

        $db = new NotasDB();
        $sql = Sql_nota::insertInto();
        $result = $db->execSQL($sql, false, "ssd", $this->cod_estudiante, $this->cod_materia, $this->nota);
        $db->close();
        return $result;
    }

    public function update()
    {
        $db = new NotasDB();
        $sql = Sql_nota::update();
        $result = $db->execSQL($sql, false, "di", $this->nota, $this->id);
        $db->close();
        return $result;
    }

    public function delete()
    {
        $db = new NotasDB();
        $sql = Sql_nota::delete();
        $result = $db->execSQL($sql, false, "i", $this->id);
        $db->close();
        return $result;
    }

    public function existeNota()
    {
        $db = new NotasDB();
        $sql = Sql_nota::existeNota();
        $result = $db->execSQL($sql, true, "ss", $this->cod_estudiante, $this->cod_materia);
        $row = $result->fetch_assoc();
        $db->close();
        return $row['total'] > 0;
    }
}
