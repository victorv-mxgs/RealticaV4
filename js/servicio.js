mostrarservicio();
function mostrarservicio(busqueda) {
    fetch("./adminPhp/servicio/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadoservicio.innerHTML = response;
    })
}

rgs.addEventListener("click", () => {
    fetch("./adminPhp/servicio/registrarServ.php", {
        method: "POST",
        body: new FormData(frm4)
    }).then(response => response.text()).then(response => {
        
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarservicio();
            frm4.reset();
            
           
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
                
            })
            rgs.value = "Registrar";
            servicioTipoId.value = "";
            mostrarservicio();
            frm4.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            rgs.value = "Registrar";
            servicioTipoId.value = "";
            frm4.reset();
        }
    })
});





function Eliminarservicio(nServicioTipoId) {
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
            fetch("./adminPhp/servicio/eliminar.php", {
                method: "POST",
                body: nServicioTipoId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarservicio();
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

function Editarservicio(nServicioTipoId) {
    fetch("./adminPhp/servicio/editar.php", {
        method: "POST",
        body: nServicioTipoId
    }).then(response => response.json()).then(response => {
        servicioTipoId.value = response.nServicioTipoId;
        serv.value = response.cServicio;
        rgs.value = "Actualizar"
    })
}
buscarservicio.addEventListener("keyup", () => {
    const valor = buscarservicio.value;
    if (valor == "") {
        mostrarservicio();
    }else{
        mostrarservicio(valor);
    }
});
