<?php
require __DIR__ . "/../../controllers/materia-controller.php";

use App\controllers\MateriasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $materiaController = new MateriasController();
    $resultado = $materiaController->updateMateria($_POST);

    if ($resultado === true) {
        header("Location: materias.php");
        exit;
    } elseif ($resultado === "tiene_notas") {
        echo "<h2>No se puede modificar la Materia</h2>";
        echo "<p>No es posible modificar la materia porque tiene estudiantes con notas registradas.</p>";
        echo '<a href="materias.php">Volver a la lista</a>';
    } else {
        echo "<h2>Error al modificar la materia.</h2>";
        echo '<a href="materias-form.php?cod=' . $_POST['codigo'] . '">Volver al formulario</a>';
    }
} else {
    header("Location: materias.php");
    exit;
}