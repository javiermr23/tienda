
<?php
    require "./class/init.php";

    if($productos = PRODUCTO::cargarListaProductos()){
        $cadenaProductos = "";
        foreach($productos as $p){
            $cadenaProductos = $cadenaProductos . $p['nombre'] . ',' . $p['id'] . ';';
        }
        echo $cadenaProductos;
    }
    

    
?>