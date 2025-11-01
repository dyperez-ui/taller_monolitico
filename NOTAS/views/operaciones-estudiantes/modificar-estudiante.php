<?php
require __DIR__ . "/../../controllers/estudiantes-controller.php";

use App\Controllers\EstudianteController;

// Verifica que la solicitud venga del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estudiantesController = new EstudianteController();

    // Ejecuta la actualización a través del controlador
    $resultado = $estudiantesController->updateEstudiante($_POST);

    if ($resultado === true) {
        // ✅ Redirige correctamente a la lista
        header("Location: estudiantes.php");
        exit;
    } elseif ($resultado === "notas") {
        echo "<h2>No se puede modificar el estudiante</h2>";
        echo "<p>El estudiante tiene notas registradas.</p>";
        echo '<a href="estudiantes.php">Volver</a>';
    } else {
        echo "<h2>Error al modificar el estudiante.</h2>";
        echo '<a href="estudiante-form.php?cod=' . $_POST['codigo'] . '">Volver al formulario</a>';
    }
} else {
    // Si no llegó por POST, redirige a la lista
    header("Location: estudiantes.php");
    exit;
}
?>
