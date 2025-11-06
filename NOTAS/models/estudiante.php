<?php
namespace App\Models;

require __DIR__ . "/sql-model/sql_estudiante.php";
require_once __DIR__ . "/sql-model/model.php";
require_once __DIR__ . "/databases/notas-db.php";


use App\Models\SQLModels\Model;
use App\Models\SQLModels\SqlEstudiante;
use App\Models\Databases\NotasDB;

class Estudiante extends Model
{
    public $codigo;
    public $nombre;
    public $email;
    public $programa;


public function __construct($codigo = null, $nombre = null, $email = null, $programa = null)
{
    $this->codigo = $codigo;
    $this->nombre = $nombre;
    $this->email = $email;
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
        $sql = SqlEstudiante::selectAll();
        $db = new NotasDB();
        $result = $db->execSQL($sql, true);
        $estudiantes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $estudiante = new Estudiante();
                $estudiante->set('codigo', $row["codigo"]);
                $estudiante->set('nombre', $row["nombre"]);
                $estudiante->set('email', $row["email"]);
                $estudiante->set('programa', $row["programa"]);
                array_push($estudiantes, $estudiante);
            }
        }
        $db->close();
        return $estudiantes;
    }
    public function find()
    {
    }
    public function insert()
    {
        $sql = SqlEstudiante::insertInto();
        $db = new NotasDB();

        $result = $db->execSQL(
            $sql,
            false,
            "ssss",
            $this->codigo,
            $this->nombre,
            $this->email,
            $this->programa
        );

        $db->close();
        return $result;
    }

    public function update()
    {
        $sql = SqlEstudiante::update();
        $db = new NotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "ssss",
            $this->nombre,
            $this->email,
            $this->programa,
            $this->codigo
        );
        $db->close();
        return $result;
    }
    public function delete()
    {
        $sql = SqlEstudiante::delete();
        $db = new NotasDB();
        $result = $db->execSQL(
            $sql,
            false,
            "s",
            $this->codigo
        );
        $db->close();
        return $result;
    }
        public function tieneNotas()
    {
        $db = new NotasDB();
        $sql = "SELECT COUNT(*) AS total FROM notas WHERE estudiantes = ?";
        $result = $db->execSQL($sql, true, "s", $this->codigo);

        $row = $result->fetch_assoc();
        $db->close();

        return $row['total'] > 0; // true si tiene notas registradas
    }

     public function BuscarPorCodigo($codigo)
    {
        $db = new NotasDB(); 
        $query = SqlEstudiante::seleccionPorCodigo();
        $result = $db->execSQL($query, true, "s", $codigo);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db->close();
            return new self(
                $row['codigo'],
                $row['nombre'],
                $row['email'],
                $row['programa']
            );
        }

        $db->close();
        return null;
    }
}