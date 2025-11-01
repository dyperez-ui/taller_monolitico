<?php
require __DIR__ . "/../../controllers/nota-controller.php";

use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NotasController();
    $resultado = $controller->deleteNota($_POST['id']);

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