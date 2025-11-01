<?php
require __DIR__ . "/../../controllers/nota-controller.php";

use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notaController = new NotasController();
    $result = $notaController->NewNota($_POST);

    if ($result) {
        header("Location: notas.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al guardar</title>
    <link rel="stylesheet" href="../../public/css/notas.css">
</head>
<body>
    <h1>Error al guardar la nota</h1>
    <br>
    <a href="notas.php">Volver a notas</a>
</body>
</html>