


registrar.addEventListener("click", () => {
    fetch("./php/nuevoUsuario.php", {
        method: "POST",
        body: new FormData(formulario)
    }).then(response => response.text()).then(response => {
       
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
           
        }
     
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
          
        }
        if (response == "repTel"){
            Swal.fire({
                icon: 'error',
                title: 'Error este telefono ya esta en uso prueba con otro',
                showConfirmButton: false,
                timer: 1500
            })
          
        }

        if (response == "rep"){
            Swal.fire({
                icon: 'error',
                title: 'Error el usuario o el correo ya estan en uso, por favor selecciona otro',
                showConfirmButton: false,
                timer: 3500
            })
          
        }
        if (response == "dif"){
            Swal.fire({
                icon: 'error',
                title: 'Error las contrseñas no coinciden',
                showConfirmButton: false,
                timer: 3500
            })
          
        }
    })
});

