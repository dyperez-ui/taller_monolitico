<?php
$id = empty($_GET["id"]) ? "" : $_GET["id"];
$titulo = empty($id) ? "Crear nota" : "Modificar nota";
$action = empty($id) ? "guardar-nota.php" : "modificar-nota.php";

$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$sqlEst = "SELECT codigo, nombre FROM estudiantes";
$resEst = $conexion->query($sqlEst);

$sqlMat = "SELECT codigo, nombre FROM materias";
$resMat = $conexion->query($sqlMat);


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
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <div class="acciones-superiores">
    <a href="notas.php" class="boton">Volver</a>
    <a href="../../index.php" class="boton">Volver al Inicio</a>
    </div>
    <br><br>


    <div class="form-page"> 
    <form action="<?php echo $action; ?>" method="post">
        <?php if (!empty($id)): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>

        <div >
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
                   value="<?php echo $nota["actividad"] ?? "" ?>" required>
        </div>

        <div>
            <label for="nota">Nota:</label>
            <input type="number" step="0.1" min="0" max="5" name="nota" id="nota"
                   value="<?php echo $nota["nota"] ?? ""; ?>" required>
        </div>

        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
    </div>
</body>
</html>