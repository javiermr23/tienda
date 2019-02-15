
//Eventos
document.addEventListener('click', (evt)=>{
    let target = evt.target;//Si el target es tarjetaProducto
    //Si el target es un hijo de tarjetaProducto
    if(target.parentElement.classList.contains('tarjetaProducto')){
        target=target.parentElement;
    }else if(!target.classList.contains('tarjetaProducto')){//Si el target es otra cosa
        target=false;
    }

    if(target){
        elemModal.style.display = "grid";
        cargarProducto(target.id);
    }else{
        elemModal.style.display = "none";
    }
});