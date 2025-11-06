<?php
require __DIR__ . '/../../controllers/materia-controller.php';
use App\Controllers\MateriasController;

$controller = new MateriasController();
$materias = $controller->queryAllMaterias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Materias</title>
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

<h1>Lista de Materias</h1>

<div class="acciones-superiores">
    <a href="materias-form.php" class="boton">Crear Nueva Materia</a>
    <a href="consultar-materia.php" class="boton">Consultar Materia</a>
    <a href="../../index.php" class="boton">Volver</a>
</div>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Programa</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($materias)): ?>
            <?php foreach ($materias as $m): ?>
                <tr>
                    <td><?= $m->get('codigo') ?></td>
                    <td><?= $m->get('nombre') ?></td>
                    <td><?= $m->get('programa') ?></td>
                    <td class="acciones">
                        <button onclick="onClickBorrar('<?= $m->get('codigo') ?>')">
                            <img src='../../public/imagenes/papelera.svg' alt='Borrar' width='25'>
                        </button>
                        <a href="materias-form.php?cod=<?= $m->get('codigo') ?>">
                            <img src='../../public/imagenes/modificar.svg' alt='Modificar' width='25'>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay materias registradas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script src='../../public/js/materia.js'></script>

</body>
</html>
