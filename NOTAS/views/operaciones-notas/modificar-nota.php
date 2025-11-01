<?php
require __DIR__ . "/../../controllers/nota-controller.php";

use App\controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NotasController();
    $resultado = $controller->updateNota($_POST);

    if ($resultado) {
        header("Location: notas.php");
        exit;
    } else {
        echo "<h3>Error al modificar la nota.</h3>";
        echo '<a href="notas.php">Volver</a>';
    }
} else {
    header("Location: notas.php");
    exit;
}
?>