<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Materia</title>
</head>
<body>
    <h1>Buscar Materia</h1>

    <div class="form-page">
    <div class="acciones-superiores">
        <a href="materias.php" class ="boton">Volver a la lista</a>
        <a href="../../index.php" class="boton">Menú principal</a>
    </div>

    <form method="get">
        <input type="text" name="codigo" placeholder="Ingresa el código de la materia">
        <button type="submit">Buscar</button>
         <link rel="stylesheet" href="../../public/css/style.css">
    </form>


    <div id="resultados">
        <?php
        require __DIR__ . '/../../controllers/materia-controller.php';
        use App\Controllers\MateriasController;

        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];

            $controller = new MateriasController();
            $materia = $controller->queryMateriaPorCodigo($codigo);

            if ($materia) {
                echo '<table border="1" cellpadding="10">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nombre</th>';
                echo '<th>Programa</th>';
                echo '<th>Acciones</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $materia->get('codigo') . '</td>';
                echo '<td>' . $materia->get('nombre') . '</td>';
                echo '<td>' . $materia->get('programa') . '</td>';
                echo '<td>';
                echo '  <button onclick="onClickBorrar(' . $materia->get('codigo') . ')"><img src="../../public/imagenes/papelera.svg" class="icon"></button>';
                echo '  <a href="materias-form.php?cod=' . $materia->get('codigo') . '"><img src="../../public/imagenes/modificar.svg" class="icon" width="30px"></a>';
                echo '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No se encontró ninguna materia con el código ingresado.</p>';
            }
        }
        ?>
    </div>
        </div>
 
    

    <script src="../../public/js/materia.js"></script>
</body>
</html>