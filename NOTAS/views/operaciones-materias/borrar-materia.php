<?php
require __DIR__ . "/../../controllers/materia-controller.php";

use App\controllers\MateriasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new MateriasController();
    $resultado = $controller->deleteMateria($_POST);

    if ($resultado === true) {
        echo "ok";
    } elseif ($resultado === "notas") {
        echo "tiene_notas";
    } else {
        echo "error";
    }
    exit;
} else {
    echo "invalid_request";
    exit;
}
?>
