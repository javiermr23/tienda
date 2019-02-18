
<?php
    require "./class/init.php";

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
    <link rel="stylesheet" href="resources/css/pedido.css">
    <title>Confirmar Pedido</title>
</head>
<body>
    <?php
        require "./cabecera.php";
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

                    $l = [];
                    $l['id_producto'] = $linea[0];
                    $l['unidades'] = $linea[2];
                    $l['importe'] = $linea[2]*$producto['precio'];
                    array_push($lineasFactura, $l);
                ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table class="total">
            <?php
                $sinIva = number_format($totalFactura/(1+IVA), 2); //x*1.21 = total -> x = total/1.21
                $iva = number_format(floatval($sinIva)*IVA,2);
            ?>
            <tr>
                <th>Importe</th>
                <td><?= $sinIva ?>€</td>
            </tr>
            <tr>
                <th>I.V.A.</th>
                <td><?= $iva ?>€</td>
            </tr>
            <tr>
                <th>Total</th>
                <td><?= number_format($totalFactura,2) ?>€</td>
            </tr>
        </table>

        <h3>Datos de facturación</h3>
        
        <p>Nombre: <?= $_SESSION['usuario']['nombre'] . ' ' .  $_SESSION['usuario']['apellidos'] ?></p>
        <p>NIF: <?= $_SESSION['usuario']['dni'] ?></p>
        <p>Dirección: <?= $_SESSION['usuario']['direccion'] ?></p>
        <p>Localidad: <?= $_SESSION['usuario']['localidad'] ?></p>
        <p>Provincia: <?= $_SESSION['usuario']['provincia'] ?></p>

        <form method="post">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Si se ha pulsado el botón procedemos a guardar el pedido
                $f = new DateTime();
                $fecha = $f->format('Y-m-d H:i:s');
                //Primero guardamos la factura y con el id devuelto
                if($idFactura = Usuario::crearFactura($fecha, strval($totalFactura), IVA_INT, $_SESSION['usuario']['id'])){
                    //Guardamos las líneas de factura
                    foreach ($lineasFactura as $linea) {
                        Usuario::crearLineas($linea['id_producto'], $idFactura, $linea['unidades'], $linea['importe']);
                    }
                    echo "<p>Pedido realizado correctamente!</p>";
                }else{
                    echo "<p>Error al registrar su pedido, inténtelo de nuevo más tarde.</p>";
                }
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