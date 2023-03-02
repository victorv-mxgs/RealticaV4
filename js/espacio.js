mostrarEspacio();
function mostrarEspacio(busqueda) {
    fetch("./adminPhp/espacio/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadoEspacio.innerHTML = response;
    })
} 

registrarEspacio.addEventListener("click", () => {
   
    fetch("./adminPhp/espacio/registrar.php", {
        method: "POST",
        body: new FormData(frm2)
    }).then(response => response.text()).then(response => {
        
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarEspacio();
            frm2.reset();
            
           
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
                
            })
            registrarEspacio.value = "Registrar";
            espacioTipoId.value = "";
            mostrarEspacio();
            frm2.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarEspacio.value = "Registrar";
            espacioTipoId.value = "";
            frm2.reset();
        }
    })
});



function EliminarEspacio(nEspacioTipoId) {
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
            fetch("./adminPhp/espacio/eliminar.php", {
                method: "POST",
                body: nEspacioTipoId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarEspacio();
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



function EditarEspacio(nEspacioTipoId) {
    fetch("./adminPhp/espacio/editar.php", {
        method: "POST",
        body: nEspacioTipoId
    }).then(response => response.json()).then(response => {
        espacioTipoId.value = response.nEspacioTipoId;
        descripcionesp.value = response.cDescripcion;
        registrarEspacio.value = "Actualizar"
        mostrarEspacio();
    })
}
buscarEspacio.addEventListener("keyup", () => {
    const valor = buscarEspacio.value;
    if (valor == "") {
        mostrarEspacio();
    }else{
        mostrarEspacio(valor);
    }
});
