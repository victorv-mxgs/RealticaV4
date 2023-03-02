login.addEventListener("click", () => {
    fetch("./php/validar.php", {
        method: "POST",
        body: new FormData(formlogin)
    }).then(response => response.text()).then(response => {
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido',
                showConfirmButton: false,
                timer: 1500
            })
            formlogin.reset();
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error usuario y/o contraseña incorrectos',
                showConfirmButton: false,
                timer: 1500
            })
            formlogin.reset();
        }
    })
});