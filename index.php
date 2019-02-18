<?php
    require "./php/init.php";
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/tarjetaProducto.css">
    <link rel="stylesheet" href="resources/css/portada.css">
    <link rel="stylesheet" href="busqueda/busqueda.css">
    <title>Portada</title>
</head>
<body>
    <?php require "./html/cabecera.php"; ?>
    <main>
        <div class="slider">
            <img src="resources/img/banners/bannerNvidia.jpg" alt="Slider">
        </div>
        <div class="ofertas">
            <h2>Ofertas</h2>
            <?php if ($ofertas = Producto::cargarOfertas(8)): ?>
                <?php foreach ($ofertas as $o): ?>
                    <div class="tarjetaProducto" id='<?= $o['id'] ?>'>
                        <img src='resources/img/productos/<?= $o['id'] ?>.jpg' alt='Producto'>
                        <p class='precioPeque'><?= $o['precio'] ?>€</p>
                        <p class='precioGrande'><?= number_format($o['precio']*(1-$o['descuento']/100),2) ?>€</p>
                        <p class='precioAhorro'><span><?= $o['descuento'] ?>%</span></p>
                        
                        <?php if ($o['unidades'] === 0): ?>
                            <p class='stock nada'>¡Stock agotado!</p>
                        <?php elseif ($o['unidades'] > 10): ?>
                            <p class='stock muchas'>¡Stock disponible!</p>
                        <?php else: ?>
                            <p class='stock pocas'>¡Quedan pocas unidades!</p>
                        <?php endif; ?>
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
            <?php if ($destacados = Producto::cargarDestacados(8)): ?>
                <?php foreach ($destacados as $d): ?>
                    <div class="tarjetaProducto" id='<?= $d['id'] ?>'>
                        <img src='resources/img/productos/<?= $d['id'] ?>.jpg' alt='Producto'>

                        <?php if($d['descuento'] > 0): ?>
                            <p class='precioPeque'><?= $d['precio'] ?>€</p>
                            <p class='precioGrande'><?= number_format($d['precio']*(1-$d['descuento']/100),2) ?>€</p>
                            <p class='precioAhorro'><span><?= $d['descuento'] ?>%</span></p>
                        <?php else: ?>
                            <p class='precioGrande'><?= number_format($d['precio']) ?>€</p>
                        <?php endif; ?>

                        <?php if($d['unidades'] === 0): ?>
                            <p class='stock nada'>¡Stock agotado!</p>
                        <?php elseif($d['unidades'] > 10): ?>
                            <p class='stock muchas'>¡Stock disponible!</p>
                        <?php else: ?>
                            <p class='stock pocas'>¡Quedan pocas unidades!</p>
                        <?php endif; ?>
                        <h3><?= $d['nombre'] ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Lo sentimos, no se han podido cargar las productos destacados.</p>    
            <?php endif; ?>
        </div>
        <?php require "./busqueda/busqueda.php" ?>
    </main>
    <?php require "./html/modalProducto.html"; ?>
    <?php require "./html/pie.html"; ?>
    <script src="./resources/js/portada.js"></script>
</body>
</html>