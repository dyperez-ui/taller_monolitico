<?php
$id = empty($_GET["id"]) ? "" : $_GET["id"];
$titulo = empty($id) ? "Crear nota" : "Modificar nota";
$action = empty($id) ? "guardar-nota.php" : "modificar-nota.php";

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta estudiantes
$sqlEst = "SELECT codigo, nombre FROM estudiantes";
$resEst = $conexion->query($sqlEst);

// Consulta materias
$sqlMat = "SELECT codigo, nombre FROM materias";
$resMat = $conexion->query($sqlMat);

// Si hay id, obtener datos de la nota
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
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../../public/css/notas.css">
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <a href="notas.php">Volver</a>
    <a href="../../index.php">Volver al Inicio</a>
    <br><br>

    <form action="<?php echo $action; ?>" method="post">
        <?php if (!empty($id)): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>
        <div>
            <label for="nota">Nota:</label>
            <input type="number" step="0.1" min="0" max="5" name="nota" id="nota"
                   value="<?php echo $nota["nota"] ?? ""; ?>" required>
        </div>

        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>

<!-- honestamente esto fue una medida de salvarla porque no quiso funcionar antes -->
</html>