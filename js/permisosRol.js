mostrarPermiso();
function mostrarPermiso(busqueda) {
    fetch("./adminPhp/permisosRolPhp/mostrarPermiso.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado1.innerHTML = response;
    })
}

registrarper.addEventListener("click", () => {
    fetch("./adminPhp/permisosRolPhp/registrarPermiso.php", {
        method: "POST",
        body: new FormData(frm1)
    }).then(response => response.text()).then(response => {
       
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarPermiso();
            frm1.reset();
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
            })
            registrarper.value = "Registrar";
            rolId.value = "";
            mostrarPermiso();
            frm1.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarper.value = "Registrar";
            permisoTipoId.value = "";
            frm1.reset();
        }
    })
});
function Eliminarr(nPermisoTipoId) {
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
            fetch("./adminPhp/permisosRolPhp/eliminarPermiso.php", {
                method: "POST",
                body: nPermisoTipoId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarPermiso();
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



function Editarr(nPermisoTipoId) {
    fetch("./adminPhp/permisosRolPhp/editarPermiso.php", {
        method: "POST",
        body: nPermisoTipoId
    }).then(response => response.json()).then(response => {
        permisoTipoId.value = response.nPermisoTipoId;
        permiso.value = response.cPermiso;
        descripcion.value = response.cDescripcion;
        baja.value = response.dBaja;
        registrarper.value = "Actualizar"
    })
}
busc.addEventListener("keyup", () => {
    const valor = buscar.value;
    if (valor == "") {
        mostrarPermiso();
    }else{
        mostrarPermiso(valor);
    }
});
