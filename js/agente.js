mostrarAgente();
function mostrarAgente(busqueda) {
    fetch("./adminPhp/agente/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadoage.innerHTML = response;
    })
}

registrarage.addEventListener("click", () => {
    fetch("./adminPhp/agente/registrar.php", {
        method: "POST",
        body: new FormData(frm7)
    }).then(response => response.text()).then(response => {
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarAgente();
            frm7.reset();
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
               
            })
            frm7.reset();
            registrarage.value = "Registrar";
            agenteid.value = "";
            mostrarAgente();
            
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarage.value = "Registrar";
            agenteid.value = "";
            frm7.reset();
        }
    })
});



function Eliminarage(nAgenteId) {
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
            fetch("./adminPhp/agente/eliminarAgente.php", {
                method: "POST",
                body: nAgenteId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarAgente();
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



function Editarage(nAgenteId) {
    fetch("./adminPhp/agente/editar.php", {
        method: "POST",
        body: nAgenteId
    }).then(response => response.json()).then(response => {
        agenteid.value = response.nAgenteId;
        agentenombre.value = response.cNombre;
        correo.value = response.cCorreo;
        telefono.value = response.cTelefono;
        registrarage.value = "Actualizar"
        mostrarAgente();
    })
}
buscarage.addEventListener("keyup", () => {
    const valor = buscarage.value;
    if (valor == "") {
        mostrarAgente();
    }else{
        mostrarAgente(valor);
    }
});
 