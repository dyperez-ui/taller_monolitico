<?php
namespace App\Models\SQLModels;

class SqlContacto{

    public static function selectAll(){
        $sql = "select * from contactos";
        return $sql;
    }

    public static function selectByID(){
        $sql = "select * from contactos id=?";
        return $sql;
    }

    public static function insertInto(){
        $sql = "insert into contactos(nombre, telefono, email)values";
        $sql .= "(?,?,?)";
        return $sql;
    }

    public static function update(){
        $sql = "update contactos set ";
        $sql.= "nombre=?,";
        $sql.= "telefono=?,";
        $sql.= "email=? where id=?";
        return $sql;
    }

    public static function delete(){
        $sql = "delete from contactos where id=?";
        return $sql;
    }
}