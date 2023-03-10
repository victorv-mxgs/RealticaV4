mostrarsusc();
function mostrarsusc(busqueda) {
    fetch("./adminPhp/suscripcion/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadosusc.innerHTML = response;
    })
}

registrarsusc.addEventListener("click", () => {
    fetch("./adminPhp/suscripcion/registrar.php", {
        method: "POST",
        body: new FormData(frm6)
    }).then(response => response.text()).then(response => {
        
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarsusc();
            frm6.reset();
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
                
            })
            registrarsusc.value = "Registrar";
            suscripTipoId.value = "";
            mostrarsusc();
            frm6.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarsusc.value = "Registrar";
            suscripTipoId.value = "";
            frm6.reset();
        }
    })
});



function Eliminarsusc(nSuscripTipoId) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./adminPhp/suscripcion/eliminar.php", {
                method: "POST",
                body: nSuscripTipoId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarsusc();
                   Swal.fire({
                       icon: 'success',
                       title: 'Eliminado',
                       showConfirmButton: false,
                       timer: 1500
                   })
                }
                
            })
            
        }
    })
}

function Editarsusc(nSuscripTipoId) {
    fetch("./adminPhp/suscripcion/editar.php", {
        method: "POST",
        body: nSuscripTipoId
    }).then(response => response.json()).then(response => {
        suscripTipoId.value = response.nSuscripTipoId;
        nombre.value = response.cNombre;
        descripcion.value = response.cDescripcion;
        precio.value = response.nPrecio;
        meses.value = response.nMeses;
        publicaciones.value = response.nPublicaciones;
        registrarsusc.value = "Actualizar"
    })
}
buscarsusc.addEventListener("keyup", () => {
    const valor = buscarsusc.value;
    if (valor == "") {
        mostrarsusc();
    }else{
        mostrarsusc(valor);
    }
});
