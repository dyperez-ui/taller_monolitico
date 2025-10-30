<?php
require __DIR__ . "/../../controllers/estudaintes-controller.php";


use App\Controllers\EstudianteController;
use App\Controllers\EstudiantesController;
use App\Models\Estudiante;

$contactosController = new EstudianteController();

$result = empty($_POST["id"])
    ? $contactosController->saveNewEstudiante($_POST)
    : $contactosController->updateEstudiante($_POST);

if ($result) {
    header("Location: ../estudiantes.php");
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