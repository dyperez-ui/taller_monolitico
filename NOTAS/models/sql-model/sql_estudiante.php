<?php
namespace App\Models\SQLModels;

class SqlEstudiante{

    public static function selectAll(){
         return "SELECT * from estudiantes";
      
    }

    public static function selectByID(){
        return  "SELECT * from estudiantes where codigo=?";
    }

    public static function insertInto(){
        return "INSERT INTO estudiantes 
        (codigo, nombre, email, programa) 
        VALUES (?, ?, ?, ?)";
    }

    public static function update(){
      return "UPDATE estudiantes
      SET nombre = ?, 
      email = ?, 
      programa = ?
    WHERE codigo = ?";
    }

    public static function delete(){
        return "DELETE FROM estudiantes WHERE codigo = ?";
    }
}