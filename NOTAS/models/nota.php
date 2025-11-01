<?php
namespace App\Models;

require __DIR__ . "/sql-model/sql_nota.php";
require __DIR__ . "/sql-model/model.php";
require __DIR__ . "/databases/notas-db.php";

use App\Models\SQLModels\Sql_nota;
use App\Models\Databases\NotasDB;

class Nota
{
    public $id;
    public $cod_estudiante;
    public $cod_materia;
    public $actividad;
    public $nota;
    // Agregar las propiedades que faltan
    public $estudiante;
    public $materia;

    public function __construct($id = null, $cod_estudiante = null, $cod_materia = null, $actividad = null, $nota = null)
    {
        $this->id = $id;
        $this->cod_estudiante = $cod_estudiante;
        $this->cod_materia = $cod_materia;
        $this->actividad = $actividad;
        $this->nota = $nota;
        // Inicializar las nuevas propiedades
        $this->estudiante = $cod_estudiante;
        $this->materia = $cod_materia;
    }

    public function all()
    {
        $db = new NotasDB();
        $sql = Sql_nota::selectAll();
        $result = $db->execSQL($sql, true);
        $notas = [];

        while ($row = $result->fetch_assoc()) {
            $nota = new Nota(
                $row['id'],
                $row['estudiante'],  // Esto va a cod_estudiante
                $row['materia'],     // Esto va a cod_materia
                $row['actividad'],
                $row['nota']
            );
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

      
        $result = $db->execSQL(
            $sql,
            false,
            "sssd",
            $this->cod_materia,
            $this->cod_estudiante,
            $this->actividad,
            $this->nota
        );

        $db->close();
        return $result;
    }

    public function update()
    {
        
        $sql = "UPDATE notas SET nota = ? WHERE id = ?";
        $db = new NotasDB();
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
  
    public function BuscarPorEstudiante($codigo)
    {
        $sql = "SELECT * FROM notas WHERE estudiante = ?";
        $db = new NotasDB();
        $result = $db->execSQL($sql, true, "s", $codigo);

        $notas = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notas[] = new Nota(
                    $row['id'],
                    $row['estudiante'],
                    $row['materia'],
                    $row['actividad'],
                    $row['nota']
                );
            }
        }

        $db->close();
        return $notas;
    }

    public function get($prop)
    {
        return $this->{$prop};
    }
}