<?php
require __DIR__ . "/../../controllers/nota-controller.php";
use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $controller = new NotasController();
    $resultado = $controller->deleteNota(['id' => $_POST['id']]);

    echo $resultado ? "ok" : "error";
    exit;
} else {
    echo "invalid_request";
    exit;
}
?>
