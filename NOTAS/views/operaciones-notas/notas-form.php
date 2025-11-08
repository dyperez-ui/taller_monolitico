<?php
require __DIR__ . "/../../controllers/nota-controller.php";
use App\Controllers\NotasController;

// Guardar nota si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notaController = new NotasController();
    $result = $notaController->NewNota($_POST);

    if ($result) {
        header("Location: notas.php");
        exit();
    }
}

// Configuración del formulario
$id = empty($_GET["id"]) ? "" : $_GET["id"];
$titulo = empty($id) ? "Crear Nota" : "Modificar Nota";
$action = $_SERVER["PHP_SELF"]; // Acción del mismo archivo

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "notas_app");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar estudiantes y materias
$sqlEst = "SELECT codigo, nombre FROM estudiantes";
$resEst = $conexion->query($sqlEst);

$sqlMat = "SELECT codigo, nombre FROM materias";
$resMat = $conexion->query($sqlMat);

// Obtener nota si existe ID
$nota = null;
if (!empty($id)) {
    $stmt = $conexion->prepare("SELECT * FROM notas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $nota = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body class="form-page">

    <h1><?= $titulo ?></h1>

    <div class="acciones-superiores">
        <a href="notas.php" class="boton">Volver</a>
        <a href="../../index.php" class="boton">Inicio</a>
    </div>

    <div class="form-container">
        <form action="<?= $action ?>" method="post">
            <?php if (!empty($id)): ?>
                <input type="hidden" name="id" value="<?= $id ?>">
            <?php endif; ?>

            <label for="cod_estudiante">Estudiante:</label>
            <select name="cod_estudiante" id="cod_estudiante" required>
                <option value="">Seleccione un estudiante</option>
                <?php
                if ($resEst->num_rows > 0) {
                    while ($e = $resEst->fetch_assoc()) {
                        $selected = ($nota && $nota["cod_estudiante"] == $e["codigo"]) ? "selected" : "";
                        echo "<option value='{$e['codigo']}' $selected>{$e['nombre']}</option>";
                    }
                }
                ?>
            </select>

            <label for="cod_materia">Materia:</label>
            <select name="cod_materia" id="cod_materia" required>
                <option value="">Seleccione una materia</option>
                <?php
                if ($resMat->num_rows > 0) {
                    while ($m = $resMat->fetch_assoc()) {
                        $selected = ($nota && $nota["cod_materia"] == $m["codigo"]) ? "selected" : "";
                        echo "<option value='{$m['codigo']}' $selected>{$m['nombre']}</option>";
                    }
                }
                ?>
            </select>

            <label for="actividad">Actividad:</label>
            <input type="text" name="actividad" id="actividad" value="<?= $nota["actividad"] ?? "" ?>"required>

            <label for="nota">Nota:</label>
            <input type="number" step="0.1" min="0" max="5" name="nota" id="nota" value="<?= $nota["nota"] ?? "" ?>" required>

            <div class="form-boton">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>
