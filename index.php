
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
    <link rel="stylesheet" href="resources/css/tarjetaProducto.css">
    <link rel="stylesheet" href="resources/css/portada.css">

    <title>Componentes José Manuel Illán</title>
</head>

<body>
    <?php
        require "./html/cabecera.html";
    ?>

    <main>

        <div class="slider">
            <img src="resources/img/banners/bannerNvidia.jpg" alt="Slider">
        </div>
        <div class="ofertas">
            <h2>Ofertas</h2>
            <!-- <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div> -->
            
            <?php if ($ofertas = Producto::cargarOfertas(5)): ?>
                <?php foreach ($ofertas as $o): ?>
                    <div class="tarjetaProducto">
                        <img src='resources/img/productos/<?= $o['id'] ?>.jpg' alt='Producto'>
                        <p class='precioPeque'><?= $o['precio'] ?>€</p>
                        <p class='precioGrande'><?= number_format($o['precio']*(1-$o['descuento']/100),2) ?>€</p>
                        <p class='precioAhorro'><span><?= $o['descuento'] ?>%</span></p>
                        <p class='stock'>Stock: Me lo qutian de las manos!</p>
                        <h3><?= $o['nombre'] ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Lo sentimos, no se han podido cargar las ofertas de hoy.</p>    
            <?php endif; ?>
            
            </div>
        </div>
        <div class="destacados">
            <h2>Destacados de hoy</h2>
            <!-- <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div> -->
            
            <?php if ($destacados = Producto::cargarDestacados(5)): ?>
                <?php foreach ($destacados as $d): ?>
                    <div class="tarjetaProducto">
                        <img src='resources/img/productos/<?= $d['id'] ?>.jpg' alt='Producto'>
                        <p class='precioPeque'><?= $d['precio'] ?>€</p>
                        <p class='precioGrande'><?= number_format($d['precio']*(1-$d['descuento']/100),2) ?>€</p>
                        <p class='precioAhorro'><span><?= $d['descuento'] ?>%</span></p>
                        <p class='stock'>Stock: Me lo qutian de las manos!</p>
                        <h3><?= $d['nombre'] ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Lo sentimos, no se han podido cargar las productos destacados.</p>    
            <?php endif; ?>
        </div>
    </main>

    <?php
        require "./html/pie.html";
    ?>
</body>
</html>