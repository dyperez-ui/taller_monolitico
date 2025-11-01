<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear programa" : "Modificar programa";
$action = empty($cod) ? "registrar-programa.php" : "modificar-programa.php";

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
    <title>Programas</title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>

<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <a href="programas.php">Volver</a>
    <br>
    <form action="<?php echo $action; ?>" method="post">
            <?php
        if (!empty($cod)) {
            echo '<input type="hidden" name="codigo" value="' . $cod . '">';
        } else {
            echo '<div>
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" id="codigo" required placeholder="Maximo 4 caracteres">
                </div>';
        }
        ?>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>

</html>