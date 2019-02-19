{
    let ui = (function() {

        elms = {
            hea: {
                search: document.querySelector("#cuadroBuscar"),
                nav: document.querySelector("#navBar")
            },
            bus: {
                pag: document.querySelector("#pag-busqueda"),
                fil: document.querySelector(".bus-fil"),
                pro: document.querySelector(".bus-pro"),
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
                },
                
                limpiarBusqueda: function() {
                    elms.hea.search.value = null;
                },

                limpiarFiltros: function() {
                    Array.from(elms.bus.fil.querySelectorAll("input[type='checkbox']")).forEach(cur => cur.checked = false);
                },

                seleccionarFiltro: function(filtro) {
                    Array.from(elms.bus.fil.querySelectorAll("input[type='checkbox']")).forEach(cur => {
                        if (cur.id === filtro) {
                            cur.checked = true;
                        }
                    });
                }
            },
            pro: {
                borrarProductos: function() {
                    Array.from(elms.bus.pro.children).forEach(cur => cur.remove());
                },

                filtrosSeleccionados: function() {
                    let filtros = {
                        categoria: new Array(),
                        fabricante: new Array()
                    };

                    Array.from(elms.bus.fil.querySelectorAll(".fil-categoria input[type='checkbox']")).forEach(cur => {
                        if (cur.checked) {
                            filtros.categoria.push(cur.id);
                        }
                    });
                    Array.from(elms.bus.fil.querySelectorAll(".fil-fabricante input[type='checkbox']")).forEach(cur => {
                        if (cur.checked) {
                            filtros.fabricante.push(cur.id);
                        }
                    });
                    return filtros;
                },

                mostrarProductos: function(productos) {
                    let lis = new String();
                    this.borrarProductos();

                    if (productos.length) {
                        productos.forEach(pr => {
                            lis += `<li id="${pr['id']}" class="tarjetaProducto">
                                        <img src="/resources/img/productos/${pr['id']}.jpg" alt="${pr['nombre']}"/>
                                        <p class="precioGrande">${pr['precio']}€</p>
                                        <p class="stock"></p>
                                        <h3>${pr['nombre']}</h3>
                                    </li>`;
                        });
                    }
                    else {
                        lis += `<p>No existen productos con tu criterio de búsqueda.</p>`;
                    }
                    elms.bus.pro.insertAdjacentHTML("beforeend", lis);
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
                    if (!patron) {
                        return data.pro;
                    }
                    else {
                        return data.pro.filter(cur => cur["nombre"].toLowerCase().includes(patron));
                    }
                },

                filtrar: function(productos, filtros) {

                    if (filtros["categoria"].length !== 0) {
                        productos = productos.filter(pr => filtros["categoria"].includes(pr["categoria"]));
                    }
                    
                    if (filtros["fabricante"].length !== 0) {
                        productos = productos.filter(pr => filtros["fabricante"].includes(pr["fabricante"]));
                    }
                    
                    return productos;
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
                    ui.elms.hea.nav.addEventListener("click", func.bus.seleccionarFiltro);
                    ui.elms.bus.clo.addEventListener("click", func.bus.ocultar);
                    ui.elms.hea.search.addEventListener("input", func.bus.filtrar);
                    ui.elms.bus.fil.addEventListener("input", func.bus.filtrar);
                }
            },
            bus: {
                filtrar: function() {
                    let productos = dt.func.pro.buscar(ui.elms.hea.search.value.trim().toLowerCase());
                    productos = dt.func.pro.filtrar(productos, ui.func.pro.filtrosSeleccionados());
                    ui.func.pro.mostrarProductos(productos);
                },

                mostrar: function() {
                    ui.func.bus.mostrar();
                },

                ocultar: function() {
                    ui.func.bus.ocultar();
                    ui.func.bus.limpiarBusqueda();
                    ui.func.bus.limpiarFiltros();
                },

                seleccionarFiltro: function(evt) {
                    if (evt.target.tagName.toLowerCase() === "span") {
                        ui.func.bus.limpiarBusqueda();
                        ui.func.bus.limpiarFiltros();
                        ui.func.bus.seleccionarFiltro(evt.target.lastElementChild.textContent);
                        func.bus.filtrar();
                        func.bus.mostrar();
                    }
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