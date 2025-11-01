<?php
require __DIR__ . '/../../controllers/ProgramaController.php';
use App\Controllers\ProgramaController;


header("Content-Type: text/plain");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['codigo'])) {
    $controller = new ProgramaController();
    $result = $controller->deletePrograma($_POST['codigo']);

    if ($result === true) {
        echo "ok"; // borrado correcto
    } elseif ($result === "relaciones") {
        echo "relaciones"; // no se puede eliminar
    } else {
        echo "error"; // error genérico
    }
} else {
    echo "error";
}
?>
