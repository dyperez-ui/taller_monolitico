<?php
require __DIR__ . '/../../controllers/nota-controller.php';
use App\Controllers\NotasController;

$controller = new NotasController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Notas por Estudiante</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<h1>Buscar Notas por Estudiante</h1>

<div class="acciones-superiores">
    <a href="notas.php" class="boton">Volver a la lista</a>
    <a href="../../index.php" class="boton">Menú principal</a>
</div>

<div class="form-page">
    <form method="get">
        <input type="text" name="codigo" placeholder="Ingresa el código del estudiante"
               value="<?= isset($_GET['codigo']) ? $_GET['codigo'] : '' ?>">
        <button type="submit" class="boton">Buscar</button>
    </form>
</div>

<div class="form-container">
<?php
if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $notas = $controller->queryNotasByEstudiante($codigo);

    if (!empty($notas)) {
        $total = 0;
        $count = 0;

        foreach ($notas as $n) {
            $total += $n->get('nota');
            $count++;
        }

        $promedioGeneral = $count > 0 ? round($total / $count, 2) : 0;
        ?>
        <table class="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Materia</th>
                    <th>Estudiante</th>
                    <th>Actividad</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notas as $n): ?>
                    <tr>
                        <td><?= $n->get('id') ?></td>
                        <td><?= $n->get('materia') ?></td>
                        <td><?= $n->get('estudiante') ?></td>
                        <td><?= $n->get('actividad') ?></td>
                        <td><?= $n->get('nota') ?></td>
                        <td class="acciones">
                            <button type="button" onclick="onClickBorrarNota(<?= $n->get('id') ?>)">
                                <img src='../../public/imagenes/papelera.svg' alt='Borrar' width='25'>
                            </button>
                            <a href="nota-form.php?id=<?= $n->get('id') ?>">
                                <img src='../../public/imagenes/modificar.svg' alt='Editar' width='25'>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6">Promedio del Estudiante: <?= $promedioGeneral ?></td>
                </tr>
            </tbody>
        </table>
        <?php
    } else {
        echo "<p>No se encontraron notas para el estudiante con código $codigo</p>";
    }
} elseif (isset($_GET['codigo'])) {
    echo "<p>Por favor ingresa un código válido</p>";
}
?>
</div>

<script src="../../public/js/nota.js"></script>
</body>
</html>
