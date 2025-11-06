<?php
require_once __DIR__ . '/../../controllers/programa-controller.php';
require_once __DIR__ . '/../../controllers/estudiantes-controller.php';

use App\Controllers\ProgramaController;
use App\Controllers\EstudianteController;

$programaController = new ProgramaController();
$estudianteController = new EstudianteController();

// Obtener todos los programas
$programas = $programaController->queryAllProgramas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes Registrados por Programa</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<h1>Estudiantes Registrados por Programa</h1>

<div class="acciones-superiores">
    <a href="programas.php" class="boton">Volver a Programas</a>
    <a href="../../index.php" class="boton">Volver al Inicio</a>
</div>

<div class="form-container">
    <?php if (!empty($programas)): ?>
        <?php foreach ($programas as $programa): ?>
            <h2>Programa: <?= $programa->get('nombre') ?> (<?= $programa->get('codigo') ?>)</h2>

            <?php
            // Obtener estudiantes de este programa
            $estudiantes = $estudianteController->queryEstudiantesPorPrograma($programa->get('codigo'));
            ?>

            <?php if (!empty($estudiantes)): ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estudiantes as $e): ?>
                            <tr>
                                <td><?= $e->get('codigo') ?></td>
                                <td><?= $e->get('nombre') ?></td>
                                <td><?= $e->get('email') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay estudiantes registrados en este programa.</p>
            <?php endif; ?>
            <br>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay programas registrados en el sistema.</p>
    <?php endif; ?>
</div>

</body>
</html>
