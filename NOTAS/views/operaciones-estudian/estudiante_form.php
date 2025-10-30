
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudientes Form</title>
</head>

<body>
    <h1>Guardar Estudiante</h1>
    <br>
    <form action="operaciones/guardar-estudiante.php" method="post">
        <?php
        if (!empty($_GET["cod"])) {
            echo '<input type="hidden" name="id" value="' . $_GET["cod"] . '">';
        }
        ?>
        <div>
            <label for="nombre">codigo</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="codigo">nombre</label>
            <input type="number" name="codigo" id="cod" required>
        </div>
         <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="email">Programa</label>
            <input type="text" name="programa" id="programa" required>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
    <a href="contactos.php">Volver</a>
</body>

</html>