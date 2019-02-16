
<?php
    class Database{
        public static $conexion;

        public static function crearConexion(){

            $host = "127.0.0.1";
            $user = "daw";
            $pass = "galileo";
            $name = "tienda";

            
            try {
                static::$conexion = new PDO("mysql:host=$host;dbname=$name;charset=utf8", $user, $pass);
                return true;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }
    }
?>