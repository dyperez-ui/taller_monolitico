<?php
require __DIR__ . "/../../controllers/nota-controller.php";

use App\Controllers\NotasController;

// Instanciar el controlador
$notaController = new NotasController();

// Verificar si viene un POST (crear o actualizar)
$result = empty($_POST["id"])
    ? $notaController->NewNota($_POST)
    : $notaController->updateNota($_POST);

// Si todo sale bien, redirigir
if ($result) {
    header("Location: notas.php");
    exit();
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
    <h1>Error al guardar la nota</h1>
    <br>
    <a href="notas.php">Volver a notas</a>
</body>

</html>
