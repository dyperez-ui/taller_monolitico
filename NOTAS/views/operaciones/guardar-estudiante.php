<?php
require __DIR__ . "/../../controllers/contactos-controller.php";


use App\Controllers\ContactosController;


$contactosController = new ContactosController();

$result = empty($_POST["id"])
    ? $contactosController->saveNewContacto($_POST)
    : $contactosController->updateContacto($_POST);

if ($result) {
    header("Location: ../contactos.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al guardar</title>
</head>

<body>
    <h1>Error al guardar los datos</h1>
    <br>
    <a href="../contactos.php">Volver a contactos</a>
</body>

</html>