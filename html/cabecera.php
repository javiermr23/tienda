<header>
    <div class="cabecera">
        <a href="./index.php" class="logo"><img src="resources/img/logos/nuevoLogo.svg" alt="Logo"></a>
        <div class="menu"><img src="resources/img/iconos/menu.svg" alt="Menú"></div>
        <div class="buscar">
            <div id="lupa">
                <img src="resources/img/iconos/search.svg" alt="Buscar">
            </div>
            <input id="cuadroBuscar" type="text" name="buscar" placeholder="Busca un producto.">
            <div id="listaBusqueda"></div>
        </div>
        <div class="usuario">
            <?php if(isset($_SESSION['usuario'])): ?>
                <div><a href="./cuenta.php"><img src="resources/img/iconos/user.svg" alt="Cuenta"></a></div>
                <div><a href="./logout.php"><img src="resources/img/iconos/logout.svg" alt="Logout"></a></div>
            <?php else: ?>
                <div><a href="./login.php"><img src="resources/img/iconos/login.svg" alt="Login"></a></div>
            <?php endif; ?>

            <div>
                <img id="carrito" src="resources/img/iconos/cart.svg" alt="Carrito">
                <div id="cesta">
                    <div id="lineasCesta"></div>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <a href="./pedido.php">Realizar Pedido</a>
                    <?php else: ?>
                        <a href="./login.php">Login</a>
                    <?php endif; ?>
                </div>
                <div id="contadorCesta"></div>
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
<script src="resources/js/header.js"></script>