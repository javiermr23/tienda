
<?php
    require "./php/init.php";

    if(!isset($_SESSION['cesta'])){
        $_SESSION['cesta'] = [];
    }

    if(isset($_GET['func'])){
        if($_GET['func'] == 'add'){//Añadir línea a la cesta
            if(isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['cant'])){
                addLineaCesta($_GET['id'], $_GET['nombre'], $_GET['cant']);
            }
        }elseif($_GET['func'] == 'borrar'){//Borrar producto de la cesta
            if(isset($_GET['id'])){
                borrarLineaCesta($_GET['id']);
            }
        }elseif($_GET['func'] == 'get'){//Devolver productos de la cesta
            devolverCesta();
        }elseif($_GET['func'] == 'mod'){//Modificar la cantidad de un producto
            if(isset($_GET['id']) && isset($_GET['cant'])){
                modLineaCesta($_GET['id'], $_GET['cant']);
            }
        }
    }

    function addLineaCesta($id, $nombre, $cant){
        $encontrado = false;//Si el producto ya está, sumamos a la cantidad
        foreach ($_SESSION['cesta'] as $i=>$linea) {
            if($linea[0] == $id){
                $_SESSION['cesta'][$i][2] = intval($linea[2]) + intval($cant);
                $encontrado = true;
            }
        }

        if(!$encontrado){//Si el producto no está lo añadimos
            $lineaCesta = [$id, $nombre, $cant];
            array_push($_SESSION['cesta'], $lineaCesta);
        }
        
        devolverCesta();
    }

    function modLineaCesta($id, $cant){
        foreach ($_SESSION['cesta'] as $i=>$linea) {
            if($linea[0] == $id){
                if($cant==1 || ($cant==-1 && intval($linea[2])>1))
                $_SESSION['cesta'][$i][2] = intval($linea[2]) + intval($cant);
            }
        }
        
        devolverCesta();
    }

    function borrarLineaCesta($id){
        foreach ($_SESSION['cesta'] as $i => $linea) {
            if($linea[0] == $id){
                //array_splice($_SESSION, $i, 1);
                unset($_SESSION['cesta'][$i]);
            }
        }
        devolverCesta();
    }

    function devolverCesta(){
        $cesta = [];
        foreach ($_SESSION['cesta'] as $linea) {
            $lineaCesta = implode(',', $linea);
            array_push($cesta, $lineaCesta);
        }
        echo implode(';', $cesta);
    }
?>