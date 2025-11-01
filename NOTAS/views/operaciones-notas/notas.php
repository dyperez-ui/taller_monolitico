<?php
require __DIR__ . '/../../controllers/nota-controller.php';

use App\Controllers\NotasController;

$controller = new NotasController();
$notas = $controller->queryAllNotas();

// Manejar eliminación vía POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $resultado = $controller->deleteNota($id);
    echo $resultado ? "ok" : "error";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de notas</title>
    <link rel="stylesheet" href="../../public/css/notas.css">
   
</head>
<body>

<h1>Lista de Notas</h1>


<div>
    <a href="promedio-notas.php">Ver Promedios</a>
    <a href="notas-form.php">Crear nueva nota</a>
    <a href="../../index.php">Volver</a>
    <a href="consultar-nota.php">Consultar nota</a>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Id</th>
                <th>Materia</th>
                <th>Estudiante</th>
                <th>Actividad</th>
                <th>Nota</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($notas)) : ?>
                <?php foreach ($notas as $n) : ?>
                    <tr>
                        <td><?= $n->id ?></td>
                        <td><?= $n->cod_materia ?></td>  
                        <td><?= $n->cod_estudiante ?></td> 
                        <td><?= $n->actividad ?? '—' ?></td> 
                        <td><?= $n->nota ?></td>
                        <td>
                            <button onclick="onClickBorrar(<?= $n->id ?>)">
                                <img src='../../public/imagenes/papelera.svg' alt='Borrar' width='30px'>
                            </button>
                            <a href="modificarSoloNota.php?   id=<?= $n->id ?>">
                                <img src='../../public/imagenes/modificar.svg' alt='Modificar' width='30px'>
                                <!-- En la parte de los botones, agrega esto: -->
                                <a href="promedio-notas.php?id=<?= $n->id ?>"> 
                                <img src='../../public/imagenes/promedio.svg' alt='Promedio' width='30px'>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="6">No hay notas registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script src='../../public/js/nota.js'></script>
</body>
</html>