mostrarUltimasRegistradas();
mostrarDestacadas();
mostrarMasVisitadas();
mostrar();
detalles();
function mostrarUltimasRegistradas(busqueda) {
    fetch("./php/propiedades/mostrarUltimasAñadidas.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado1.innerHTML = response;
    })
}


function mostrarDestacadas(busqueda) {
    fetch("./php/propiedades/mostrarDestacadas.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado2.innerHTML = response;
    })
}


function mostrarMasVisitadas(busqueda) {
    fetch("./php/propiedades/mostrarMasVisitadas.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado3.innerHTML = response;
    })
}


function mostrar(busqueda) {
    fetch("./php/propiedades/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}
function detalles(busqueda) {
    fetch("./php/propiedades/detallesPropiedad.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        detallesP.innerHTML = response;
    })
}