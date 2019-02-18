<?php

    class Administrador {

        public static function iniciarSesion($mail, $pass) {
            $sql = "SELECT *
                    FROM administrador
                    WHERE email = :mail";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                if ($stmt->execute()) {
                    $administrador = $stmt->fetch();

                    if (password_verify($pass, $administrador['contrasena'])) {
                        return $administrador;
                    }
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function agregarAdministrador($datos) {
            $sql = "INSERT INTO administrador (nombre, apellidos, usuario, email, contraseña)
                    VALUES (:nombre, :apellidos, :usuario, :email, :contraseña)";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":nombre", $datos['nombre'], PDO::PARAM_STR);
                $stmt->bindValue(":apellidos", $datos['apellidos'], PDO::PARAM_STR);
                $stmt->bindValue(":usuario", $datos['usuario'], PDO::PARAM_STR);
                $stmt->bindValue(":email", $datos['email'], PDO::PARAM_STR);
                $stmt->bindValue(":contraseña", password_hash($datos['email'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    return true;
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function existeAdministrador($usuario) {
            $sql = "SELECT usuario
                    FROM administrador
                    WHERE usuario = :usuario";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":usuario", $usuario, PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                if ($stmt->execute()) {
                    $usuario = $stmt->fetch();
                    
                    if ($usuario) {
                        return true;
                    }
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function borrarAdministrador($id) {
            $sql = "DELETE FROM administrador
                    WHERE id = :id";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
                
                if ($stmt->execute()) {
                    return true;
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function agregarProducto($producto) {
            $sql = "INSERT INTO producto (nombre, precio, descripcion, fabricante, categoria)
                    VALUES (:nombre, :precio, :descripcion; :fabricante, :categoria)";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":nombre", $producto['nombre'], PDO::PARAM_STR);
                $stmt->bindValue(":precio", $producto['precio'], PDO::PARAM_STR);
                $stmt->bindValue(":descripcion", $producto['descripcion'], PDO::PARAM_STR);
                $stmt->bindValue(":fabricante", $producto['fabricante'], PDO::PARAM_STR);
                $stmt->bindValue(":categoria", $producto['categoria'], PDO::PARAM_STR);

                if ($stmt->execute()) {
                    return true;
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function descatalogarProducto($id) {
            $sql = "UPDATE producto
                    SET stock = -1
                    WHERE id = :id";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":id", $id, PDO::PARAM__INT);
                
                if ($stmt->execute()) {
                    return true;
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function agregarStock($id_producto, $cantidad) {
            $sql = "";
        }

    }

?>