mostrarUsuarios();
function mostrarUsuarios(busqueda) {
    fetch("./adminPhp/userAdminPhp/verUsuario.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}
  
registrarUsu.addEventListener("click", () => {
    fetch("./adminPhp/userAdminPhp/agregarUsuario.php", {
        method: "POST",
        body: new FormData(formUsu)
    }).then(response => response.text()).then(response => {
       
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito ',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarUsuarios();
            formUsu.reset();
            
           
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
            })
            registrar.value = "Registrar";
            userid.value = "";
            mostrarUsuarios();
            formUsu.reset();
        }
        if (response == "vacio"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrar.value = "Registrar";
            userid.value = "";
            formUsu.reset();

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

function Eliminar(nUsuarioId) {
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
            fetch("./adminPhp/userAdminPhp/eliminarUsuario.php", {
                method: "POST",
                body: nUsuarioId
            }).then(response => response.text()).then(response => {
                if (response == "eliminado") {
                    mostrarUsuarios();
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


function Editar(nUsuarioId) {
    fetch("./adminPhp/userAdminPhp/editarUsuario.php", {
        method: "POST",
        body: nUsuarioId
    }).then(response => response.json()).then(response => {
        userid.value = response.nUsuarioId;
        nombre.value = response.cNombre;
        usuario.value = response.cUsers;
        apellido.value = response.cApellidos;
        telefono.value = response.nTel;
        tipoTelefono.value = response.cTelTipo;
        domicilio.value = response.cDomicilio;
        email.value = response.cEmail;
        contrasena.value = response.cPwd;
        rfcUser.value = response.cRFC;
        tipoPersona.value = response.cPersonaTipo;
        rolid.value = response.nRolId;
        suscripcion.value = response.bSuscripcion;
       
        registrarUsu.value = "daniel"
        document.getElementById("registrarUsu").style.display = "block";
        document.getElementById('userid').disabled=false
        document.getElementById('nombre').disabled=false
        document.getElementById('usuario').disabled=false
        document.getElementById('apellido').disabled=false
        document.getElementById('telefono').disabled=false
        document.getElementById('tipoTelefono').disabled=false
        document.getElementById('domicilio').disabled=false
        document.getElementById('email').disabled=false
        document.getElementById('contrasena').disabled=false
        document.getElementById('rfcUser').disabled=false
        document.getElementById('tipoPersona').disabled=false
        document.getElementById('rolid').disabled=false
        document.getElementById('suscripcion').disabled=false
     

    })
}

function ver_mas(nUsuarioId) {
    fetch("./adminPhp/userAdminPhp/editarUsuario.php", {
        method: "POST",
        body: nUsuarioId
    }).then(response => response.json()).then(response => {
        userid.value = response.nUsuarioId;
        nombre.value = response.cNombre;
        usuario.value = response.cUsers;
        apellido.value = response.cApellidos;
        telefono.value = response.nTel;
        tipoTelefono.value = response.cTelTipo;
        domicilio.value = response.cDomicilio;
        email.value = response.cEmail;
        contrasena.value = response.cPwd;
        rfcUser.value = response.cRFC;
        tipoPersona.value = response.cPersonaTipo;
        rolid.value = response.nRolId;
        suscripcion.value = response.bSuscripcion;

        document.getElementById('userid').disabled=true
        document.getElementById('nombre').disabled=true
        document.getElementById('usuario').disabled=true
        document.getElementById('apellido').disabled=true
        document.getElementById('telefono').disabled=true
        document.getElementById('tipoTelefono').disabled=true
        document.getElementById('domicilio').disabled=true
        document.getElementById('email').disabled=true
        document.getElementById('contrasena').disabled=true
        document.getElementById('rfcUser').disabled=true
        document.getElementById('tipoPersona').disabled=true
        document.getElementById('rolid').disabled=true
        document.getElementById('suscripcion').disabled=true
    
        document.getElementById("registrarUsu").style.display = "none";
        
    })
    
}

buscar.addEventListener("keyup", () => {
    const valor = buscar.value;
    if (valor == "") {
        mostrarUsuarios();
    }else{
        mostrarUsuarios(valor);
    }
});
