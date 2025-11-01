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
        // Verificar que TODOS los campos estén presentes, incluyendo actividad
        if (
            empty($request['cod_estudiante']) ||
            empty($request['cod_materia']) ||
            empty($request['actividad']) ||  // ← AÑADIR ESTA VALIDACIÓN
            !isset($request['nota']) || $request['nota'] === ''
        ) {
            return false;
        }

        // Enviar los 5 parámetros en el orden correcto
        $nota = new Nota(
            null,                       // id
            $request['cod_estudiante'], // cod_estudiante
            $request['cod_materia'],    // cod_materia  
            $request['actividad'],      // actividad ← NUEVO PARÁMETRO
            $request['nota']            // nota
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

    public function deleteNota($request)
    {
        if (empty($request['id'])) {
            return false;
        }

        $nota = new Nota($request['id']);
        return $nota->delete();
    }

    // Obtener materias de un estudiante con sus promedios
    public function getMateriasConPromedio($estudiante_id) {
        $todas_notas = $this->queryAllNotas();
        
        // Filtrar notas del estudiante
        $notas_estudiante = array_filter($todas_notas, function($nota) use ($estudiante_id) {
            return $nota->estudiante == $estudiante_id;
        });
        
        // Agrupar por materia y calcular promedios
        $materias = [];
        foreach ($notas_estudiante as $nota) {
            $materia_codigo = $nota->materia;
            $materia_nombre = $nota->materia_nombre ?? $materia_codigo;
            
            if (!isset($materias[$materia_codigo])) {
                $materias[$materia_codigo] = [
                    'codigo' => $materia_codigo,
                    'nombre' => $materia_nombre,
                    'notas' => []
                ];
            }
            $materias[$materia_codigo]['notas'][] = $nota->nota;
        }
        
        // Calcular promedios
        $resultado = [];
        foreach ($materias as $materia) {
            $promedio = round(array_sum($materia['notas']) / count($materia['notas']), 2);
            $resultado[] = [
                'codigo' => $materia['codigo'],
                'nombre' => $materia['nombre'],
                'promedio' => $promedio
            ];
        }
        
        return $resultado;
    }

    // Obtener estudiantes de una materia con sus promedios
    public function getEstudiantesConPromedio($materia_id) {
        $todas_notas = $this->queryAllNotas();
        
        // Filtrar notas de la materia
        $notas_materia = array_filter($todas_notas, function($nota) use ($materia_id) {
            return $nota->materia == $materia_id;
        });
        
        // Agrupar por estudiante y calcular promedios
        $estudiantes = [];
        foreach ($notas_materia as $nota) {
            $estudiante_codigo = $nota->estudiante;
            $estudiante_nombre = $nota->estudiante_nombre ?? $estudiante_codigo;
            
            if (!isset($estudiantes[$estudiante_codigo])) {
                $estudiantes[$estudiante_codigo] = [
                    'codigo' => $estudiante_codigo,
                    'nombre' => $estudiante_nombre,
                    'notas' => []
                ];
            }
            $estudiantes[$estudiante_codigo]['notas'][] = $nota->nota;
        }
        
        // Calcular promedios
        $resultado = [];
        foreach ($estudiantes as $estudiante) {
            $promedio = round(array_sum($estudiante['notas']) / count($estudiante['notas']), 2);
            $resultado[] = [
                'codigo' => $estudiante['codigo'],
                'nombre' => $estudiante['nombre'],
                'promedio' => $promedio
            ];
        }
        
        return $resultado;
    }
    public function queryNotasByEstudiante($codigo)
{
    $notaModel = new Nota();
    return $notaModel->BuscarPorEstudiante($codigo);
}

}
