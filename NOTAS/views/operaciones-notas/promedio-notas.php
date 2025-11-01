<?php
require __DIR__ . "/../../controllers/nota-controller.php";

use App\Controllers\NotasController;

$controller = new NotasController();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Promedios</title>
        <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1>Promedios de Notas</h1>
     <div class="acciones-superiores">
    <a href="notas.php" class="boton">Volver</a>
    <a href="../../index.php" class="boton">Volver al Inicio</a>
    </div>
   

    <div >
        <h2>Estudiantes con sus promedios por materia</h2>
        <?php
     
        $todas_notas = $controller->queryAllNotas();
        
    
        $estudiantes_con_notas = [];
        foreach ($todas_notas as $nota) {
           
            if (is_object($nota)) {
                $nota = (array)$nota;
            }
            $estudiante_codigo = $nota['estudiante'] ?? null;
            if ($estudiante_codigo && !in_array($estudiante_codigo, $estudiantes_con_notas)) {
                $estudiantes_con_notas[] = $estudiante_codigo;
            }
        }
        
        foreach ($estudiantes_con_notas as $codigo_est): ?>
            <h3>Estudiante: <?= $codigo_est ?></h3>
            <?php 
            $materias_con_promedio = $controller->getMateriasConPromedio($codigo_est);
            
            if (!empty($materias_con_promedio)): ?>
                <table border="1" cellpadding="5">
                    <tr><th>Materia</th><th>Promedio</th></tr>
                    <?php foreach ($materias_con_promedio as $materia): ?>
                        <tr>
                            <td><?= $materia['nombre'] ?></td>
                            <td><?= $materia['promedio'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No tiene notas registradas</p>
            <?php endif; ?>
            <br>
        <?php endforeach; ?>
        
        <?php if (empty($estudiantes_con_notas)): ?>
            <p>No hay estudiantes con notas registradas</p>
        <?php endif; ?>
    </div>

    <div>
        <h2>Materias con promedios de estudiantes</h2>
        <?php
        // Obtener materias únicas
        $materias_con_notas = [];
        foreach ($todas_notas as $nota) {
            if (is_object($nota)) {
                $nota = (array)$nota;
            }
            $materia_codigo = $nota['materia'] ?? null;
            if ($materia_codigo && !in_array($materia_codigo, $materias_con_notas)) {
                $materias_con_notas[] = $materia_codigo;
            }
        }
        
        foreach ($materias_con_notas as $codigo_mat): ?>
            <h3>Materia: <?= $codigo_mat ?></h3>
            <?php 
            $estudiantes_con_promedio = $controller->getEstudiantesConPromedio($codigo_mat);
            
            if (!empty($estudiantes_con_promedio)): ?>
                <table border="1">
                    <tr><th>Estudiante</th><th>Promedio</th></tr>
                    <?php foreach ($estudiantes_con_promedio as $estudiante): ?>
                        <tr>
                            <td><?= $estudiante['nombre'] ?></td>
                            <td><?= $estudiante['promedio'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No hay estudiantes con notas en esta materia</p>
            <?php endif; ?>
            <br>
        <?php endforeach; ?>
        
        <?php if (empty($materias_con_notas)): ?>
            <p>No hay materias con notas registradas</p>
        <?php endif; ?>
    </div>
</body>
</html>