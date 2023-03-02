mostrarRol();
function mostrarRol(busqueda) {
    fetch("./adminPhp/rolAdminPhp/mostrarRol.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}

registrarrol.addEventListener("click", () => {
    fetch("./adminPhp/rolAdminPhp/registrarRol.php", {
        method: "POST",
        body: new FormData(frmr)
    }).then(response => response.text()).then(response => {
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarRol();
            frmr.reset();
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
               
            })
            frmr.reset();
            registrarrol.value = "Registrar";
            rolId.value = "";
            mostrarRol();
            
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarrol.value = "Registrar";
            rolId.value = "";
            frmr.reset();
        }
    })
});



function Eliminar(nRolId) {
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
            fetch("./adminPhp/rolAdminPhp/eliminarRol.php", {
                method: "POST",
                body: nRolId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarRol();
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



function Editar(nRolId) {
    fetch("./adminPhp/rolAdminPhp/editarRol.php", {
        method: "POST",
        body: nRolId
    }).then(response => response.json()).then(response => {
        rolId.value = response.nRolId;
        rol.value = response.cRol;
        registrarrol.value = "Actualizar"
    })
}
buscar.addEventListener("keyup", () => {
    const valor = buscar.value;
    if (valor == "") {
        mostrarRol();
    }else{
        mostrarRol(valor);
    }
});
