<?php
namespace App\Models\SQLModels;

class SqlPrograma
{
    /**
     * Selecciona todos los programas registrados.
     */
    public static function selectAll()
    {
        return "SELECT * FROM programas";
    }

    /**
     * Selecciona un programa específico por su código.
     */
    public static function selectByCodigo()
    {
        return "SELECT * FROM programas WHERE codigo = ?";
    }

    /**
     * Inserta un nuevo programa.
     */
    public static function insertInto()
    {
        return "INSERT INTO programas (codigo, nombre) VALUES (?, ?)";
    }

    /**
     * Actualiza un programa existente.
     */
    public static function update()
    {
        return "UPDATE programas SET nombre = ? WHERE codigo = ?";
    }

    /**
     * Elimina un programa.
     */
    public static function delete()
    {
        return "DELETE FROM programas WHERE codigo = ?";
    }

    /**
     * ✅ NUEVA CONSULTA:
     * Lista todas las materias registradas por programa.
     */
    public static function selectMateriasPorPrograma()
    {
        return "
            SELECT 
                p.codigo AS codigo_programa,
                p.nombre AS nombre_programa,
                m.codigo AS codigo_materia,
                m.nombre AS nombre_materia
            FROM programas p
            LEFT JOIN materias m ON m.programa = p.codigo
            ORDER BY p.nombre, m.nombre
        ";
    }

    /**
     * ✅ NUEVA CONSULTA:
     * Obtiene las materias de un programa específico.
     */
    public static function selectMateriasDePrograma()
    {
        return "
            SELECT 
                m.codigo AS codigo_materia,
                m.nombre AS nombre_materia
            FROM materias m
            WHERE m.programa = ?
            ORDER BY m.nombre
        ";
    }
}
