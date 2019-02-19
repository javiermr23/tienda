
<?php
    require "./php/init.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/login.css">
    <title>Login</title>
</head>

<body>
    <?php require "./html/cabecera.php"; ?>
    <main>
    <form action="" method="post">
        <div>
            <label for="mail"><b>E-mail</b></label>
            <input type="text" placeholder="Introduce tu email" name="mail" required="required">
        </div>
        <div>
            <label for="psw"><b>Contraseña</b></label>
            <input type="password" placeholder="Introduce tu contraseña" name="psw" required="required">
        </div>
        <div>
            <button type="submit">Iniciar sesión</button>
        </div>
        <p class="registrarse">¿Aún no tienes cuenta? Regístrate <a href="./registro/registro.php">aquí</a>.</p>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_REQUEST['mail']) && isset($_REQUEST['psw'])){
                    $mail = $_REQUEST['mail'];
                    $pass = $_REQUEST['psw'];

                    if($usuario = Usuario::iniciarSesion($mail, $pass)){
                        $_SESSION['usuario'] = $usuario;
                        header("Location: ./index.php");
                    }elseif($admin = Administrador::iniciarSesion($mail, $pass)){
                        $_SESSION['admin'] = $admin;
                        header("Location: ./administracion/index.html");
                    }else{
                        echo "<p>El e-mail o contraseña no son correctos.</p>";
                    }
                }
            }
        ?>
    </form>
    
    </main>

    <?php require "./html/pie.html" ?>
</body>

</html>