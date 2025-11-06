<?php
require_once __DIR__ . '/../../controllers/materia-controller.php';
require_once __DIR__ . '/../../controllers/nota-controller.php';
require_once __DIR__ . '/../../controllers/estudiantes-controller.php';

use App\Controllers\MateriasController;
use App\Controllers\NotasController;
use App\Controllers\EstudianteController;

$materiaController = new MateriasController();
$notaController = new NotasController();
$estudianteController = new EstudianteController();

$materias = $materiaController->queryAllMaterias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes por Materia con Promedio</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<h1 style="text-align:center; color:#c00; margin-bottom:30px;">
    ESTUDIANTES REGISTRADOS POR MATERIA CON SU PROMEDIO
</h1>

<div class="acciones-superiores">
    <a href="programas.php" class="boton">Volver a Programas</a>
    <a href="../../index.php" class="boton">Volver al Inicio</a>
</div>

<?php if (!empty($materias)): ?>
    <?php foreach ($materias as $materia): ?>
        <section style="margin-bottom: 40px;">
            <h2>Materia: <?= htmlspecialchars($materia->get('nombre')) ?> 
                (<?= htmlspecialchars($materia->get('codigo')) ?>)
            </h2>

            <?php
            // ✅ Obtener todas las notas
            $notas = $notaController->queryAllNotas();

            // ✅ Filtrar por materia (comparación flexible)
            $notasMateria = array_filter($notas, function($n) use ($materia) {
                return trim((string)$n->materia) === trim((string)$materia->get('codigo')) 
                    || trim((string)$n->cod_materia) === trim((string)$materia->get('codigo'));
            });

            // ✅ Calcular promedios por estudiante
            $promediosPorEstudiante = [];
            foreach ($notasMateria as $n) {
                $codEst = $n->cod_estudiante ?? $n->estudiante;
                if (!isset($promediosPorEstudiante[$codEst])) {
                    $promediosPorEstudiante[$codEst] = ['suma' => 0, 'count' => 0];
                }
                $promediosPorEstudiante[$codEst]['suma'] += $n->nota;
                $promediosPorEstudiante[$codEst]['count']++;
            }
            ?>

            <?php if (!empty($promediosPorEstudiante)): ?>
                <table border="1" cellpadding="5" cellspacing="0" style="width: 80%; margin: 10px auto; border-collapse: collapse;">
                    <thead style="background-color:#c00; color:#fff;">
                        <tr>
                            <th>Código Estudiante</th>
                            <th>Nombre</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($promediosPorEstudiante as $codigoEst => $datos): ?>
                            <?php
                            $estudiante = $estudianteController->queryEstudianteByCodigo($codigoEst);
                            $nombre = $estudiante ? $estudiante->get('nombre') : 'Desconocido';
                            $promedio = round($datos['suma'] / $datos['count'], 2);
                            ?>
                            <tr style="text-align:center;">
                                <td><?= htmlspecialchars($codigoEst) ?></td>
                                <td><?= htmlspecialchars($nombre) ?></td>
                                <td><?= $promedio ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center;">No hay estudiantes con notas registradas en esta materia.</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">No hay materias registradas.</p>
<?php endif; ?>

</body>
</html>
