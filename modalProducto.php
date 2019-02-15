
<?php
    require "./class/init.php";

    if(isset($_REQUEST['id'])){
        if($producto = Producto::cargarProducto($_REQUEST['id'])){
            echo implode(';',$producto);
        }else{
            echo "Error BD";
        }
    }else{
        echo "Error ID";
    }
    
?>