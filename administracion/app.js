{

    let ui = function() {

        let elms = {
            gen: {
                men: document.querySelector(".adm-menu"),
                pag: document.querySelector(".adm-paginas")
            },
            adm: {
                lis: document.querySelector("#administradores .adm-lis"),
                add: document.querySelector("#administradores .adm-add")
            },
            pro: {
                lis: document.querySelector("#productos .pro-lis"),
                mod: document.querySelector("#productos .pro-mod"),
                add: document.querySelector("#productos .pro-add")
            },
            modal: {
                window: document.querySelector(".adm-modal"),
                msg: document.querySelector(".modal-msg"),
                close: document.querySelector(".modal-ext")
            }
        };

        let func = {
            gen: {
                cambiarPagina: function(pagina) {
                    let time = window.getComputedStyle(elms.gen.pag.firstElementChild).transitionDuration;
                    time = Number.parseFloat(time.substring(0, time.length - 1)) * 1000;
    
                    Array.from(elms.gen.pag.children).forEach(cur => {
                        if (cur.id === pagina) {
                            setTimeout(() => cur.classList.remove("pagina-oculta"), time);
                        }
                        else {
                            cur.classList.add("pagina-oculta");
                        }
                    });
                }
            },
            adm: {
                borrarAdministrador: function(fila) {
                    let time = window.getComputedStyle(fila).transitionDuration;
                    time = Number.parseFloat(time.substring(0, time.length - 1)) * 1000;
                    fila.classList.add("ocultar");
                    Array.from(fila.children).forEach(cur => cur.style.borderColor = "transparent");
                    setTimeout(() => fila.remove(), time);
                    return time;
                }
            },
            pro: {
                cargarProductos: function(productos) {
                    let tbody = `<tbody>`;
                    let tb = elms.pro.lis.querySelector("tbody");

                    productos.forEach(cur => {
                        let tr = `<tr class="pro-${cur["id"]}">
                            <td><img src="../resources/img/productos/${cur["id"]}.jpg" alt=""/></td>
                            <td>${cur["id"]}</td>
                            <td>${cur["nombre"]}</td>
                            <td>${cur["precio"]}€</td>
                            <td>${cur["unidades"]}</td>
                        </tr>`;
    
                        tbody += tr;
                    });
                    tbody += `</tbody>`;

                    if (tb) {
                        tb.remove();
                    }
                    elms.pro.lis.querySelector("table").insertAdjacentHTML("beforeend", tbody);
                },

                habilitarFormulario: function() {
                    elms.pro.mod.querySelector("form button").removeAttribute("disabled");
                },

                seleccionar: function(datos) {
                    let fields = elms.pro.mod.querySelectorAll("form input[type='text']");
                    
                    Array.from(fields).forEach(cur => {
                        cur.value = datos[cur.name];
                    });
                }
            },

            modal: {
                borrar: function() {
                    Array.from(elms.modal.msg.children).forEach(cur => cur.remove());
                },

                cerrar: function() {
                    elms.modal.window.classList.remove("show");
                },

                cargar: function(mensajes) {
                    func.modal.borrar();
                    elms.modal.msg.insertAdjacentHTML("beforeend", "<p>La acción no se ha podido completar por los siguientes motivos:</p>");
                    
                    let ul = `<ul>`;
                    mensajes.forEach(m => {
                        console.log(m);
                        ul += `<li>${m}</li>`;
                    });
                    ul += `</ul>`;
                    elms.modal.msg.insertAdjacentHTML("beforeend", ul);
                },

                mostrar: function() {
                    elms.modal.window.classList.add("show");
                }
            }
        }

        return {
            elms: elms,
            func: func
        }

    }();

    let dt = function() {

        let func = {
            adm: {
                agregarAdministrador: function(datos) {

                },

                borrarAdministrador: function(id) {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "ajax.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.send(`function=borrarAdministrador&id=${id.split("-")[1]}`);
                },

                existeAdministrador: function(usuario) {
                    return new Promise ((accepted, rejected) => {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send(`function=existeAdministrador&usuario=${usuario}`);
        
                        xhr.addEventListener("load", () => {
                            accepted(xhr.responseText);
                        });
                    });
                },

                validarAdministrador: function(form) {
                    let errores = new Array();
                    let campos = new Map();
    
                    Array.from(form.elements).forEach(cur => {
                        campos.set(cur.name, cur.value);
                    });
    
                    if (!campos.get("nombre").match(/^\w+$/)) {
                        errores.push("El nombre es obligatorio");
                    }
                    if (!campos.get("apellidos").match(/^\w+\s*/)) {
                        errores.push("El apellido es un campo obligatorio");
                    }
                    if (!campos.get("usuario").match(/^\w+$/)) {
                        errores.push("El nombre de usuario es un campo obligatorio");
                    }
                    if (!campos.get("email").match(/^\w+[@]{1,1}\w+[.]{1,1}\w+/)) {
                        errores.push("El formato del email no es válido");
                    }
                    if (!campos.get("contrasena").match(/^\w+$/)) {
                        errores.push("La contraseña no puede estar vacía");
                    }
                    else {
                        if (campos.get("contrasena") !== campos.get("repetir")) {
                            errores.push("Las contraseñas no coinciden");
                        }
                    }
                    return errores;
                }
            },
            pro: {
                buscar: function(cadena) {
                    return productos = Array.from(info.productos).filter(cur => {
                        if (cur["nombre"].toLowerCase().includes(cadena.toLowerCase())) {
                            return cur;
                        }
                    });
                },

                cargarProductos: function() {
                    return new Promise((accepted, rejected) => {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("function=cargarProductos");
            
                        xhr.addEventListener("load", () => {
                            accepted(xhr.responseText);
                        });
                    });
                },

                existe: function(nombre) {
                    return new Promise((accepted, rejected) => {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send(`function=existeProducto&nombre=${nombre}`);
            
                        xhr.addEventListener("load", () => {
                            accepted(xhr.responseText);
                        });
                    });
                },

                validarProducto: function(campos) {
                    let errores = new Array();
    
                    if (campos.get("nombre").trim() === "") {
                        errores.push("El nombre no puede estar vacío");
                    }
                    if (campos.get("precio").trim() === "" || isNaN(campos.get("precio"))) {
                        errores.push("El precio es obligatorio");
                    }
                    else {
                        if (Number.parseFloat(campos.get("precio")) < 0) {
                            errores.push("El precio no puede ser inferior a 0");
                        }
                    }
                    if (!campos.get("unidades").match(/^\d+$/)) {
                        errores.push("El campo unidades debe completarse con cifras");
                    }
                    else {
                        if (Number.parseInt(campos.get("unidades")) < 0) {
                            errores.push("Las unidades no pueden ser menores de 0");
                        }
                    }
                    return errores;
                },

                validarImagen: function(path) {
                    if (path.trim() === "") {
                        return false;
                    }
                    else {
                        return true;
                    }
                }
            }
        }
        
        let info = {
            productos: undefined
        };

        return {
            func: func,
            info: info
        }

    }();

    let controller = function(ui, dt) {

        let func = {
            gen: {

                addEventListeners: function() {
                    ui.elms.gen.men.addEventListener("click", func.gen.cambiarPagina);
                    ui.elms.adm.lis.addEventListener("click", func.adm.borrarAdministrador);
                    ui.elms.adm.add.addEventListener("submit", func.adm.agregarAdministrador);
                    ui.elms.pro.lis.addEventListener("input", func.pro.buscar);
                    ui.elms.pro.lis.addEventListener("click", func.pro.seleccionar);
                    ui.elms.pro.mod.addEventListener("submit", func.pro.modificar);
                    ui.elms.pro.add.addEventListener("submit", func.pro.añadir);
                    ui.elms.modal.close.addEventListener("click", func.modal.cerrar);
                },

                cambiarPagina: function(evt) {
                    if (evt.target.tagName === "LI") {
                        ui.func.gen.cambiarPagina(evt.target.className);
                    }
                }

            },
            adm: {

                agregarAdministrador: function(evt) {
                    evt.preventDefault();
                    
                    let errores = dt.func.adm.validarAdministrador(evt.target);

                    if (errores.length === 0) {
                        func.adm.existeAdministrador(evt.target.elements['usuario'].value, evt.target);
                    }
                    else {
                        ui.func.modal.cargar(errores);
                        ui.func.modal.mostrar();
                    }
                },

                borrarAdministrador: function(evt) {
                    if (evt.target.classList.contains("borrarAdministrador")) {
                        dt.func.adm.borrarAdministrador(evt.target.parentElement.id);
                        ui.func.adm.borrarAdministrador(evt.target.parentElement.parentElement);
                    }
                },

                existeAdministrador: async function(user, form) {
                    let existe = await dt.func.adm.existeAdministrador(user);
                    existe = existe.split(/\r\n/)[1];
        
                    if (existe === "false") {
                        form.submit();
                    }
                    else {
                        ui.func.modal.cargar(errores);
                        ui.func.modal.mostrar();
                    }
                }

            },
            pro: {

                añadir: async function(evt) {
                    let datos = new Map();
                    evt.preventDefault();

                    Array.from(ui.elms.pro.add.querySelectorAll("form input[type='text']")).forEach(cur => {
                        datos.set(cur.name, cur.value);
                    });

                    let errores = dt.func.pro.validarProducto(datos);

                    if (errores.length === 0) {
                        let existe = await dt.func.pro.existe(datos.get("nombre"));

                        if (existe.trim() === "false") {
                            evt.submit();
                        }
                        else {
                            ui.func.modal.cargar(["Existe un producto con ese nombre"]);
                            ui.func.modal.mostrar();
                        }
                    }
                    else {
                        ui.func.modal.cargar(errores);
                        ui.func.modal.mostrar();
                    }
                },

                buscar: function(evt) {
                    if (evt.target.name === "busqueda") {
                        let productos = dt.func.pro.buscar(evt.target.value);
                        ui.func.pro.cargarProductos(productos);
                    }
                },

                cargarInformacion: async function() {
                    let productos = await dt.func.pro.cargarProductos();
                    dt.info.productos = JSON.parse(productos);
                    ui.func.pro.cargarProductos(dt.info.productos);
                },

                modificar: function(evt) {
                    let datos = new Map();
                    evt.preventDefault();

                    Array.from(ui.elms.pro.mod.querySelectorAll("form input[type='text']")).forEach(cur => {
                        datos.set(cur.name, cur.value);
                    });

                    let errores = dt.func.pro.validarProducto(datos);
                    
                    if (errores.length === 0) {
                        evt.target.submit();
                    }
                    else {
                        ui.func.modal.cargar(errores);
                        ui.func.modal.mostrar();
                    }
                },

                seleccionar: function(evt) {
                    if (evt.target.tagName.toLowerCase() === "td") {
                        let datos = Array.from(evt.target.parentElement.children);
                        let producto = {
                            id: datos[1].textContent,
                            nombre: datos[2].textContent,
                            precio: datos[3].textContent.split("€")[0],
                            unidades: datos[4].textContent
                        };
                        ui.func.pro.habilitarFormulario();
                        ui.func.pro.seleccionar(producto);
                    }
                }
            },
            modal: {
                cerrar: function() {
                    ui.func.modal.cerrar();
                }
            }
        };

        return {
            func: func
        }

    }(ui, dt);

    controller.func.gen.addEventListeners();
    controller.func.pro.cargarInformacion();
    
}