mostrarFinan();
function mostrarFinan(busqueda) {
    fetch("./adminPhp/financiamiento/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadfoinan.innerHTML = response;
    })
}

registrarfinan.addEventListener("click", () => {
   
    fetch("./adminPhp/financiamiento/registrar.php", {
        method: "POST",
        body: new FormData(frm3)
    }).then(response => response.text()).then(response => {
        
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarFinan();
            frm3.reset();
            
           
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
                
            })
            registrarfinan.value = "Registrar";
            financiamientoTipoId.value = "";
            mostrarFinan();
            frm3.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrarfinan.value = "Registrar";
            financiamientoTipoId.value = "";
            frm3.reset();
        }
    })
});

function Eliminarfinan(nFinanciamientoTipoId) {
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
            fetch("./adminPhp/financiamiento/eliminarFinan.php", {
                method: "POST",
                body: nFinanciamientoTipoId
            }).then(response => response.text()).then(response => {
                if (response == "el") {
                    mostrarFinan();
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


function Editarfinan(nFinanciamientoTipoId) {
    fetch("./adminPhp/financiamiento/editar.php", {
        method: "POST",
        body: nFinanciamientoTipoId
    }).then(response => response.json()).then(response => {
        financiamientoTipoId.value = response.nFinanciamientoTipoId;
        financiamiento.value = response.cFinanciamiento;
        registrarfinan.value = "Actualizar"
    })
}
buscarfinan.addEventListener("keyup", () => {
    const valor = buscarfinan.value;
    if (valor == "") {
        mostrarFinan();
    }else{
        mostrarFinan(valor);
    }
});
