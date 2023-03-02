mostrar();
function mostrar(busqueda) {
    fetch("./adminPhp/propiedades/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}

