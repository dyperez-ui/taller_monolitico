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

    <h1>Lista de Materias</h1>

    <!-- Botones superiores -->
    <div class="acciones-superiores">
        <a href="materias-form.php" class="boton">Crear nueva materia</a>
        <a href="../../index.php" class="boton">Volver</a>
        <a href="consultar-materia.php" class ="boton">Consultar materia</a>
    </div>

    <!-- Tabla de materias -->
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
            <?php if (!empty($materias)) : ?>
                <?php foreach ($materias as $m): ?>
                    <tr>
                        <td><?= $m->get('codigo') ?></td>
                        <td><?= $m->get('nombre') ?></td>
                        <td><?= $m->get('programa') ?></td>
                        <td>
                            <div class="acciones">
                                <!-- Botón eliminar -->
                                <button onclick="onClickBorrar('<?= $m->get('codigo') ?>')">
                                    <div class="icono-accion">
                                        <img src='../../public/imagenes/papelera.svg' alt='Borrar'>
                                    </div>
                                </button>
                                <!-- Botón modificar -->
                                <a href="materias-form.php?cod=<?= $m->get('codigo') ?>">
                                    <div class="icono-accion">
                                        <img src='../../public/imagenes/modificar.svg' alt='Modificar'>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="4" style="text-align:center;">No hay materias registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script src='../../public/js/materia.js'></script>
</body>
</html>
