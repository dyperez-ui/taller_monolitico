<?php
require __DIR__ . '/../../controllers/materia-controller.php';
require __DIR__ . '/../../controllers/estudiantes-controller.php';

use App\Controllers\MateriasController;
use App\Controllers\EstudianteController;

$materiaController = new MateriasController();
$estudianteController = new EstudianteController();

// Obtener todas las materias
$materias = $materiaController->queryAllMaterias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes por Materia</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <ul>
            <a href="../operaciones-estudiantes/estudiantes.php" class="boton">Estudiantes</a>
            <a href="../operaciones-notas/notas.php" class="boton">Notas</a>
            <a href="../operaciones-programas/programas.php" class="boton">Programas</a>
        </ul>
    </nav>
</header>

<h1>Estudiantes Registrados por Materia</h1>

<div class="acciones-superiores">
    <a href="programas.php" class="boton">Volver a Programas</a>
    <a href="../../index.php" class="boton">Volver al Inicio</a>
</div>

<?php if (!empty($materias)): ?>
    <?php foreach ($materias as $materia): ?>
        <section class="form-container">
            <h2>Materia: <?= $materia->get('nombre') ?> (<?= $materia->get('codigo') ?>)</h2>

            <?php
            // Obtener los estudiantes asociados al programa de esta materia
            $estudiantes = $estudianteController->queryEstudiantesPorPrograma($materia->get('programa'));
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
                <p>No hay estudiantes registrados en esta materia.</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
<?php else: ?>
    <p>No hay materias registradas.</p>
<?php endif; ?>

</body>
</html>