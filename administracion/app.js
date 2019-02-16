{
    let ui = function() {
        let elms = {
            menu: document.querySelector(".adm-menu"),
            pagina: document.querySelector(".adm-paginas")
        };
        let adm = {
            tabla: document.querySelector("#administradores .listar"),
            form: document.querySelector("#administradores .añadir")
        };

        return {
            elms: elms,
            adm: adm,

            cambiarPagina: function(pagina) {
                let time = window.getComputedStyle(elms.pagina.firstElementChild).transitionDuration;
                time = Number.parseFloat(time.substring(0, time.length - 1)) * 1000;

                Array.from(elms.pagina.children).forEach(cur => {
                    if (cur.id === pagina) {
                        setTimeout(() => cur.classList.remove("pagina-oculta"), time);
                    }
                    else {
                        cur.classList.add("pagina-oculta");
                    }
                });
            },

            borrarAdministrador: function(fila) {
                let time = window.getComputedStyle(fila).transitionDuration;
                time = Number.parseFloat(time.substring(0, time.length - 1)) * 1000;
                console.log(time);
                fila.classList.add("ocultar");
                setTimeout(() => fila.remove(), time);
            }
        }
    }();

    let data = function() {

        return {
            agregarAdministrador: function(datos) {

            },

            borrarAdministrador: function(id) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send(`function=borrarAdministrador&id=${id.split("-")[1]}`);

                xhr.addEventListener("load", () => {
                    console.log(xhr.responseText);
                });
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
            
            validarFormulario: function(form) {
                let errores = new Array();
                let campos = new Map();

                Array.from(form.elements).forEach(cur => {
                    campos.set(cur.name, cur.value);
                });

                if (!campos.get("nombre").match(/^\w+$/)) {
                    errores.push("El nombre es obligatorio");
                }
                if (!campos.get("apellidos").match(/^\w+$/)) {
                    errores.push("El apellido es un campo obligatorio");
                }
                if (!campos.get("usuario").match(/^\w+$/)) {
                    errores.push("El nombre de usuario es un campo obligatorio");
                }
                if (!campos.get("email").match(/^\w+[@]{1,1}\w+[.]{1,1}\w+$/)) {
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

        }
    }();

    let controller = function(ui, data) {
        
        let existeAdministrador = async function(usuario, form) {
            let existe = await data.existeAdministrador(usuario);
            existe = existe.split(/\r\n/)[1];

            if (existe === "false") {
                // El usuario no existe y los datos son correctos y se envia el formulario
                form.submit();
            }
            else {
                // Mostrar mensaje de error
                console.log("Ese usuario ya existe");
            }
        }

        return {
            addEventListeners: async function() {
                ui.elms.menu.addEventListener("click", evt => {
                    if (evt.target.tagName === "LI") {
                        ui.cambiarPagina(evt.target.className);
                    }
                });
                ui.adm.tabla.addEventListener("click", evt => {
                    if (evt.target.classList.contains("borrarAdministrador")) {
                        data.borrarAdministrador(evt.target.parentElement.id);
                        ui.borrarAdministrador(evt.target.parentElement.parentElement);
                    }
                });
                ui.adm.form.addEventListener("submit", evt => {
                    evt.preventDefault();
                    
                    let errores = data.validarFormulario(evt.target);

                    if (errores.length === 0) {
                        existeAdministrador(evt.target.elements['usuario'].value, evt.target);
                    }
                    else {
                        console.log(errores);
                    }
                });
            },
            añadirAdministrador: function() {

            }
        }
    }(ui, data);

    controller.addEventListeners();
}