<?php
require __DIR__ . '/../../controllers/programa-controller.php';
use App\Controllers\ProgramaController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProgramaController();
    $resultado = $controller->saveNewPrograma($_POST);

    if ($resultado) {
      
        header("Location: programas.php");
        exit;
    } else {

        echo "<h2>Error al registrar el programa.</h2>";
        echo "<p>Verifica los datos ingresados e intenta nuevamente.</p>";
        echo '<a href="programa-form.php">Volver al formulario</a>';
    }
} else {
  
    header("Location: programas.php");
    exit;
}
?>