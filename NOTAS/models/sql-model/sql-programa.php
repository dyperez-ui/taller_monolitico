<?php
namespace App\Models\SQLModels;

class SqlPrograma
{
    public static function selectAll()
    {
        return "SELECT * FROM programa";
    }

    public static function selectByCodigo()
    {
        return "SELECT * FROM programa WHERE codigo = ?";
    }

    public static function insertInto()
    {
        return "INSERT INTO programa (codigo, nombre) 
        VALUES (?, ?)";
    }

    public static function update()
    {
        return "UPDATE programa SET nombre = ? 
        WHERE codigo = ?";
    }

    public static function delete()
    {
        return "DELETE FROM programa WHERE codigo = ?";
    }
}