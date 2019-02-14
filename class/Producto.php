<?php
    class Producto{


        public static cargarProducto($id){
            $sql = "SELECT *
                    FROM producto
                    WHERE id = :id";

            try {
                $sentencia = Database::$conexion->prepare($sql);
                $sentencia->bind_param(":id", $id, PDO::PARAM_INT);
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
    }
?>
