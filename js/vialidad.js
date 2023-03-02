mostrarvial();
function mostrarvial(busqueda) {
    fetch("./adminPhp/vialidad/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadvial.innerHTML = response;
    })
}

registrarvial.addEventListener("click", () => {
    fetch("./adminPhp/vialidad/registrar.php", {
        method: "POST",
        body: new FormData(frm5)
    }).then(response => response.text()).then(response => {
        
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarvial();
            frm5.reset();
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
                
            })
            registrarvial.value = "Registrar";
            vialidadTipoId.value = "";
            mostrarvial();
            frm5.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarvial.value = "Registrar";
            vialidadTipoId.value = "";
            frm5.reset();
        }
    })
});



function Eliminarvial(nVialidadTipoId) {
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
            fetch("./adminPhp/vialidad/eliminar.php", {
                method: "POST",
                body: nVialidadTipoId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarvial();
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

function Editarvial(nVialidadTipoId) {
    fetch("./adminPhp/vialidad/editar.php", {
        method: "POST",
        body: nVialidadTipoId
    }).then(response => response.json()).then(response => {
        vialidadTipoId.value = response.nVialidadTipoId;
        vialidadTipo.value = response.cVialidadTipo;
        registrarvial.value = "Actualizar"
    })
}
buscarvial.addEventListener("keyup", () => {
    const valor = buscarvial.value;
    if (valor == "") {
        mostrarvial();
    }else{
        mostrarvial(valor);
    }
});
