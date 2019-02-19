<?php
    class Usuario {


        public static function iniciarSesion($email, $pass) {
            $sql = "SELECT id, nombre, apellidos, email, contrasena, telefono, direccion, provincia, localidad, codigo_postal, dni
                    FROM usuario
                    WHERE email = :email";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":email", $email, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($pass, $usuario['contrasena'])) {
                        return $usuario;
                    }
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function existeUsuario($email) {
            $sql = "SELECT email
                    FROM usuario
                    WHERE email = :email";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    if ($stmt->fetch()) {
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

        public static function modificarDatos($id,$email,$tlfno,$direccion,$provincia,$localidad,$cPostal){
            $sql = "UPDATE usuario 
            SET email = :email, telefono = :tlfno, direccion = :direccion, 
            provincia = :provincia, localidad = :localidad, codigo_postal = :codigo_postal 
            WHERE id = :id";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":email",$email,PDO::PARAM_STR);
                $stmt->bindValue(":tlfno",$tlfno,PDO::PARAM_INT);
                $stmt->bindValue(":direccion",$direccion,PDO::PARAM_STR);
                $stmt->bindValue(":provincia",$provincia,PDO::PARAM_STR);
                $stmt->bindValue(":localidad",$localidad,PDO::PARAM_STR);
                $stmt->bindValue(":codigo_postal",$cPostal,PDO::PARAM_INT);
                $stmt->bindValue(":id",$id,PDO::PARAM_INT);
                $stmt->execute();

                Database::$conexion->commit();

            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
           
        }

        public static function cambiarContrasena($id,$pass){
            $sql = "UPDATE usuario 
            SET contrasena = :contrasena
            WHERE id = :id";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":contrasena",password_hash($pass,PASSWORD_DEFAULT),PDO::PARAM_STR);
                $stmt->bindValue(":id",$id,PDO::PARAM_INT);
                $stmt->execute();

                Database::$conexion->commit();

            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
        }

        public static function registrarUsuario($datos){
            $sql = "INSERT INTO usuario (nombre, apellidos, dni, email, contrasena, telefono, direccion, provincia, localidad, codigo_postal) 
            VALUES (:nombre, :apellidos, :dni, :email, :contrasena, :telefono, :direccion, :provincia, :localidad, :postal)";

            try {
                Database::$conexion->beginTransaction();
                $stmt = Database::$conexion->prepare($sql);
                
                $stmt->bindValue(":nombre", $datos['nombre'], PDO::PARAM_STR);
                $stmt->bindValue(":apellidos", $datos['apellidos'], PDO::PARAM_STR);
                $stmt->bindValue(":dni", $datos['dni'], PDO::PARAM_STR);
                $stmt->bindValue(":email", $datos['email'], PDO::PARAM_STR);
                $stmt->bindValue(":contrasena", password_hash($datos['contrasena'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                $stmt->bindValue(":telefono", $datos['telefono'], PDO::PARAM_INT);
                $stmt->bindValue(":direccion", $datos['direccion'], PDO::PARAM_STR);
                $stmt->bindValue(":provincia", $datos['provincia'], PDO::PARAM_STR);
                $stmt->bindValue(":localidad", $datos['localidad'], PDO::PARAM_STR);
                $stmt->bindValue(":postal", $datos['postal'], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    Database::$conexion->commit();
                    return true;
                }
            }
            catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function añadirFavorito($idUsuario,$idProducto){
            $sql = "INSERT INTO favorito (id_producto, id_usuario) 
            VALUES (:id_producto, :id_usuario)";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":id_producto",$idProducto,PDO::PARAM_INT);
                $stmt->bindValue(":id_usuario",$idUsuario,PDO::PARAM_INT);
                $stmt->execute();

                Database::$conexion->commit();
            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
        }

        // Funciones para realizar compra
        public static function crearFactura($fecha,$total,$iva, $idUsuario){
            $sql = "INSERT INTO factura (fecha, total, iva, id_usuario) 
            VALUES (:fecha, :total, :iva, :id_usuario)";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":fecha",$fecha,PDO::PARAM_STR);
                $stmt->bindValue(":total",$total,PDO::PARAM_STR);
                $stmt->bindValue(":iva",$iva,PDO::PARAM_INT);
                $stmt->bindValue(":id_usuario",$idUsuario,PDO::PARAM_INT);
                $stmt->execute();
                $id = Database::$conexion->lastInsertId();

                Database::$conexion->commit();
                return $id;
            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
        }

        public static function crearLineas($idProducto,$idFactura,$unidades, $importe){

            $sql = "INSERT INTO linea ( id_producto, id_factura, unidades, importe) 
            VALUES ( :id_producto, :id_factura, :unidades, :importe)";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":id_producto",$idProducto,PDO::PARAM_STR);
                $stmt->bindValue(":id_factura",$idFactura,PDO::PARAM_STR);
                $stmt->bindValue(":unidades",$unidades,PDO::PARAM_INT);
                $stmt->bindValue(":importe",$importe,PDO::PARAM_INT);
                $stmt->execute();

                Database::$conexion->commit();
            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }

        }

        public static function calcularFactura($cesta){
            $total = 0;
            foreach ($cesta as $clave => $valor) {
                $total += $valor['unidades'] * $valor['precio'];
            }
            return $total;
            
        }



        

        
    }
?>