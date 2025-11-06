<?php
namespace App\Controllers;

require __DIR__ . "/../models/nota.php";
use App\Models\Nota;

class NotasController
{
    public function queryAllNotas()
    {
        $nota = new Nota();
        return $nota->all();
    }

    public function NewNota($request)
    {
        if (
            empty($request['cod_estudiante']) ||
            empty($request['cod_materia']) ||
            empty($request['actividad']) ||
            !isset($request['nota']) || $request['nota'] === ''
        ) {
            return false;
        }

        $nota = new Nota(
            null,
            $request['cod_estudiante'],
            $request['cod_materia'],
            $request['actividad'],
            $request['nota']
        );

        return $nota->insert();
    }

    public function updateNota($request)
    {
        if (empty($request['id']) || !isset($request['nota'])) {
            return false;
        }

        $nota = new Nota(
            $request['id'],
            null,
            null,
            null,
            $request['nota']
        );

        return $nota->update();
    }

    /**
     * deleteNota acepta:
     * - un array ['id' => 123]
     * - o un entero (legacy)
     */
public function deleteNota($request)
{
    // ✅ Validación segura
    if (!isset($request['id']) || empty($request['id'])) {
        return false;
    }

    $nota = new Nota($request['id']);
    $resultado = $nota->delete();

    // ✅ Asegurar retorno booleano real
    return $resultado ? true : false;
}




    /** Materias con promedio por estudiante */
    public function getMateriasConPromedio($estudiante_id)
    {
        $todas_notas = $this->queryAllNotas();
        $notas_estudiante = array_filter($todas_notas, fn($n) => $n->cod_estudiante == $estudiante_id);

        $materias = [];
        foreach ($notas_estudiante as $n) {
            $codigo = $n->cod_materia;
            $nombre = $n->materia ?? $codigo;

            $materias[$codigo]['nombre'] = $nombre;
            $materias[$codigo]['notas'][] = $n->nota;
        }

        $res = [];
        foreach ($materias as $codigo => $datos) {
            $res[] = [
                'codigo' => $codigo,
                'nombre' => $datos['nombre'],
                'promedio' => round(array_sum($datos['notas']) / count($datos['notas']), 2)
            ];
        }

        return $res;
    }

    /** Estudiantes con promedio por materia */
    public function getEstudiantesConPromedio($materia_id)
    {
        $todas_notas = $this->queryAllNotas();
        $notas_materia = array_filter($todas_notas, fn($n) => $n->cod_materia == $materia_id);

        $estudiantes = [];
        foreach ($notas_materia as $n) {
            $codigo = $n->cod_estudiante;
            $nombre = $n->estudiante ?? $codigo;

            $estudiantes[$codigo]['nombre'] = $nombre;
            $estudiantes[$codigo]['notas'][] = $n->nota;
        }

        $res = [];
        foreach ($estudiantes as $codigo => $datos) {
            $res[] = [
                'codigo' => $codigo,
                'nombre' => $datos['nombre'],
                'promedio' => round(array_sum($datos['notas']) / count($datos['notas']), 2)
            ];
        }

        return $res;
    }

    /** Buscar notas por estudiante */
    public function queryNotasByEstudiante($codigo)
    {
        $notaModel = new Nota();
        return $notaModel->BuscarPorEstudiante($codigo);
    }
}
