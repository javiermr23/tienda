<?php

    require "../class/Database.php";
    require "../class/Administrador.php";
    Database::crearConexion();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        switch ($_POST['function']) {
            case "agregarAdministrador":

            break;

            case "borrarAdministrador":
                Administrador::borrarAdministrador($_POST['id']);
            break;

            case "existeAdministrador":
                if (Administrador::existeAdministrador($_POST['usuario'])) {
                    echo "true";
                }
                else {
                    echo "false";
                }
            break;

            case "cargarProductos":
                $productos = Administrador::listarProductos();
                echo json_encode($productos);
            break;

            case "existeProducto":
                if (Administrador::existeProducto($_POST['nombre'])) {
                    echo "true";
                }
                else {
                    echo "false";
                }
            break;

            case "modificarProducto":
                Producto::modificarProducto($_POST);
            break;
        }

    }

?>