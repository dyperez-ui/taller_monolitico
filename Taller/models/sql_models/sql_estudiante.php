<?php
class SqlContacto{

    public static function selectAll(){
        $sql = "select * from Estudiante";
        return $sql;
    }

    public static function selectByID(){
        $sql = "select * from Estudiante id=?";
        return $sql;
    }

    public static function insertInto(){
        $sql = "insert into contactos(codigo, nombre, email, programa)values";
        $sql .= "(?,?,?,?)";
        return $sql;
    }

    public static function update(){
        $sql = "update estudiantes set ";
        $sql.= "codigo=?,";
        $sql.= "nombre=?,";
        $sql.= "email=? where id=?";
        $sql.= "programa=?";
        return $sql;
    }

    public static function delete(){
        $sql = "delete from estudiantes where id=?";
        return $sql;
    }
}