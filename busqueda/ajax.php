<?php

    require "../class/Database.php";
    require "../class/Producto.php";
    Database::crearConexion();

    if (isset($_GET['function'])) {
        switch ($_GET['function']) {
            case "cargarProductos":
                $productos = Producto::cargarTodosProductos();
                echo json_encode($productos);
            break;
        }
    }

?>