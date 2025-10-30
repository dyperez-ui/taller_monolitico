<?php
namespace App\Models\SQLModels;

class SqlEstudiante{

    public static function selectAll(){
         return "SELECT * from estudiante";
      
    }

    public static function selectByID(){
        return  "SELECT * from estudiante where codigo=?";
    }

    public static function insertInto(){
        return "INSERT INTO estudiante 
        (codigo, nombre, email, programa) 
        VALUES (?, ?, ?, ?)";
    }

    public static function update(){
      return "UPDATE estudiante
      SET nombre = ?, 
      email = ?, 
      programa = ?
    WHERE codigo = ?";
    }

    public static function delete(){
        return "DELETE FROM estudiante WHERE codigo = ?";
    }
}