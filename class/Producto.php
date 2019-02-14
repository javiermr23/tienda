<?php
    class Producto{

        /* Devuelve un array de producto */
        public static function cargarProducto($id){
            $sql = "SELECT *
                    FROM producto
                    WHERE id = :id";

            try {
                $sentencia = Database::$conexion->prepare($sql);
                $sentencia->bindValue(":id", $id, PDO::PARAM_INT);
                $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    
                if ($sentencia->execute()) {
                    return $sentencia->fetch();
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        /* Devuelve un array de productos en oferta con los datos:
           id, nombre, precio y descuento */
        public static function cargarOfertas($limite=10){
            $sql = "SELECT p.id, p.nombre, p.precio, o.descuento
                    FROM producto as p inner join promocion as o
                    ON p.id=o.id_producto
                    LIMIT :limite";

            try {
                $sentencia = Database::$conexion->prepare($sql);
                $sentencia->bindValue(":limite", $limite, PDO::PARAM_INT);
                $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    
                if ($sentencia->execute()) {
                    return $sentencia->fetchAll();
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        /* Devuelve un array de productos destacados con los datos:
           id, nombre y precio*/
        public static function cargarDestacados($limite=10){
            $sql = "SELECT p.id, p.nombre, p.precio, o.descuento
                    FROM producto as p left join promocion as o
                    ON p.id=o.id_producto
                    WHERE p.destacado=true
                    LIMIT :limite";

            try {
                $sentencia = Database::$conexion->prepare($sql);
                $sentencia->bindValue(":limite", $limite, PDO::PARAM_INT);
                $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    
                if ($sentencia->execute()) {
                    return $sentencia->fetchAll();
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        /* Devuelve un array de productos con los datos:
           id, nombre, precio, descuento*/
        public static function buscarProductos($termino){
            $sql = "SELECT p.id, p.nombre, p.precio, o.descuento
                    FROM producto as p left join descuento as o
                    ON p.id=o.id_producto
                    WHERE nombre like %:termino%";

            try {
                $sentencia = Database::$conexion->prepare($sql);
                $sentencia->bindValue(":termino", $termino, PDO::PARAM_STR);
                $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    
                if ($sentencia->execute()) {
                    return $sentencia->fetchAll();
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
