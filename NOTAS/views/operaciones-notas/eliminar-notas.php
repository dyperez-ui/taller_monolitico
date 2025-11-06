<?php
require __DIR__ . "/../../controllers/nota-controller.php";
use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "invalid_request";
    exit;
}

$id = $_POST['id'] ?? null;
if (empty($id) || !ctype_digit((string)$id)) {
    echo "not_found";
    exit;
}

$controller = new NotasController();
$resultado = $controller->deleteNota(['id' => (int)$id]);

echo $resultado ? "ok" : "error";
