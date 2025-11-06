<?php
require __DIR__ . '/../../controllers/estudiantes-controller.php';
use App\Controllers\EstudianteController;

$controller = new EstudianteController();
$estudiantes = $controller->queryAllEstudiantes(); 

// Si llega una solicitud POST (por ejemplo, borrar estudiante)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controller->deleteEstudiante($_POST);

    if ($resultado === true) {
        echo "ok";
    } elseif ($resultado === "notas") {
        echo "tiene_notas";
    } else {
        echo "error";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de estudiantes</title>
     <link rel="stylesheet" href="../../public/css/style.css">
 
</head>

<body>

<header>
    <nav class="navbar">
        <ul>
            <a href="../operaciones-materias/materias.php" class="boton">Materias</a>
            <a href="../operaciones-notas/notas.php" class="boton">Notas</a>
            <a href="../operaciones-programas/programas.php" class="boton">Programas</a>
        </ul>
    </nav>
</header>

    <h1>Lista de Estudiantes</h1>

    <!-- Botones superiores -->
    <div class="acciones-superiores">
        <a href="estudiante_form.php" class="boton">Crear nuevo</a>
        <a href="../../index.php" class="boton">Volver</a>
    </div>

    <!-- Tabla de estudiantes -->
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Programa</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($estudiantes)) : ?>
                <?php foreach ($estudiantes as $e): ?>
                    <tr>
                        <td><?= $e->get('codigo') ?></td>
                        <td><?= $e->get('nombre') ?></td>
                        <td><?= $e->get('email') ?></td>
                        <td><?= $e->get('programa') ?></td>
                        <td>
                            <div class="acciones">
                                <button onclick="onClickBorrar('<?= $e->get('codigo') ?>')">
                                    <div class="icono-accion">
                                        <img src='../../public/imagenes/papelera.svg' alt='Borrar'>
                                    </div>
                                </button>
                                <a href="estudiante_form.php?cod=<?= $e->get('codigo') ?>">
                                    <div class="icono-accion">
                                        <img src='../../public/imagenes/modificar.svg' alt='Modificar'>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5" style="text-align:center;">No hay estudiantes registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script src="../../public/js/estudiante.js"></script>
</body>
</html>
