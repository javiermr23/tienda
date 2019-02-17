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
                    productos.forEach(cur => {
                        let tr = `<tr class="pro-${cur["id"]}">
                            <td><img src="../resources/img/productos/${cur["id"]}.jpg" alt=""/></td>
                            <td>${cur["id"]}</td>
                            <td>${cur["nombre"]}</td>
                            <td>${cur["precio"]}€</td>
                            <td>${cur["unidades"]}</td>
                        </tr>`;
    
                        elms.pro.lis.querySelector("tbody").insertAdjacentHTML("beforeend", tr);
                    });
                }
            }
        }

        return {
            elms: elms,
            func: func
        }

    }();

    let data = function() {

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

                validarProducto: function() {
                    let errores = new Array();
                    let campos = new Map();
    
                    Array.from(form.elements).forEach(cur => {
                        campos.set(cur.name, cur.value);
                    });
    
                    if (!campos.get("nombre").match(/^\w+$/)) {
                        errores.push("El nombre es obligatorio");
                    }
                    return errores;
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

    let controller = function(ui, data) {

        let func = {
            gen: {

                addEventListeners: function() {
                    ui.elms.gen.men.addEventListener("click", func.gen.cambiarPagina);
                    ui.elms.adm.lis.addEventListener("click", func.adm.borrarAdministrador);
                    ui.elms.adm.add.addEventListener("submit", func.adm.agregarAdministrador);
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
                    
                    let errores = data.func.adm.validarAdministrador(evt.target);

                    if (errores.length === 0) {
                        func.adm.existeAdministrador(evt.target.elements['usuario'].value, evt.target);
                    }
                    else {
                        console.log(errores);
                    }
                },

                borrarAdministrador: function(evt) {
                    if (evt.target.classList.contains("borrarAdministrador")) {
                        data.func.adm.borrarAdministrador(evt.target.parentElement.id);
                        ui.func.adm.borrarAdministrador(evt.target.parentElement.parentElement);
                    }
                },

                existeAdministrador: async function(user, form) {
                    let existe = await data.func.adm.existeAdministrador(user);
                    existe = existe.split(/\r\n/)[1];
        
                    if (existe === "false") {
                        form.submit();
                    }
                    else {
                        console.log("Ese usuario ya existe");
                    }
                }

            },
            pro: {
                cargarInformacion: async function() {
                    let productos = await data.func.pro.cargarProductos();
                    data.info.productos = JSON.parse(productos);
                    ui.func.pro.cargarProductos(data.info.productos);
                }
            }
        };

        return {
            func: func
        }

    }(ui, data);

    controller.func.gen.addEventListeners();
    controller.func.pro.cargarInformacion();
    
}