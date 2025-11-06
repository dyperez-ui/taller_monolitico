<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Estudiante</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1>Buscar Estudiante</h1>
    
 
    <form method="get">
        <input type="text" name="codigo" placeholder="Ingresa el código del estudiante">
        <button type="submit">Buscar</button>
    </form>


    <div id="resultados">
        <?php
        require __DIR__ . '/../../controllers/estudiantes-controller.php';
        use App\Controllers\EstudianteController;

        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];

            $controller = new EstudianteController();
            $estudiante = $controller->queryEstudiantePorCodigo($codigo);

            if ($estudiante) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nombre</th>';
                echo '<th>Email</th>';
                echo '<th>Programa</th>';
                echo '<th>Acciones</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $estudiante->get('codigo') . '</td>';
                echo '<td>' . $estudiante->get('nombre') . '</td>';
                echo '<td>' . $estudiante->get('email') . '</td>';
                echo '<td>' . $estudiante->get('programa') . '</td>';
                echo '<td>';
                echo '<button onclick="onClickBorrar(' . $estudiante->get('codigo') . ')"><img src="../../public/imagenes/papelera.svg" class="icon"></button>';
                echo '<a href="estudiante_form.php?cod=' . $estudiante->get('codigo') . '"><img src="../../public/imagenes/modificar.svg" class="icon"></a>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
            } else {
                echo '<p>No se encontró ningún estudiante con el código ingresado.</p>';
            }
        }
        ?>
    </div>

    <!-- Enlaces de navegación -->
    <div>
        <a href="estudiantes.php">Volver a la lista</a>
        <a href="../../index.php">Menú principal</a>
    </div>

    <script src="../../public/js/estudiante.js"></script>
</body>
</html>