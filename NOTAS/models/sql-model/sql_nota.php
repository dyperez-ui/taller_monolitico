<?php
namespace App\Models\SQLModels;

class Sql_nota
{
    public static function selectAll()
    {
        return "SELECT n.id, e.nombre AS estudiante, m.nombre AS materia, n.actividad, n.nota
                FROM notas n
                JOIN estudiantes e ON n.estudiante = e.codigo
                JOIN materias m ON n.materia = m.codigo";
    }

    public static function selectById()
    {
        return "SELECT * FROM notas WHERE id = ?";
    }

    public static function insertInto()
    {
        return "INSERT INTO notas (materia, estudiante, actividad, nota)
                VALUES (?, ?, ?, ?)";
    }

    public static function update()
    {
        return "UPDATE notas SET actividad = ?, nota = ? WHERE id = ?";
    }

    public static function delete()
    {
        return "DELETE FROM notas WHERE id = ?";
    }

    public static function existeNota()
    {
        return "SELECT COUNT(*) AS total FROM notas
                WHERE estudiante = ? AND materia = ?";
    }
}
