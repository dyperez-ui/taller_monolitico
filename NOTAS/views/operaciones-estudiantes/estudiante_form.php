<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear estudiante" : "Modificar estudiante";
$action = empty($cod) ? "guardar-estudiante.php" : "modificar-estudiante.php";


$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$sql = "SELECT codigo, nombre FROM programas";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>estudiante formulario</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>

<div class="form-page"> <!-- 🔴 ESTE DIV ACTIVA LOS ESTILOS DEL FORMULARIO -->

    <h1><?php echo strtoupper($titulo); ?></h1>

    <!-- Botones superiores -->
    <div class="acciones-superiores">
        <a href="estudiantes.php" class="boton">Volver</a>
    </div>

    <!-- Contenedor del formulario -->
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
                <input type="text" name="nombre" id="nombre" required placeholder="Ingrese el nombre completo">
            </div>
            
            <div class="form-grupo">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required placeholder="ejemplo@correo.com">
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

</div> <!-- 🔴 CIERRA form-page -->

</body>

</html>