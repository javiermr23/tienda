<?php
    class Producto{
        public static cargarProducto($id){
            $sql = "SELECT *
                FROM producto
                WHERE id=:id";
            $sentencia = Database::conexion->prepare($sql);
            $sentencia->bind_param(":id",$id);

            if($sentencia->execute()){
                while($fila = $sentencia->fetch()){
                    print_r($fila);
                }
            }
        }
    }
?>
