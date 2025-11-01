<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear programa" : "Modificar programa";
$action = empty($cod) ? "registro-programa.php" : "modificar-programa.php";

$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<!-- AÑADIMOS LA CLASE form-page PARA APLICAR EL CSS DE FORMULARIOS -->
<body class="form-page">

    <h1><?php echo strtoupper($titulo); ?></h1>

    <!-- Botón superior -->
    <div class="acciones-superiores">
        <a href="programas.php" class="boton">Volver</a>
    </div>

    <!-- Contenedor principal del formulario -->
    <div class="form-container">
        <form action="<?php echo $action; ?>" method="post" class="formulario">

            <?php
            if (!empty($cod)) {
                // Si estamos modificando, el código se envía oculto
                echo '<input type="hidden" name="codigo" value="' . htmlspecialchars($cod) . '">';
            } else {
                echo '
                <div class="form-grupo">
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" id="codigo" maxlength="4" required placeholder="Máximo 4 caracteres">
                </div>';
            }
            ?>
            
            <div class="form-grupo">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required placeholder="Nombre del programa">
            </div>

            <div class="form-boton">
                <button type="submit" class="boton">Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
