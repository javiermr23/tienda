<?php
    require "../class/Administrador.php";
    require "../class/Database.php";
    require "../class/Usuario.php";
    Database::crearConexion();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errores = validarRegistro($_POST);

        if (empty($errores)) {

        }
    }
?>
<!DOCTYPE html>
<html lang="en-ES">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Registro de usuario</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/tarjetaProducto.css">
        <link rel="stylesheet" href="../resources/css/portada.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <main>
            <h1>Registrar nuevo usuario</h1>
            <form method="post">
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre"/>
                </div>
                <div>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos"/>
                </div>
                <div>
                    <label for="email">E-mail *</label>
                    <input type="text" name="email" id="email"/>
                </div>
                <div>
                    <label for="telefono">Telefono *</label>
                    <input type="text" name="telefono" id="telefono"/>
                </div>
                <div>
                    <label for="contrasena">Contraseña *</label>
                    <input type="password" name="contrasena" id="contrasena"/>
                </div>
                <div>
                    <label for="repetir">Repite *</label>
                    <input type="password" name="repetir" id="repetir"/>
                </div>
                <div>
                    <label for="direccion">Direccion *</label>
                    <input type="text" name="direccion" id="direccion"/>
                </div>
                <div>
                    <label for="provincia">Provincia *</label>
                    <input type="text" name="provincia" id="provincia"/>
                </div>
                <div>
                    <label for="localidad">Localidad *</label>
                    <input type="text" name="localidad" id="localidad"/>
                </div>
                <div>
                    <label for="postal">Código postal *</label>
                    <input type="text" name="postal" id="postal"/>
                </div>
                <button>
                    <img src="" alt=""/>
                    <span>Registrarse</span>
                </button>
            </form>
            <aside>
                <section class="info">
                    <p>Regístrate en nuestra tienda y empieza a disfrutar de todas nuestros servicios:</p>
                    <ul>
                        <li>Una selección de miles de productos a tu disposición.</li>
                        <li>Ofertas diarias con descuentos increíbles a los que no te podrás resistir.</li>
                        <li>Los productos más novedosos en el mercado de los componentes de ordenador.</li>
                    </ul>
                </section>
                <?php if(isset($errores) && !empty($errores)): ?>
                    <section class="errores">
                        <p>No se ha podido completar la suscripción. Por favor, revisa el siguiente listado de errores:</p>
                        <ul>
                            <?php foreach ($errores as $e): ?>
                                <li><?= $e ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endif; ?>
            </aside>
        </main>
    </body>
</html>
<?php
    function validarRegistro($datos) {
        $errores = array();

        if (!preg_match("/\w+/", $datos['nombre'])) {
            array_push($errores, "El campo 'nombre' es obligatorio.");
        }

        return $errores;
    }
?>