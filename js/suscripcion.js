mostrarsusc();
function mostrarsusc(busqueda) {
    fetch("./adminHtml/adminPhp/suscripcion/mostrarSus.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        suscrip.innerHTML = response;
    })
}
