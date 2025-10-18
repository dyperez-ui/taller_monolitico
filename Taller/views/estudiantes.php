<?php
require __DIR__ . "/../controllers/estudiantes-controller.php";
use App\Controllers\EstudiantesController;
use App\Models\Estudiante;

$estudiantesController = new EstudiantesController();
$estudiantes = $estudiantesController->queryAllContactos();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lsita de contactos</title>
    <link rel="stylesheet" href="../public/css/modals.css">
</head>

<body>
    <h1>LIsta de Estudiantes</h1>
    <br>
    <a href="estuidiante-form.php">Agregar Estudiante</a>
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Programa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estudiantes as $estudiante) {
                echo '<tr>';
                echo '  <td>' . $estudiante->get('codigo') . '</td>';
                echo '  <td>' . $estudiante->get('nombre') . '</td>';
                echo '  <td>' . $estudiante->get('email') . '</td>';
                echo '  <td>' . $estudiante->get('programa') . '</td>';
                echo '  <td>';
                echo '      <button onclick="onClickBorrar(' . $estudiante->get('codigo') . ')">';
                echo '      </button>';
                echo '  </td>';
                echo '  <td>';
                echo '      <a href="estudiante-form.php?cod=' . $estudiante->get('codigo') . '">';
                echo '      </a>';
                echo '  </td>';
                echo '</tr>';
            }
            if (count($estudiante) == 0) {
                echo '<tr>';
                echo '  <td colspan="3">No hay registros</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <div id="borrarContactoModal" class="modal">
        <h3>Eliminar registro</h3>
        <p>El registro se eliminara pemanentemente.</p>
        <form name="borrarContacto" action="operaciones/borrar-estudiante.php" method="post">
            <input type="hidden" name="cod" value="0">
            <div>
                <button type="submit">continuar</button>
                <button type="reset">cancelar</button>
            </div>
        </form>
    </div>
</body>

</html>