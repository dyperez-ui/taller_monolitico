<?php
//require || include;

$hostDb = "localhost";
$userDb = "root";
$pwdDb = "";
$nameDb = "notas_app";


$conexDb = new mysqli(
    $hostDb,
    $userDb,
    $pwdDb,
    $nameDb
);


if ($conexDb->connect_error) {
    die("DB error: " . $conexDb->connect_error);
}

$sql = "select * from estudiantes";
$result = $conexDb->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    
    <title>Estudiantes</title>
</head>

<body>
   

        <h1>Lista de Estudiante</h1>
    <br>
    <a href="views/estudiantes.php">Agregar Estudiante</a>
    <table>
        <thead>
            <tr>
                 <th>codigo</th>
                <th>Nombre</th>
                <th>Email</th>
                 <th>Programa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                     echo ' <td>' . $row['codigo'] . '</td>';
                    echo ' <td>' . $row['nombre'] . '</td>';
                    echo ' <td>' . $row['email'] . '</td>';
                     echo ' <td>' . $row['programa'] . '</td>';
                    echo ' <td>';
                    // // echo '   <a href="contacto-form.php?cod=' . $row['id'] . '">Modificar</a>';
                    echo ' </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo ' <td colspan="3">No registros</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php
$conexDb->close();
?>