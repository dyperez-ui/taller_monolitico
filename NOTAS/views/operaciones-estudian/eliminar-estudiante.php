<?php
require __DIR__ . '/../../controllers/estudiantes-controller.php';
use App\Controllers\EstudianteController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EstudianteController();
    $resultado = $controller->deleteEstudiante($_POST);

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
