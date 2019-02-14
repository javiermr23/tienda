<?php
    class Usuario {


        public static function iniciarSesion($email, $pass) {
            $sql = "SELECT nombre, apellidos, email, contraseña, telefono, direccion, provincia, localidad, codigo_postal
                    FROM usuarios
                    WHERE email = :email";

            try {
                $stmt = $connection->prepare($sql);
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

        
    }
?>