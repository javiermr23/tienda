
<?php
    class Database{
        public static $conexion;

        public static function crearConexion(){

            $host = "127.0.0.1";
            $user = "daw";
            $pass = "galileo";
            $bd = "tienda";

            
            try {
                static::$conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $user, $pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return true;
        }
    }
?>