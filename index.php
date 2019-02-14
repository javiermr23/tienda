
<?php
    require "./class/Database.php";
    $conexion = Database::crearConexion();
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
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
        </div>
        <div class="destacados">
            <h2>Destacados de hoy</h2>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
            <div class="tarjetaProducto">
                <img src="resources/img/productos/producto.jpg" alt="Producto">
                <p class="precioPeque">699€</p>
                <p class="precioGrande">589€</p>
                <p class="precioAhorro"><span>16%</span></p>
                <p class="stock">Stock: Me lo qutian de las manos!</p>
                <h3>Trutemaster TS-XW</h3>
            </div>
        </div>
    </main>

    <?php
        require "./html/pie.html";
    ?>
</body>

</html>