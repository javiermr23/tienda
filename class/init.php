
<?php
    require "./class/Database.php";
    require "./class/Producto.php";
    require "./class/Usuario.php";
    require "./class/Administrador.php";

    Database::crearConexion();

    session_start();
?>