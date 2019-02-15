
//Elementos
let elemHamburguesa = document.querySelector("header div.menu>img");
let elemNav = document.querySelector("header nav");
let elemCarrito = document.getElementById("carrito");
let elemCesta = document.getElementById("cesta");
let elemCuadroBuscar = document.getElementById("cuadroBuscar");
let elemListaBusqueda = document.getElementById("listaBusqueda");

//Variables
let listaProductos = new Array();
cargarListaProductos();
let listaMostrada = new Array();

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
    console.log(`Añadido a la cesta ${cant} unidades del producto ${nombre} con id ${id}`);
}