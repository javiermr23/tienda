
<?php
    class Database{
        public static function crearConexion(){

            $host = "sergiogt.ddns.net";
            $user = "daw";
            $pass = "galileo";
            $bd = "tienda";

            
            try {
                $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $user, $pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return true;
        }
    }
?>