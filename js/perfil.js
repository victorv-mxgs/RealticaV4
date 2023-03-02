mostrar();
mostrarPropiedades();
mostrarSuscripcion();
mostrarPropiedadesArchivadas();
function mostrar(busqueda) {
    fetch("./php/perfil/perfil.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        perfil.innerHTML = response;
       
    })
} 
function mostrarPropiedades(busqueda) {
    fetch("./php/perfil/verPropiedades.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        prop.innerHTML = response;
       
    })
} 
function mostrarPropiedadesArchivadas(busqueda) {
    fetch("./php/perfil/archivadas.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        prop1.innerHTML = response;
       
    })
} 
function mostrarSuscripcion(busqueda) {
    fetch("./php/perfil/verPropiedades.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        suscr.innerHTML = response;
       
    })
}
function editar(nUsuarioId) {
    fetch("./php/perfil/actualizarPerfil.php", {
        method: "POST",
        body: nUsuarioId
    }).then(response => response.json()).then(response => {
        usuarioId.value = response.nUsuarioId;
        nombre.value = response.cNombre;
        apellido.value=response.cApellidos;
        correo.value = response.cEmail;
        telefono.value = response.nTel;
        nombreUsuario.value=response.cUsers;
        tipotelefono.value = response.cTelTipo;
        domicilioo.value=response.cDomicilio;
        tipopersona.value = response.cPersonaTipo;
        rfcc.value = response.cRFC;
        actualizarDatos.value="Actualizar"
    })
}


function activar(nPropiedadId) {
    Swal.fire({
        title: 'Si activas esta propiedad estara visible para todos los usuarios, deceas continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./php/perfil/activar.php", {
                method: "POST",
                body: nPropiedadId
            }).then(response => response.text()).then(response => {
                if (response == "ok") {
                   Swal.fire({
                       icon: 'success',
                       title: 'Activada correctamente',
                       showConfirmButton: false,
                       timer: 1500
                   })
                }
                if (response == "error") {
                   Swal.fire({
                       icon: 'success',
                       title: 'Alcanzaste el limite de publicasiones activas, si quieres activar esta, primero archiva otra',
                       showConfirmButton: false,
                       timer: 1500
                   })
                }
                
            })
            
        }
    })
}


function archivar(nUsuarioId) {
    Swal.fire({
        title: 'Si archivas esta propiedad solo tu la podras ver en tu perfil, Esta seguro de archivar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./php/perfil/archivar.php", {
                method: "POST",
                body: nUsuarioId
            }).then(response => response.text()).then(response => {
                if (response == "ok") {
                   Swal.fire({
                       icon: 'success',
                       title: 'Archivada correctamente',
                       showConfirmButton: false,
                       timer: 1500
                   })
                }
                if (response == "error") {
                    Swal.fire({
                        icon: 'Error',
                        title: 'Error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                 }
            })
            
        }
    })
}


actualizarDatos.addEventListener("click", () => {
    fetch("./php/perfil/agregar.php", {
        method: "POST",
        body: new FormData(frmPerfil)
    }).then(response => response.text()).then(response => {
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Registrado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            
            frmPerfil.reset();
            mostrar();
        }
        if (response == "modificado"){
            Swal.fire({
                icon: 'success',
                title: 'Actualizado con exito',
                showConfirmButton: false,
                timer: 1500,
                
            
            })
       
            frmPerfil.reset();
            nUsuarioId.value = "";
            mostrar();
            
        }
        if (response == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })

            nUsuarioId.value = "";
            frmPerfil.reset();
            mostrar();
        }
    })
});

fotos.addEventListener("click", () => {
    fetch("./php/perfil/addimagenes.php", {
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
          
            frm3.reset();
        }
   
    })
});

function mos(busqueda) {
    fetch("./php/perfil/mos.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadop.innerHTML = response;
    })
}

function idprop(nPropiedadId) {
    fetch("./php/perfil/ed.php", {
        method: "POST",
        body: nPropiedadId
    }).then(response => response.json()).then(response => {
        idp.value = response.nPropiedadId;
        agreimg.value = "Agregar mas fotos"
       
    })
}


