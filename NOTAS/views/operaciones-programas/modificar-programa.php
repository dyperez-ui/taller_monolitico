<?php
require __DIR__ . '/../../controllers/programa-controller.php';

use App\Controllers\ProgramaController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProgramaController();
    $resultado = $controller->updatePrograma($_POST);

    if ($resultado === true) {
        header("Location: programas.php");
        exit;
    } elseif ($resultado === "relaciones") {
        echo "<h2>No se puede modificar el programa</h2>";
        echo "<p>El programa tiene estudiantes o materias relacionadas.</p>";
        echo '<a href="programas.php">Volver</a>';
    } else {
        echo "<h2>Error al modificar el programa.</h2>";
        echo '<a href="programa-form.php?cod=' . $_POST['codigo'] . '">Volver al formulario</a>';
    }
} else {
    header("Location: programas.php");
    exit;
}
?>
