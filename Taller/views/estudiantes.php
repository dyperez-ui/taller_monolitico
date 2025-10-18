<?php
require __DIR__ ."/../controllers/contactos-controller.php";

use App\Controllers\ContactosController;

//$contactosController = new ContactosController();
$contactos = $contactosController->queryAllContactos();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lsita de contactos</title>
</head>

<body>
    <h1>LIsta de contactos</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contactos as $contacto) {
                echo '<tr>';
                echo '  <td>' . $contacto->get('nombre') . '</td>';
                echo '  <td>' . $contacto->get('telefono') . '</td>';
                echo '  <td>' . $contacto->get('email') . '</td>';
                echo '</tr>';
            }
            if(count($contactos) == 0) {
                echo '<tr>';
                echo '  <td colspan="3">No hay registros</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>