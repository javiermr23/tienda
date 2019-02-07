
let elemHamburguesa = document.querySelector("header div.menu>img");
let elemNav = document.querySelector("header nav");

//Evento para desplegar el menú
elemHamburguesa.addEventListener('click', ()=>{
    elemNav.classList.toggle('visible');
});

//Desplegar el menú al cargar la página
setTimeout(() => {
    elemNav.classList.toggle('visible');
}, 500);