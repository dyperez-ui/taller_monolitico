<?php
require __DIR__ . "/../../controllers/materia-controller.php";
use App\Controllers\MateriasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new MateriasController();
    $codigo = $_POST['codigo'] ?? null;

    $resultado = $controller->deleteMateria(['codigo' => $codigo]);

    if ($resultado === true) {
        echo "ok";
    } elseif ($resultado === "tiene_notas") {
        echo "tiene_notas";
    } elseif ($resultado === "tiene_estudiantes") {
        echo "tiene_estudiantes";
    } else {
        echo "error";
    }
    exit;
}

echo "invalid_request";
    