<?php

require __DIR__ . '/../../controllers/nota-controller.php';
use App\Controllers\NotasController;

$controller = new NotasController();
$Notas = $controller->queryAllNotas(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de notas</title>
</head>
<body>
    <h1>Lista de notas</h1>
    <a href="notas-form.php">Crear nueva nota</a>
    <a href="../../index.php">Volver</a>

    <table >
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
            <?php
            foreach ($Notas as $n) {
                echo '<tr>';
                echo '  <td>' . $n->get('id') . '</td>';
                echo '  <td>' . $n->get('materia') . '</td>';
                echo '  <td>' . $n->get('estudiante') . '</td>';
                echo '  <td>' . $n->get('actividad') . '</td>';
                echo '  <td>' . $n->get('nota') . '</td>';
                echo '  <td>';
                echo '      <button onclick="onClickBorrar(' . $n->get('id') . ')">';
                echo '          <img src="../../public/imagenes/papelera.svg" alt="Borrar" width="30px">';
                echo '      </button>';
                echo '  </td>';
                echo '  <td>';
                echo '      <button>';   
                echo '      <a href="nota-form.php?cod=' . $n->get('id') . '">';
                echo '          <img src="../../public/imagenes/modificar.svg" alt="modificar" width="30px">';
                echo '      </a>';
                echo '      </button>';
                echo '  </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <script src='../../public/js/nota.js'></script>
</body>
</html>