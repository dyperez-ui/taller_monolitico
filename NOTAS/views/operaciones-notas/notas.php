<?php
require __DIR__ . '/../../controllers/nota-controller.php';
use App\Controllers\NotasController;

$controller = new NotasController(); 
$notas = $controller->queryAllNotas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Notas</title>
</head>
<body>
    <h1>Lista de programas</h1>
    <a href="programa-form.php">Crear nuevo</a>
    <a href="../index.php">Volver</a>
    <table>
        <thead>
            <tr>
                <th>Materia</th>
                <th>Estudiante</th>
                <th>Actividad</th>  
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($notas as $n) {
                echo '<tr>';
                echo '  <td>' . $n->get('materia') . '</td>';
                echo '  <td>' . $n->get('estudiante') . '</td>';
                echo '  <td>' . $n->get('actividad') . '</td>';
                echo '  <td>' . $n->get('nota') . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    
    <script src="../../public/js/notas.js"></script>
</body>
</html>
