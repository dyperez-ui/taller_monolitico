<?php
    require __DIR__ . '/../../controllers/programa-controller.php';

    use App\Controllers\ProgramaController;

    $controller = new ProgramaController(); 
    $programa = $controller->queryAllProgramas();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lista de programas</title>
        <link rel="stylesheet" href="../../public/css/style.css">
    </head>
    <body> 
        <h1>Lista de programas</h1>
        <div class="acciones-superiores">
        <a href="programa-form.php" class = "boton">Crear programa</a>
        <a href="../../index.php" class = "boton">Volver</a>
        </div>
        <table >
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($programa)) : ?>
                    <?php foreach ($programa as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p->get('codigo')) ?></td>
                            <td><?= htmlspecialchars($p->get('nombre')) ?></td>
                            <td>
                                <button onclick="onClickBorrar('<?= $p->get('codigo') ?>')">
                                    <img src="../../public/imagenes/papelera.svg" alt="Borrar" width="30px">
                                </button>
                                <a href="programa-form.php?cod=<?= $p->get('codigo') ?>">
                                    <img src="../../public/imagenes/modificar.svg" alt="Modificar" width="30px">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="3" style="text-align:center;">No hay programas registrados.</td></tr>
                <?php endif; ?>
                </tbody>

        </table>
        
        <script src="../../public/js/programa.js"></script>
    </body>
    </html>