<?php
namespace App\Models;

require __DIR__ . "/sql-model/sql_materia.php";
require_once __DIR__ . "/databases/notas-db.php";
require_once __DIR__ . "/sql-model/model.php";


use App\Models\SQLModels\sql_materia;
use App\Models\Databases\NotasDB;
use App\Models\SQLModels\Model;


class Materia extends Model
{
    public $codigo;
    public $nombre;
    public $programa;

    public function __construct($codigo = null, $nombre = null, $programa = null)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->programa = $programa;
        
    }
        public function get($prop)
    {
        return $this->{$prop};
    }
    public function set($prop, $value)
    {
        $this->{$prop} = $value;
    }

    public function all()
    {
        $sql = Sql_materia::selectAll();
        $db = new NotasDB();
        $result = $db->execSQL($sql, true);
        $materias = [];

        while ($row = $result->fetch_assoc()) {
            $materia = new Materia($row['codigo'], $row['nombre'], $row['programa']);
            $materias[] = $materia;
        }

        $db->close();
        return $materias;
    }
  public function find()
{
    $sql = Sql_materia::selectByCodigo(); // ✅ corregido (S mayúscula)
    $db = new NotasDB();
    $result = $db->execSQL($sql, true, "s", $this->codigo);

    $materia = null;
    if ($row = $result->fetch_assoc()) {
        $materia = new Materia($row['codigo'], $row['nombre'], $row['programa']);
    }

    $db->close();
    return $materia;
}


    public function insert()
    {
        $sql =  sql_materia::insertInto();
        $db = new NotasDB();
        $result = $db->execSQL($sql, false, "sss", $this->codigo, $this->nombre, $this->programa);
        $db->close();
        return $result;
    }

    public function update()
    {
        $sql =  Sql_materia::update();
        $db = new NotasDB();
        $result = $db->execSQL($sql, false, "sss", $this->nombre, $this->programa, $this->codigo);
        $db->close();
        return $result;
    }

    public function delete()
    {
        $sql =  Sql_materia::delete();
        $db = new NotasDB();
        $result = $db->execSQL($sql, false, "s", $this->codigo);
        $db->close();
        return $result;
    }

    public function tieneNotas()
    {
        $sql =  Sql_materia::tieneNotas();
        $db = new NotasDB();
        $result = $db->execSQL($sql, true, "s", $this->codigo);
        $row = $result->fetch_assoc();
        $db->close();
        return $row['total'] > 0;
    }

    // ✅ AGREGAR ESTE MÉTODO DESPUÉS DE tieneNotas() - Línea 85-93
public function tieneEstudiantes()
{
    $sql = "SELECT COUNT(*) AS total FROM estudiantes_materias WHERE materia = ?";
    $db = new NotasDB();
    $result = $db->execSQL($sql, true, "s", $this->codigo);
    $row = $result->fetch_assoc();
    $db->close();
    return $row['total'] > 0;
}

  public function BuscarPorCodigo($codigo)
    {
        $db = new NotasDB();
        $query = sql_materia::seleccionPorCodigo();
        $result = $db->execSQL($query, true, "s", $codigo);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new self(
                $row['codigo'],
                $row['nombre'],
                $row['programa']
            );
        }

        $db->close();
        return null;
    }

}



