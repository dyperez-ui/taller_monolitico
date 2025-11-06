<?php
require __DIR__ . '/../../controllers/nota-controller.php';
use App\Controllers\NotasController;

$controller = new NotasController();
$notas = $controller->queryAllNotas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Notas</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

    <header>
    <nav class="navbar">
        <ul>
            <a href="../operaciones-estudiantes/estudiantes.php" class="boton">Estudiantes</a>
              <a href="../operaciones-materias/materias.php" class="boton">Materias</a>
            <a href="../operaciones-programas/programas.php" class="boton">Programas</a>
        </ul>
    </nav>
</header>

<h1>Lista de Notas</h1>

<div class="acciones-superiores">
    <a href="notas-form.php" class="boton">Nueva Nota</a>
    <a href="../../index.php" class="boton">Volver</a>
    <a href="consultar-nota.php" class="boton">consultar nota</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Materia</th>
            <th>Estudiante</th>
            <th>Actividad</th>
            <th>Nota</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($notas)): ?>
            <?php foreach ($notas as $n): ?>
                <tr>
                    <td><?= htmlspecialchars($n->id) ?></td>
                    <td><?= htmlspecialchars($n->cod_materia) ?></td>
                    <td><?= htmlspecialchars($n->cod_estudiante) ?></td>
                    <td><?= htmlspecialchars($n->actividad ?? '—') ?></td>
                    <td><?= htmlspecialchars($n->nota) ?></td>
                    <td class="acciones">
                        <button type="button" onclick="onClickBorrarNota(<?= (int)$n->id ?>)">
                            <img src='../../public/imagenes/papelera.svg' alt='Borrar' width='25'>
                        </button>
                        <a href="modificarSoloNota.php?id=<?= (int)$n->id ?>">
                            <img src='../../public/imagenes/modificar.svg' alt='Modificar' width='25'>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td >No hay notas registradas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script src="../../public/js/nota.js"></script>

</body>
</html>
