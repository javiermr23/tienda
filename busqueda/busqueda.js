{
    let ui = (function() {

        elms = {
            hea: {
                search: document.querySelector("#cuadroBuscar"),

            },
            bus: {
                pag: document.querySelector
            }
        };

        return {
            elms: elms
        }

    })();

    let dt = (function() {

    })();

    let controller = (function(ui, dt) {

        func = {

            gen: {
                addEventListeners: function() {
                    ui.elms.hea.search.addEventListeners("focus", func.bus.mostrar);
                    ui.elms.hea.search.addEventListeners("blur", func.bus.ocultar);
                }
            },
            bus: {
                mostrar: function() {

                },
                ocultar: function() {

                }
            }
        };

        return {
            func: func
        }

    })(ui, dt);

    controller.func.gen.addEventListeners();
}