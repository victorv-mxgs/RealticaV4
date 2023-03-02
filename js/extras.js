mostrarSuelo();
function mostrarSuelo(busqueda) {
    fetch("./adminPhp/usoSuelo/mostrar.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}

registrar.addEventListener("click", () => {
    fetch("./adminPhp/usoSuelo/registrar.php", {
        method: "POST",
        body: new FormData(frm)
    }).then(response => response.text()).then(response => {
        
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarSuelo();
            frm.reset();
            
           
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
                
            })
            registrar.value = "Registrar";
            UsoSueloId.value = "";
            mostrarSuelo();
            frm.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrar.value = "Registrar";
            UsoSueloId.value = "";
            frm.reset();
        }
    })
});


 
function Eliminar(nUsoSueloId) {
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
            fetch("./adminPhp/usoSuelo/eliminar.php", {
                method: "POST",
                body: nUsoSueloId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarSuelo();
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



function Editar(nUsoSueloId) {
    fetch("./adminPhp/usoSuelo/editar.php", {
        method: "POST",
        body: nUsoSueloId
    }).then(response => response.json()).then(response => {
        UsoSueloId.value = response.nUsoSueloId;
        suelo.value = response.cUsoSuelo;
        registrar.value = "Actualizar"
    })
}
buscar.addEventListener("keyup", () => {
    const valor = buscar.value;
    if (valor == "") {
        mostrarSuelo();
    }else{
        mostrarSuelo(valor);
    }
});




