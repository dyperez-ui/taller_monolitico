<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear Materia" : "Modificar Materia";
$action = empty($cod) ? "guardar-materia.php" : "modificar-materia.php";

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los programas
$sql = "SELECT codigo, nombre FROM programas";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>

<div class="form-page"> <!-- 🔴 Este contenedor activa el diseño del formulario -->

    <h1><?php echo strtoupper($titulo); ?></h1>

    <!-- Botón Volver -->
    <div class="acciones-superiores">
        <a href="materias.php" class="boton">Volver</a>
    </div>

    <!-- Contenedor principal del formulario -->
    <div class="form-container">
        <form action="<?php echo $action; ?>" method="post" class="formulario">

            <?php
            if (!empty($cod)) {
                echo '<input type="hidden" name="codigo" value="' . $cod . '">';
            } else {
                echo '
                <div class="form-grupo">
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" id="codigo" maxlength="5" required placeholder="Máximo 5 caracteres">
                </div>';
            }
            ?>

            <div class="form-grupo">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required placeholder="Ingrese el nombre de la materia">
            </div>

            <div class="form-grupo">
                <label for="programa">Programa:</label>
                <select name="programa" id="programa" required>
                    <option value="">Seleccione un programa</option>
                    <?php
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<option value="' . $fila["codigo"] . '">' . $fila["nombre"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-boton">
                <button type="submit" class="boton">Guardar</button>
            </div>

        </form>
    </div>

</div> <!-- 🔴 Cierra .form-page -->

</body>
</html>
