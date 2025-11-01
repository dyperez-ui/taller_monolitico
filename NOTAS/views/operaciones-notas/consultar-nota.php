<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Notas por Estudiante</title>
    <link rel="stylesheet" href="../../public/css/notas.css">
</head>
<body>
    <h1>Buscar Notas por Estudiante</h1>
    
    <!-- Formulario con GET (correcto) -->
    <form method="get">
        <input type="text" name="codigo" placeholder="Ingresa el código del estudiante" 
               value="<?php echo isset($_GET['codigo']) ? htmlspecialchars($_GET['codigo']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>

    <div id="resultados">
        <?php
        require __DIR__ . '/../../controllers/nota-controller.php';
        use App\Controllers\NotasController;

        // CAMBIO: Usar $_GET en lugar de $_POST
        if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {
            $codigo = $_GET['codigo'];

            $controller = new NotasController();
            $notas = $controller->queryNotasByEstudiante($codigo);

            if (!empty($notas)) {
                $total = 0;
                $count = 0;

                foreach ($notas as $n) {
                    $total += $n->get('nota');
                    $count++;
                }

                $promedioGeneral = $count > 0 ? round($total / $count, 2) : 0;

                echo '<table border="1" cellpadding="10">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Materia</th>';
                echo '<th>Estudiante</th>';
                echo '<th>Actividad</th>';
                echo '<th>Nota</th>';
                echo '<th>Acciones</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                foreach ($notas as $n) {
                    echo "<tr>";
                    echo "<td>" . $n->get('id') . "</td>";
                    echo "<td>" . $n->get('materia') . "</td>";
                    echo "<td>" . $n->get('estudiante') . "</td>";
                    echo "<td>" . $n->get('actividad') . "</td>";
                    echo "<td>" . $n->get('nota') . "</td>";
                    echo "<td>";
                    echo "<button onclick=\"onClickBorrar(" . $n->get('id') . ")\">";
                    echo "<img src='../../public/res/borrar.svg' alt='Borrar' width='30px'>";
                    echo "</button>";
                    echo "<a href='nota-form.php?id=" . $n->get('id') . "'>";
                    echo "<img src='../../public/res/modificar.svg' alt='Editar' width='30px'>";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                
                echo '<tr><td colspan="6" style="text-align:center;font-weight:bold;">Promedio del Estudiante: ' . $promedioGeneral . '</td></tr>';
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "<p>No se encontraron notas para el estudiante con código " . htmlspecialchars($codigo) . "</p>";
            }
        } elseif (isset($_GET['codigo'])) {
            echo "<p>Por favor ingresa un código válido</p>";
        }
        ?>
    </div>

    <div>
        <a href="notas.php">Volver a la lista</a>
        <a href="../../index.php">Menú principal</a>
    </div>

    <script src="../../public/js/nota.js"></script>
</body>
</html>