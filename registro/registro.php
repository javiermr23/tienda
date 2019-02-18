<?php
    require "../class/Administrador.php";
    require "../class/Database.php";
    require "../class/Usuario.php";
    Database::crearConexion();

    $nombre = "";
    $apellidos = "";
    $dni = "";
    $email = "";
    $telefono = "";
    $direccion = "";
    $provincia = "";
    $localidad = "";
    $postal = "";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errores = validarRegistro($_POST);

        if (empty($errores)) {
            if (!Usuario::existeUsuario($_POST['email'])) {
                if (Usuario::registrarUsuario($_POST)) {
                    // Iniciar sesión y redireccionar
                }
                else {
                    array_push($errores, "Ha habido un problema para registrarte. Por favor, inténtelo de nuevo.");
                }
            }
            else {
                array_push($errores, "Ya existe una cuenta con ese e-mail. Por favor, introduce uno distinto.");
            }
        }
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $provincia = $_POST['provincia'];
        $localidad = $_POST['localidad'];
        $postal = $_POST['postal'];
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
                    <label for="nombre">Nombre *</label>
                    <input type="text" name="nombre" id="nombre" value="<?= $nombre ?>"/>
                </div>
                <div>
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?= $apellidos ?>"/>
                </div>
                <div>
                    <label for="dni">DNI *</label>
                    <input type="text" name="dni" id="dni" value="<?= $dni ?>"/>
                </div>
                <div>
                    <label for="email">E-mail *</label>
                    <input type="text" name="email" id="email" value="<?= $email ?>"/>
                </div>
                <div>
                    <label for="telefono">Telefono *</label>
                    <input type="text" name="telefono" id="telefono" value="<?= $telefono ?>"/>
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
                    <input type="text" name="direccion" id="direccion" value="<?= $direccion ?>"/>
                </div>
                <div>
                    <label for="provincia">Provincia *</label>
                    <input type="text" name="provincia" id="provincia" value="<?= $provincia ?>"/>
                </div>
                <div>
                    <label for="localidad">Localidad *</label>
                    <input type="text" name="localidad" id="localidad" value="<?= $localidad ?>"/>
                </div>
                <div>
                    <label for="postal">Código postal *</label>
                    <input type="text" name="postal" id="postal" value="<?= $postal ?>"/>
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

        foreach ($datos as $d) {
            if (!preg_match("/\w+/", $d)) {
                array_push($errores, "Todos los campos son obligatorios.");
                break;
            }
        }
        if (!preg_match("/\d{7,8}\w{1,1}/", $datos['dni'])) {
            array_push($errores, "El formato del DNI no es correcto.");
        }
        if (!preg_match("/\w+[@]{1,1}[\w.]+/", $datos['email'])) {
            array_push($errores, "El formato del e-mail no es adecuado.");
        }
        if (!preg_match("/\d{9,9}/", $datos['telefono'])) {
            array_push($errores, "El teléfono debe estar conformado por 9 cifras.");
        }
        if ($datos['contrasena'] !== $datos['repetir']) {
            array_push($errores, "Las contraseñas no coinciden.");
        }
        if (!preg_match("/\d{5,5}/", $datos['postal'])) {
            array_push($errores, "El ZIP debe estar formado por 5 cifras.");
        }

        return $errores;
    }
?>