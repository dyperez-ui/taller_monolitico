<?php
namespace App\Models;

require_once __DIR__ . "/sql-model/sql_nota.php";
require_once __DIR__ . "/sql-model/model.php";
require_once __DIR__ . "/databases/notas-db.php";

use App\Models\SQLModels\Sql_nota;
use App\Models\Databases\NotasDB;

class Nota
{
    public $id;
    public $cod_estudiante;
    public $cod_materia;
    public $actividad;
    public $nota;
    public $estudiante; // nombre (opcional)
    public $materia;    // nombre (opcional)

    public function __construct($id = null, $cod_estudiante = null, $cod_materia = null, $actividad = null, $nota = null)
    {
        $this->id = $id;
        $this->cod_estudiante = $cod_estudiante;
        $this->cod_materia = $cod_materia;
        $this->actividad = $actividad;
        $this->nota = $nota;
    }

    public function all()
    {
        $db = new NotasDB();
        $sql = Sql_nota::selectAll(); // debe traer: n.id, n.estudiante, n.materia, n.actividad, n.nota, e.nombre, m.nombre
        $result = $db->execSQL($sql, true);
        $notas = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $n = new Nota(
                    $row['id'] ?? null,
                    $row['estudiante'] ?? $row['cod_estudiante'] ?? null,
                    $row['materia'] ?? $row['cod_materia'] ?? null,
                    $row['actividad'] ?? null,
                    $row['nota'] ?? null
                );
                // también guardar nombres si vienen
                if (isset($row['estudiante_nombre'])) $n->estudiante = $row['estudiante_nombre'];
                if (isset($row['materia_nombre'])) $n->materia = $row['materia_nombre'];
                // backward compat:
                if (isset($row['estudiante'])) $n->estudiante = $row['estudiante'];
                if (isset($row['materia'])) $n->materia = $row['materia'];
                $notas[] = $n;
            }
        }

        $db->close();
        return $notas;
    }

    public function insert()
    {
        if ($this->existeNota()) return "existe";

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
        // eliminar por id
        $db = new NotasDB();
        $sql = "DELETE FROM notas WHERE id = ?";
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
        return ($row['total'] ?? 0) > 0;
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
                    $row['id'] ?? null,
                    $row['estudiante'] ?? null,
                    $row['materia'] ?? null,
                    $row['actividad'] ?? null,
                    $row['nota'] ?? null
                );
            }
        }
        $db->close();
        return $notas;
    }

    public function get($prop)
    {
        return $this->{$prop} ?? null;
    }
}
