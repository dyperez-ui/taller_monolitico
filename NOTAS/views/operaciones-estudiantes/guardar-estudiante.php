<?php
require __DIR__ . "/../../controllers/estudiantes-controller.php";

use App\Controllers\EstudianteController;

$estudiantesController = new EstudianteController();

$result = empty($_POST["id"])
    ? $estudiantesController->saveNewEstudiante($_POST)
    : $estudiantesController->updateEstudiante($_POST);

if ($result) {
 
    header("Location: estudiantes.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al guardar</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <h1>Error al guardar los datos</h1>
    <br>
    <a href="estudiantes.php">Volver a estudiantes</a>
</body>

</html>