<?php
require __DIR__ . '/../../controllers/programa-controller.php';
use App\Controllers\ProgramaController;

// Instancia del controlador
$controller = new ProgramaController();
$programas = $controller->queryAllProgramas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materias Registradas por Programa</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<h1>Materias Registradas por Programa de Formación</h1>

<div class="acciones-superiores">
    <a href="../../index.php" class="boton">Inicio</a>
    <a href="programas.php" class="boton">Volver</a>
</div>

<div class="form-container">
    <?php if (!empty($programas)): ?>
        <?php foreach ($programas as $programa): ?>
            <h2>Programa: <?= $programa->get('nombre') ?></h2>

            <?php
            // Obtener materias asociadas al programa
            $materias = $controller->getMateriasPorPrograma($programa->get('codigo'));
            ?>

            <?php if (!empty($materias)): ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Materia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($materias as $m): ?>
                            <tr>
                                <td><?= $m->get('codigo') ?></td>
                                <td><?= $m->get('nombre') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay materias registradas en este programa.</p>
            <?php endif; ?>
            <br>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay programas de formación registrados.</p>
    <?php endif; ?>
</div>

</body>
</html>
