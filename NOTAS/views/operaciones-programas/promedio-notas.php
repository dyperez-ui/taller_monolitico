<?php
require __DIR__ . "/../../controllers/nota-controller.php";
use App\Controllers\NotasController;

$controller = new NotasController();
$todas_notas = $controller->queryAllNotas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Promedios de Notas</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1>Materias por estudiantes</h1>

    <div class="acciones-superiores">
        <a href="programas.php" class="boton">Volver</a>
        <a href="../../index.php" class="boton">Volver al Inicio</a>
    </div>

    <div class="form-container">
        <h2>Promedios por Estudiante</h2>

        <?php
        $promediosEstudiantes = [];

        foreach ($todas_notas as $n) {
            $codEst = $n->cod_estudiante;
            $materia = $n->cod_materia;
            $nota = $n->nota;

            $promediosEstudiantes[$codEst]['notas'][] = $nota;
            $promediosEstudiantes[$codEst]['materias'][] = $materia;
        }

        if (empty($promediosEstudiantes)) {
            echo "<p>No hay estudiantes con notas registradas.</p>";
        } else {
            foreach ($promediosEstudiantes as $estudiante => $info) {
                $promedioGeneral = array_sum($info['notas']) / count($info['notas']);
                echo "<div class='tabla-promedios'>";
                echo "<h3> Estudiante: $estudiante</h3>";
                echo "<p>nota definitiva: " . number_format($promedioGeneral, 2) . "</p>";
                echo "<table class='tabla'>";
                echo "<thead><tr><th>Materia</th><th>Nota</th></tr></thead><tbody>";

                foreach ($info['materias'] as $i => $mat) {
                    echo "<tr><td>$mat</td><td>" . $info['notas'][$i] . "</td></tr>";
                }

                echo "</tbody></table></div><br>";
            }
        }
        ?>
    </div>


</body>
</html>



