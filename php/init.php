<?php
    spl_autoload_register(function($class) {
        require "{$_SERVER['DOCUMENT_ROOT']}/class/$class.php";
    });

    if (!Database::crearConexion()) {
        die("No se ha podido conectar a la base de datos.");
    }

    session_start();
?>