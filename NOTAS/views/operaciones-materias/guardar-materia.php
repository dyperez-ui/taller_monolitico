<?php
require __DIR__ . "/../../controllers/materia-controller.php";

use App\controllers\MateriasController;

$materiaController = new MateriasController();

$result = empty($_POST["id"])
    ? $materiaController->saveNewMateria($_POST)
    : $materiaController->updateMateria($_POST);

if ($result) {
 
    header("Location: materias.php");
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
    <a href="materias.php">Volver a estudiantes</a>
</body>

</html>