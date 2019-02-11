
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
    <header>
        <div class="cabecera">
            <div class="logo"><img src="resources/img/logos/logo.png" alt="Logo"></div>
            <div class="menu"><img src="resources/img/iconos/menu.svg" alt="Menú"></div>
            <div class="buscar">
                <div>
                    <img src="resources/img/iconos/search.svg" alt="Buscar">
                </div>
                <input type="text" name="buscar" placeholder="Busca un producto.">
            </div>
            <div class="usuario">
                <div><img src="resources/img/iconos/login.svg" alt="Login"></div>
                <div><img src="resources/img/iconos/user.svg" alt="Cuenta"></div>
                <div>
                    <img id="carrito" src="resources/img/iconos/cart.svg" alt="Carrito">
                    <div id="cesta"></div>
                </div>
            </div>
        </div>
        <nav>
            <a href=""><img src="resources/img/iconos/header/tarjetas-graficas.svg" alt="Gráficas">Tarjetas Gráficas</a>
            <a href=""><img src="resources/img/iconos/header/procesadores.svg" alt="Procesadores">Procesadores</a>
            <a href=""><img src="resources/img/iconos/header/memoria-ram.svg" alt="RAM">Memoria RAM</a>
            <a href=""><img src="resources/img/iconos/header/fuentes-alimentacion.svg" alt="Fuentes">Fuentes de
                alimentación</a>
            <a href=""><img src="resources/img/iconos/header/placas-base.svg" alt="Placas">Placas base</a>
            <a href=""><img src="resources/img/iconos/header/discos-duros.svg" alt="HDD">Discos Duros</a>
            <a href=""><img src="resources/img/iconos/header/cajas.svg" alt="Cajas">Cajas</a>
            <a href=""><img src="resources/img/iconos/header/ventilacion.svg" alt="Ventilación">Ventilación</a>
        </nav>
    </header>
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
    <footer>
        <p>Práctica conjunta 2ºDAW | Tienda Componentes</p>
        <div class="rrss">
            <a href="#"><img src="resources/img/iconos/rrss/facebook.svg" alt="Facebook"></a>
            <a href="#"><img src="resources/img/iconos/rrss/instagram.svg" alt="Instagram"></a>
            <a href="#"><img src="resources/img/iconos/rrss/twitter.svg" alt="Twitter"></a>
            <a href="#"><img src="resources/img/iconos/rrss/google-plus.svg" alt="GooglePlus"></a>
            <a href="#"><img src="resources/img/iconos/rrss/linkedin.svg" alt="LinkedIn"></a>
        </div>
    </footer>
    <script src="resources/js/header.js"></script>
</body>

</html>