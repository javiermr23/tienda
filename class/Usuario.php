<?php
    class Usuario {


        public static function iniciarSesion($email, $pass) {
            $sql = "SELECT nombre, apellidos, email, contraseña, telefono, direccion, provincia, localidad, codigo_postal
                    FROM usuario
                    WHERE email = :email";

            try {
                $stmt = Database::$conexion->prepare($sql);
                $stmt->bindValue(":email", $email, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($pass, $usuario['contraseña'])) {
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

        public static function cambiarContraseña($id,$pass){
            $sql = "UPDATE usuario 
            SET contraseña = :contraseña
            WHERE id = :id";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":contraseña",password_hash($pass,PASSWORD_DEFAULT),PDO::PARAM_STR);
                $stmt->bindValue(":id",$id,PDO::PARAM_INT);
                $stmt->execute();

                Database::$conexion->commit();

            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
        }

        public static function registrarUsuario($nombre,$apellidos,$email,$contraseña,$telefono,$direccion,$provincia,$localidad,$cPostal){
            $sql = "INSERT INTO usuario ( nombre, apellidos, email, contraseña, telefono, direccion, provincia, localidad, codigo_postal) 
            VALUES (:nombre, :apellidos, :email, :contraseña, :telefono, :direccion, :provincia, :localidad, :codigo_postal)";

            try {
                $stmt = Database::$conexion->prepare($sql);
                Database::$conexion->beginTransaction();

                $stmt->bindValue(":nombre",$nombre,PDO::PARAM_STR);
                $stmt->bindValue(":apellidos",$apellidos,PDO::PARAM_STR);
                $stmt->bindValue(":email",$email,PDO::PARAM_STR);
                $stmt->bindValue(":tlfno",$tlfno,PDO::PARAM_INT);
                $stmt->bindValue(":direccion",$direccion,PDO::PARAM_STR);
                $stmt->bindValue(":provincia",$provincia,PDO::PARAM_STR);
                $stmt->bindValue(":localidad",$localidad,PDO::PARAM_STR);
                $stmt->bindValue(":codigo_postal",$cPostal,PDO::PARAM_INT);

                Database::$conexion->commit();

            } catch (PDOException $e) {
                Database::$conexion->rollBack();
                echo $e->getMessage();
                return false;
            }
        }

        

        
    }
?>