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
    <br><br>

    <form action="<?php echo $action; ?>" method="post">
        <?php if (!empty($id)): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>

        <div>
            <label for="cod_estudiante">Estudiante:</label>
            <select name="cod_estudiante" id="cod_estudiante" required>
                <option value="">Seleccione un estudiante</option>
                <?php
                if ($resEst->num_rows > 0) {
                    while ($e = $resEst->fetch_assoc()) {
                        $selected = ($nota && $nota["estudiante"] == $e["codigo"]) ? "selected" : "";
                        echo "<option value='{$e['codigo']}' $selected>{$e['nombre']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div>
            <label for="cod_materia">Materia:</label>
            <select name="cod_materia" id="cod_materia" required>
                <option value="">Seleccione una materia</option>
                <?php
                if ($resMat->num_rows > 0) {
                    while ($m = $resMat->fetch_assoc()) {
                        $selected = ($nota && $nota["materia"] == $m["codigo"]) ? "selected" : "";
                        echo "<option value='{$m['codigo']}' $selected>{$m['nombre']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div>
            <label for="actividad">Actividad:</label>
            <input type="text" name="actividad" id="actividad"
                   value="<?php echo $nota["actividad"] ?? ""; ?>" required>
        </div>

        <div>
            <label for="nota">Nota:</label>
            <input type="number" step="0.1" name="nota" id="nota"
                   value="<?php echo $nota["nota"] ?? ""; ?>" required>
        </div>

        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>
</html>
