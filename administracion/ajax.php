<?php

    require "../class/Database.php";
    require "../class/Administrador.php";
    Database::crearConexion();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        if ($_POST['function'] === "agregarAdministrador") {

        }
        else if ($_POST['function'] === "borrarAdministrador") {
            Administrador::borrarAdministrador($_POST['id']);
        }
        else if ($_POST['function'] === "existeAdministrador") {
            if (Administrador::existeAdministrador($_POST['usuario'])) {
                echo "true";
            }
            else {
                echo "false";
            }
        }
        else if ($_POST['function'] === "cargarProductos") {
            $productos = Administrador::listarProductos();
            echo json_encode($productos);
        }

    }

?>