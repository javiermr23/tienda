
//Elementos
let elemHamburguesa = document.querySelector("header div.menu>img");
let elemNav = document.querySelector("header nav");
let elemCarrito = document.getElementById("carrito");
let elemCesta = document.getElementById("cesta");
let elemLineasCesta = document.getElementById("lineasCesta");
let elemCuadroBuscar = document.getElementById("cuadroBuscar");
let elemListaBusqueda = document.getElementById("listaBusqueda");

//Variables autocompletar búsqueda
let listaProductos = new Array();
cargarListaProductos();
let listaMostrada = new Array();

//Variables cesta de la compra
let cesta = new Array();
cargarDatosCesta();

//Constantes
const numOcurrencias = 10; //Cuántos productos mostrar en la lista


//Evento para desplegar el menú
elemHamburguesa.addEventListener('click', ()=>{
    elemNav.classList.toggle('visible');
});

//Desplegar el menú al cargar la página
setTimeout(() => {
    elemNav.classList.toggle('visible');
}, 500);

//Evento para desplegar la cesta
elemCarrito.addEventListener('click',()=>{
    elemCesta.classList.toggle('mostrarCesta');
});

/* ------------------AUTOCOMPLETAR--------------------------- */
//Evento introducir caracteres de búsqueda
elemCuadroBuscar.addEventListener('input', ()=>{
    let termino = elemCuadroBuscar.value.toLowerCase();
    if(termino!=""){
        listaMostrada = new Array();
        let regexp = new RegExp(`\w*${termino}\w*`);
        for(i=0; i<listaProductos.length; i++){
            if(listaMostrada.length<=numOcurrencias){
                if(regexp.test(listaProductos[i][0].toLowerCase())){
                    listaMostrada.push(listaProductos[i]);
                }
            }else{
                break;
            }
        }
        mostrarBusqueda();
    }else{
        elemListaBusqueda.style.display = "none";
    }
    
});

/* ---------------------------CESTA----------------------------------- */

//Evento para borrar productos de la cesta
elemCesta.addEventListener('click', evt=>{
    let target = evt.target;
    if(target.classList.contains('borrarLinea')){
        borrarCesta(target.parentElement.id);
    }else if(target.classList.contains('menosLinea')){
        modLineaCesta(target.parentElement.parentElement.id, -1);
    }else if(target.classList.contains('masLinea')){
        modLineaCesta(target.parentElement.parentElement.id, 1);
    }
});


/*--------------------------------------------------------------------
--------------------------------FUNCIONES--------------------------
---------------------------------------------------------------------*/

//Función para cargar la lista de productos desde autocompletar.php
function cargarListaProductos(){
    let request = new XMLHttpRequest();
    request.open("GET", `./autocompletar.php`, true);
    request.send();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let datos = this.responseText;
            let productos = datos.split(';');
            productos.forEach(p=>{
                let producto = p.split(',');
                listaProductos.push(producto);
            });
        }
    }
}

//Función para crear y mostrar los elementos de la lista de búsqueda
function mostrarBusqueda(){
    elemListaBusqueda.innerHTML = "";
    let fragment = document.createDocumentFragment();
    
    listaMostrada.forEach(p=>{
        let parrafo = document.createElement('p');
        parrafo.innerText = p[0];
        parrafo.id = p[1];
        fragment.appendChild(parrafo);
    });

    elemListaBusqueda.appendChild(fragment);
    elemListaBusqueda.style.display = 'block';
}

//Función añadir un producto a la cesta
function addCesta(id, nombre, cant){
    let request = new XMLHttpRequest();
    request.open("GET", `./cesta.php?func=add&id=${id}&nombre=${nombre}&cant=${cant}`, true);
    request.send();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cargarCesta(this.responseText);
        }
    }
}

//Función para borrar un producto de la cesta
function borrarCesta(id){
    let request = new XMLHttpRequest();
    request.open("GET", `./cesta.php?func=borrar&id=${id}`, true);
    request.send();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cargarCesta(this.responseText);
        }
    }
}

//Función para modificar la cantidad
function modLineaCesta(id, cant){
    let request = new XMLHttpRequest();
    request.open("GET", `./cesta.php?func=mod&id=${id}&cant=${cant}`, true);
    request.send();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cargarCesta(this.responseText);
        }
    }
}

//Función para pedir los datos de la cesta
function cargarDatosCesta(){
    let request = new XMLHttpRequest();
    request.open("GET", `./cesta.php?func=get`, true);
    request.send();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cargarCesta(this.responseText);
        }
    }
}

//Función para cargar la cesta a partir de los datos devueltos
function cargarCesta(datos){
    cesta = new Array();
    
    if(datos.trim() != ""){
        $lineasCesta = datos.trim().split(';');
        $lineasCesta.forEach((linea)=>{
            cesta.push(linea.split(','));
        });
    }

    pintarCesta();
}

//Función para pintar la cesta
function pintarCesta(){
    elemLineasCesta.innerHTML = "";
    let fragment = document.createDocumentFragment();
    if(cesta.length > 0){
        cesta.forEach((linea)=>{
            let id = parseInt(linea[0]);
    
            let contenedor = document.createElement('div');
            contenedor.id = id;
            contenedor.classList = "lineaCesta";
    
            let imagen = new Image();
            imagen.src = `./resources/img/productos/${id}.jpg`;
    
            let nombre = document.createElement('p');
            nombre.innerText = linea[1];
            nombre.classList = 'nombreLinea';
    
            let cantidad = document.createElement('p');
            cantidad.innerText = "Cantidad: " + linea[2];
            cantidad.classList = 'cantidadLinea';
            let menos = document.createElement('span');
            menos.innerText = '-';
            menos.classList = 'menosLinea';
            let mas = document.createElement('span');
            mas.innerText = '+';
            mas.classList = 'masLinea';
            cantidad.appendChild(menos);
            cantidad.appendChild(mas);
    
            let eliminar = document.createElement('p');
            eliminar.innerText = 'X';
            eliminar.classList = 'borrarLinea';
    
            contenedor.appendChild(imagen);
            contenedor.appendChild(nombre);
            contenedor.appendChild(cantidad);
            contenedor.appendChild(eliminar);
    
            fragment.appendChild(contenedor);
        });
    }else{
        let mensaje = document.createElement('p');
        mensaje.innerText = "Su cesta está vacía";
        mensaje.classList = "cestaVacia";
        fragment.appendChild(mensaje);
    }
    

    elemLineasCesta.appendChild(fragment);
}