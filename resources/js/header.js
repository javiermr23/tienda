
//Elementos
let elemHamburguesa = document.querySelector("header div.menu>img");
let elemNav = document.querySelector("header nav");
let elemCarrito = document.getElementById("carrito");
let elemCesta = document.getElementById("cesta");

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