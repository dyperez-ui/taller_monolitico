<?php
require __DIR__ . '/../../controllers/materia-controller.php';
use App\Controllers\MateriasController;

// Crear instancia del controlador
$controller = new MateriasController();
$materias = $controller->queryAllMaterias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de materias</title>
</head>
<body>
    <h1>Lista de materias</h1>
    <a href="materia-form.php">Crear nueva materia</a>
    <a href="../index.php">Volver</a>

    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Programa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($materias as $m) {
                echo '<tr>';
                echo '  <td>' . $m->get('codigo') . '</td>';
                echo '  <td>' . $m->get('nombre') . '</td>';
                echo '  <td>' . $m->get('programa') . '</td>';
                echo '  <td>';
                echo '      <button onclick="onClickBorrar(' . $m->get('codigo') . ')">';
                echo '          <img src="../../public/imagenes/papelera.svg" alt="Borrar" width="30px">';
                echo '      </button>';
                echo '  </td>';
                echo '  <td>';
                echo '      <button>';   
                echo '      <a href="materias-form.php?cod=' . $m->get('codigo') . '">';
                echo '          <img src="../../public/imagenes/modificar.svg" alt="modificar" width="30px">';
                echo '      </a>';
                echo '      </button>';
                echo '  </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <script src='../../public/js/materia.js'></script>
</body>
</html>
