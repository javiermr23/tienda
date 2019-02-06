{
    let ui = function() {
        let elms = {
            menu: document.querySelector(".adm-menu"),
            pagina: document.querySelector(".adm-paginas")
        };

        return {
            elms: elms,
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
            }
        }
    }();

    let data = function() {
        
    }();

    let controller = function(ui, data) {
        

        return {
            addEventListeners: function() {
                ui.elms.menu.addEventListener("click", evt => {
                    if (evt.target.tagName === "LI") {
                        ui.cambiarPagina(evt.target.className);
                    }
                });
            }
        }
    }(ui, data);

    controller.addEventListeners();
}