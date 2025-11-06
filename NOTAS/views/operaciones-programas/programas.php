<?php
require __DIR__ . '/../../controllers/programa-controller.php';
use App\Controllers\ProgramaController;

$controller = new ProgramaController(); 
$programas = $controller->queryAllProgramas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Programas</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body> 

<header>
    <nav class="navbar">
        <ul>
            <a href="../operaciones-estudiantes/estudiantes.php" class="boton">Estudiantes</a>
            <a href="../operaciones-materias/materias.php" class="boton">Materias</a>
            <a href="../operaciones-notas/notas.php" class="boton">Notas</a>
        </ul>
    </nav>
</header>

<h1>Lista de Programas</h1>

<div class="acciones-superiores">
    <a href="programa-form.php" class="boton">Crear Programa</a>
    <a href="promedio-notas.php" class="boton">Materias por Estudiante</a>
    <a href="estudiantes-registrados.php" class="boton">Estudiantes Registrados</a>
    <a href="estudiantes-por-materia.php" class="boton">Estudiantes por Materia</a>
    <a href="materias-registradas.php" class="boton">Materias Registradas</a>
    <a href="../../index.php" class="boton">Volver</a>
</div>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($programas)): ?>
            <?php foreach ($programas as $p): ?>
                <tr>
                    <td><?= $p->get('codigo') ?></td>
                    <td><?= $p->get('nombre') ?></td>
                    <td class="acciones">
                        <button onclick="onClickBorrar('<?= $p->get('codigo') ?>')">
                            <img src="../../public/imagenes/papelera.svg" alt="Borrar" width="25">
                        </button>
                        <a href="programa-form.php?cod=<?= $p->get('codigo') ?>">
                            <img src="../../public/imagenes/modificar.svg" alt="Modificar" width="25">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No hay programas registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script src="../../public/js/programa.js"></script>
</body>
</html>
