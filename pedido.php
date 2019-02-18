
<?php
    require "./class/init.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/pedido.css">
    <title>Confirmar Pedido</title>
</head>
<body>
    <?php
        require "./html/cabecera.html";

        $totalFactura = 0.0;
        define('IVA', 0.21);
    ?>
    
    <main>
        <h2>Resumen de su pedido</h2>
        <table class="productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cesta'] as $linea): ?>
                <?php
                    $producto = Producto::cargarProducto($linea[0]);
                ?>
                    <tr>
                        <td><?= $linea[1] ?></td>
                        <td><?= $producto['precio'] ?>€</td>
                        <td><?= $linea[2] ?></td>
                        <td><?= $linea[2]*$producto['precio'] ?>€</td>
                    </tr>
                <?php
                    $totalFactura += ($linea[2]*$producto['precio']);
                ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table class="total">
            <?php
                $sinIva = $totalFactura/(1+IVA); //x*1.21 = total -> x = total/1.21
            ?>
            <tr>
                <th>Importe</th>
                <td><?= number_format($sinIva,2) ?>€</td>
            </tr>
            <tr>
                <th>I.V.A.</th>
                <td><?= number_format($sinIva*IVA,2) ?>€</td>
            </tr>
            <tr>
                <th>Total</th>
                <td><?= number_format($totalFactura,2) ?>€</td>
            </tr>
        </table>

        <h3>Datos de facturación</h3>
        <?php
            //Cargar los datos del usuario
        ?>
        <p>Nombre: </p>
        <p>NIF: </p>
        <p>Dirección: </p>

        <form method="post">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<p>Pedido realizado correctamente!</p>";
            }else{
                echo "<button>Confirmar pedido</button>";
            }
        ?>
        </form>
        

    </main>

    <?php
        require "./html/pie.html";
    ?>
</body>
</html>
