
//Elementos
let elemHamburguesa = document.querySelector("header div.menu>img");
let elemNav = document.querySelector("header nav");
let elemCarrito = document.getElementById("carrito");
let elemCesta = document.getElementById("cesta");

//Variables
let listaProductos = [];
cargarListaProductos();
console.log(listaProductos);


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