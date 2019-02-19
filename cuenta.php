
<?php
    require "./php/init.php";

    $totalFactura = 0.0;
    define('IVA', 0.21);
    define('IVA_INT', 21);
    $lineasFactura = [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/cuenta.css">
    <title>Confirmar Pedido</title>
</head>
<body>
    <?php
        require "./html/cabecera.php";
    ?>
    
    <main>
        <h2>Datos del usuario</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <td><?= $_SESSION['usuario']['nombre'] ?></td>
            </tr>
            <tr>
                <th>Apellidos</th>
                <td><?= $_SESSION['usuario']['apellidos'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $_SESSION['usuario']['email'] ?></td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td><?= $_SESSION['usuario']['telefono'] ?></td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td><?= $_SESSION['usuario']['direccion'] ?></td>
            </tr>
            <tr>
                <th>Provincia</th>
                <td><?= $_SESSION['usuario']['provincia'] ?></td>
            </tr>
            <tr>
                <th>Localidad</th>
                <td><?= $_SESSION['usuario']['localidad'] ?></td>
            </tr>
            <tr>
                <th>CP</th>
                <td><?= $_SESSION['usuario']['codigo_postal'] ?></td>
            </tr>
            <tr>
                <th>DNI</th>
                <td><?= $_SESSION['usuario']['dni'] ?></td>
            </tr>
        </table>
    </main>

    <?php
        require "./html/pie.html";
    ?>
</body>
</html>