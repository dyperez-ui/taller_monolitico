<?php
namespace App\Models\SQLModels;

class Sql_materia
{
    public static function selectAll()
    {
        return "SELECT m.codigo, m.nombre, p.nombre AS programa 
                FROM materias m 
                JOIN programas p ON m.programa = p.codigo";
    }

    public static function selectByCodigo()
    {
        return "SELECT * FROM materias
         WHERE codigo = ?";
    }

    public static function insertInto()
    {
        return "INSERT INTO materias (codigo, nombre, programa)
         VALUES (?, ?, ?)";
    }

    public static function update()
    {
        return "UPDATE materias SET nombre = ?, programa = ? 
        WHERE codigo = ?";
    }

    public static function delete()
    {
        return "DELETE FROM materias 
        WHERE codigo = ?";
    }

    public static function tieneNotas()
    {
        return "SELECT COUNT(*) AS total FROM notas WHERE materia = ?";
    }
}
