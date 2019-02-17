<?php
    require "../class/Database.php";
    require "../class/Administrador.php";
    Database::crearConexion();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        switch ($_POST['enviar']) {

            case "agregarAdministrador":
                Administrador::agregarAdministrador($_POST);
            break;
            case "agregarProducto":
            
            break;

        }

    }
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Administración de la tienda</title>
        <link rel="stylesheet" href="../css/reset.css"/>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>

        </header>
        <main>
            <nav class="adm-menu">
                <ul>
                    <li class="administradores">
                        <img src="../resources/img/iconos/administracion/administradores.svg" alt="Icono de administradores"/>
                        <span>Administradores</span>
                    </li>
                    <li class="productos">
                        <img src="../resources/img/iconos/administracion/productos.svg" alt="Icono de productos"/>
                        <span>Productos</span>
                    </li>
                    <li class="usuarios">
                        <img src="../resources/img/iconos/administracion/usuarios.svg" alt="Icono de usuarios"/>
                        <span>Usuarios</span>
                    </li>
                    <li class="promociones">
                        <img src="../resources/img/iconos/administracion/promociones.svg" alt="Icono de promociones"/>
                        <span>Promociones</span>
                    </li>
                    <li class="cerrar-sesion">
                        <img src="../resources/img/iconos/administracion/cerrar-sesion.svg" alt="Icono de salida"/>
                        <span>Logout</span>
                    </li>
                </ul>
            </nav>
            <section class="adm-paginas">

                <section id="administradores">
                    <h1>Administradores</h1>
                    <section class="adm-lis">
                        <h2>Listado de administradores</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>E-mail</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(Administrador::listarAdministradores() as $a): ?>
                                    <tr>
                                        <td><?= $a['id'] ?></td>
                                        <td><?= $a['nombre'] . " " . $a['apellidos'] ?></td>
                                        <td><?= $a['usuario'] ?></td>
                                        <td><?= $a['email'] ?></td>
                                        <td id="adm-<?= $a['id'] ?>"><img class="borrarAdministrador" src="../resources/img/iconos/administracion/borrar.svg" alt=""/></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                    <section class="adm-add">
                        <h2>Añadir administrador</h2>
                        <form class="añadir" method="post">
                            <div>
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre"/>
                            </div>
                            <div>
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos"/>
                            </div>
                            <div>
                                <label for="usuario">Usuario</label>
                                <input type="text" name="usuario" id="usuario"/>
                            </div>
                            <div>
                                <label for="email">E-mail</label>
                                <input type="text" name="email" id="email"/>
                            </div>
                            <div>
                                <label for="contrasena">Contraseña</label>
                                <input type="password" name="contrasena" id="contrasena"/>
                            </div>
                            <div>
                                <label for="repetir">Repetir contraseña</label>
                                <input type="password" name="repetir" id="repetir"/>
                            </div>
                            <button class="btn">
                                <img src="../resources/img/iconos/administracion/agregar.svg" alt="Añadir administrador">
                                <span>Añadir</span>
                            </button>
                            <input type="hidden" name="enviar" value="agregarAdministrador">
                        </form>
                    </section>
                </section>

                <section id="productos" class="pagina-oculta">
                    <h1>Productos</h1>
                    <section class="pro-lis">
                        <h2>Listado de productos</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Unidades</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </section>
                    <section class="pro-mod">
                        <h2>Modificar producto</h2>
                        <p>Selecciona un producto del listado para modificar sus datos.</p>
                    </section>
                    <section class="pro-add">
                        <h2>Añadir producto</h2>
                        <form method="post" enctype="multiparts/form-data">
                            <div>
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre"/>
                            </div>
                            <div>
                                <label for="precio">Precio</label>
                                <input type="text" name="precio" id="precio"/>
                            </div>
                            <div>
                                <label for="unidades">Unidades</label>
                                <input type="text" name="unidades" id="unidades"/>
                            </div>
                            <div>
                                <label for="imagen">Imagen</label>
                                <input type="file" name="imagen" id="imagen"/>
                            </div>
                            <button class="btn">
                                <img src="../resources/img/iconos/administracion/agregar.svg" alt="Añadir producto">
                                <span>Añadir</span>
                            </button>
                            <input type="hidden" name="enviar" value="agregarProducto">
                        </form>
                    </section>
                </section>

                <section id="usuarios" class="pagina-oculta">
                    <h1>Usuarios</h1>

                </section>

                <section id="promociones" class="pagina-oculta">
                    <h1>Promociones</h1>

                </section>
            </section>
        </main>
        <script src="app.js"></script>
    </body>
</html>
