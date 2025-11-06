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

<?php if (!empty($programas)): ?>
    <?php foreach ($programas as $programa): ?>
        <section style="margin-bottom: 40px;">
            <h2>Programa: <?= htmlspecialchars($programa->get('nombre')) ?> (<?= htmlspecialchars($programa->get('codigo')) ?>)</h2>

            <?php
            // Obtener estudiantes de este programa
            $estudiantes = $estudianteController->queryEstudiantesPorPrograma($programa->get('codigo'));
            ?>

            <?php if (!empty($estudiantes)): ?>
                <table border="1" cellpadding="5" cellspacing="0" style="width: 80%; margin: 10px auto;">
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
                                <td><?= htmlspecialchars($e->get('codigo')) ?></td>
                                <td><?= htmlspecialchars($e->get('nombre')) ?></td>
                                <td><?= htmlspecialchars($e->get('email')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center;">No hay estudiantes registrados en este programa.</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">No hay programas registrados en el sistema.</p>
<?php endif; ?>

</body>
</html>
