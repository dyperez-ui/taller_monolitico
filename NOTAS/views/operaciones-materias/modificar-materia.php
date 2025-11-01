<?php
require __DIR__ . "/../../controllers/materia-controller.php";

use App\controllers\MateriasController;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $materiaController = new MateriasController();

    
    $resultado = $materiaController->updateMateria($_POST);

    if ($resultado === true) {
      
        header("Location: materias.php");
        exit;
    } elseif ($resultado === "notas") {
        echo "<h2>No se puede modificar la Materia</h2>";
        echo "<p>El estudiante tiene materias registradas.</p>";
        echo '<a href="materias.php">Volver</a>';
    } else {
        echo "<h2>Error al modificar la materia.</h2>";
        echo '<a href="materias-form.php?cod=' . $_POST['codigo'] . '">Volver al formulario </a>';
    }
} else {
    // Si no llegó por POST, redirige a la lista
    header("Location: materias.php");
    exit;
}
?>
