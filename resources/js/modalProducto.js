
//Elementos
let elemModal = document.getElementById('modal');
let elemMdlImgProducto = document.getElementById('mdl_imgProducto');
let elemMdlDesc = document.getElementById('mdl_desc');
let elemMdlNombre = document.getElementById('mdl_nombre');
let elemMdlPrecioPeque = document.getElementById('mdl_precioPeque');
let elemMdlPrecioGrande = document.getElementById('mdl_precioGrande');
let elemMdlAhorro = document.getElementById('mdl_ahorro');
let elemMdlMarca = document.getElementById('mdl_marca');
let elemMdlCat = document.getElementById('mdl_cat');
let elemMdlStock = document.getElementById('mdl_stock');
let elemMdlBtnLess = document.getElementById('mdl_btn-less');
let elemMdlBtnMore = document.getElementById('mdl_btn-more');
let elemMdlCantidad = document.getElementById('mdl_cantidad');
let elemMdlAddCesta = document.getElementById('mdl_addCesta');
let elemForm = document.querySelector('div#modal div.form');

//Variables
let prodModal; //Array con datos del producto

//Evento modificar cantidad
elemForm.addEventListener('click', (evt)=>{
    let target = evt.target;
    if(target == elemMdlBtnLess){
        let cant = parseInt(elemMdlCantidad.value);
        if(cant > 1){
            elemMdlCantidad.value = (cant - 1);
        }
    }else if(target == elemMdlBtnMore){
        let cant = parseInt(elemMdlCantidad.value);
        elemMdlCantidad.value = (cant + 1);
    }
});

//Evento añadir a la cesta
elemMdlAddCesta.addEventListener('click', ()=>{
    let id = parseInt(prodModal[0]);
    let nombre = prodModal[1];
    let cant = parseInt(elemMdlCantidad.value);
    addCesta(id, nombre, cant);
    elemModal.style.display = "none";
})


//Función para cargar el producto
function cargarProducto(id){
    let request = new XMLHttpRequest();
    request.open("GET", `./modalProducto.php?id=${id}`, true);
    request.send();

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let datos = this.responseText;
            prodModal = datos.split(';');
            prodModal[0] = parseInt(prodModal[0]);
            mostrarProducto();
        }
    }
}

//Función para mostrar los datos del producto en el modal de producto
function mostrarProducto(){
    let id = parseInt(prodModal[0]);
    let precio = parseFloat(prodModal[3]).toFixed(2);
    let ahorro = parseInt(prodModal[8]);
    let precioFinal = (precio*(1+ahorro/100)).toFixed(2);
    let uds = parseInt(prodModal[7]);

    elemMdlImgProducto.src = `./resources/img/productos/${id}.jpg`;
    elemMdlDesc.innerText = prodModal[2];
    elemMdlNombre.innerText = prodModal[1];

    if(ahorro){//Si tiene oferta
        elemMdlPrecioPeque.innerText = precio + "€";
        elemMdlPrecioGrande.innerText = precioFinal + "€";
        elemMdlAhorro.innerText = ahorro + "%";

        elemMdlPrecioPeque.style.display = "block";
        elemMdlPrecioGrande.style.display = "block";
        elemMdlAhorro.style.display = "inline-block";
    }else{//Si no tiene oferta
        elemMdlPrecioGrande.innerText = precio + "€";

        elemMdlPrecioPeque.style.display = "none";
        elemMdlPrecioGrande.style.display = "block";
        elemMdlAhorro.style.display = "none";
    }
    
    elemMdlMarca.innerText = "Marca: " + prodModal[5];
    elemMdlCat.innerText = "Categoría: " + prodModal[4];

    if(uds==0){
        elemMdlStock.innerText = "Disponibilidad: Producto agotado!";
        elemMdlStock.style.backgroundColor = "red";
    }else if(uds>10){
        elemMdlStock.innerText = "Disponibilidad: Producto disponible!";
        elemMdlStock.style.backgroundColor = "green";
    }else{
        elemMdlStock.innerText = "Disponibilidad: Quedan pocas unidades!";
        elemMdlStock.style.backgroundColor = "orange";
    }
}