<?php

namespace App\Models;

require __DIR__ . "/sql_models/model.php";
require __DIR__ . "/sql_models/sql_estudiante.php";
require __DIR__ . "/databases/notas_db.php";

use Taller\Models\Sql_models\Model;
// use App\Models\SQLModels\SqlEstudiante;
use Taller\Models\Databases\notas_db;
use notasDB;
use SqlEstudiante;


class Estudiante extends Model
{
      private $codigo = 0;
    private $nombre = null;
    private $email = null;
    private $programa = null;

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
        $db = new notasDB();
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
        return $estudiantes;
    }
   
  public function find(){}
  public function insert(){}
  public function update(){}
  public function delete(){}

}