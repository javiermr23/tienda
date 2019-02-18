{
    let ui = (function() {

        elms = {
            hea: { // Header
                search: document.querySelector("#cuadroBuscar"),
            },
            bus: { // Busqueda
                pag: document.querySelector("#pag-busqueda"),
                fil: document.querySelector(".bus-fil"),
                clo: document.querySelector(".bus-clo")
            }
        };

        func = {
            bus: {
                mostrar: function() {
                    elms.bus.pag.classList.remove("ocultar");
                    document.querySelector("body").classList.add("fixedHeight");
                },

                ocultar: function() {
                    elms.bus.pag.classList.add("ocultar");
                    document.querySelector("body").classList.remove("fixedHeight");
                }
            },
            pro: {
                filtrosSeleccionados: function() {
                    let filtros = {
                        tipo: new Array(),
                        marca: new Array()
                    };

                    Array.from(elms.bus.fil.querySelectorAll(".fil-tipo input[type='checkbox']")).forEach(cur => {
                        if (cur.checked) {
                            filtros.tipo.push(cur.id);
                        }
                    });
                    Array.from(elms.bus.fil.querySelectorAll(".fil-marca input[type='checkbox']")).forEach(cur => {
                        if (cur.checked) {
                            filtros.marca.push(cur.id);
                        }
                    });
                    return filtros;
                }
            }
        };

        return {
            elms: elms,
            func: func
        }

    })();

    let dt = (function() {

        data = {
            pro: undefined
        };

        func = {
            pro: {
                cargarProductos: function() {
                    let xhr = new XMLHttpRequest();
                    xhr.open("GET", "busqueda/ajax.php?function=cargarProductos", true);
                    xhr.send();

                    xhr.addEventListener("load", function() {
                        data.pro = JSON.parse(xhr.responseText);
                    });
                },

                buscar: function(patron) {
                    return data.pro.filter(cur => cur["nombre"].toLowerCase().includes(patron.toLowerCase()));
                },

                filtrar: function(productos, filtros) {
                    console.log(filtros);
                }
            }
        }

        return {
            data: data,
            func: func
        }

    })();

    let controller = (function(ui, dt) {

        func = {

            gen: {
                addEventListeners: function() {
                    ui.elms.hea.search.addEventListener("focus", func.bus.mostrar);
                    ui.elms.bus.clo.addEventListener("click", func.bus.ocultar);
                    ui.elms.hea.search.addEventListener("input", func.bus.filtrar);
                    ui.elms.bus.fil.addEventListener("input", func.bus.filtrar);
                }
            },
            bus: {
                filtrar: function(evt) {
                    let productos = dt.func.pro.buscar(evt.target.value);
                    dt.func.pro.filtrar(productos, ui.func.pro.filtrosSeleccionados());
                },

                mostrar: function() {
                    ui.func.bus.mostrar();
                },

                ocultar: function() {
                    ui.func.bus.ocultar();
                }
            }
        };

        return {
            func: func
        }

    })(ui, dt);

    controller.func.gen.addEventListeners();
    dt.func.pro.cargarProductos();
}