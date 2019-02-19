<?php

    require "../php/init.php";

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

            case "agregarDestacado":
                if (Producto::agregarDestacado($_POST['id'])) {
                    echo "true";
                }
                else {
                    echo "false";
                }
            break;

            case "quitarDestacado":
                if (Producto::quitarDestacado($_POST['id'])) {
                    echo "true";
                }
                else {
                    echo "false";
                }
            break;
        }

    }

?>