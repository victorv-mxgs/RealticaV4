mostrarPropiedad();
function mostrarPropiedad(busqueda) {
    fetch("./adminHtml/adminPhp/propiedadesUsu/verPropiedades.php", {
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultadoPropiedad.innerHTML = response;
    })
} 
registrar.addEventListener("click", () => {
    fetch("./adminHtml/adminPhp/propiedadesUsu/agregar.php", {
        method: "POST",
        body: new FormData(frmpropusuario)
    }).then(response => response.text()).then(response => {
        if (response == "ok") {
            Swal.fire({
                icon: 'success',
                title: 'Propiedad registrada con exito',
                showConfirmButton: false,
                timer: 1500
            })
            mostrarPropiedad();
            frmpropusuario.reset();
     
        }
      
        if (response == "vacio"){
            Swal.fire({
                icon: 'error',
                title: 'Error campos vacios',
                showConfirmButton: false,
                timer: 1500
            })
            registrar.value = "Registrar";
            propiedadId.value = "";
          
            
        }
        if (response == "novalido"){
            Swal.fire({
                icon: 'error',
                title: 'Error formato de imagen no valido',
                showConfirmButton: false,
                timer: 1500
            })
            registrar.value = "Registrar";
            propiedadId.value = "";
            
            
        }
    })
});



function editarprop(nPropiedadId) {
    fetch("./adminPhp/propiedades/editarProp.php", {
        method: "POST",
        body: nPropiedadId
    }).then(response => response.json()).then(response => {
        propiedadId.value = response.nPropiedadId;
        titulo.value = response.cTituloPropiedad;
        agente.value = response.cAgenteId;
       
        estados.value = response.nEstadoId;
        municipios.value = response.nMunicipioId;
        localidades.value = response.nLocalidadId;
        colonias.value = response.nColoniaId;
        vialidadtipo.value = response.nVialidadTipoId;
        usuSuelo.value = response.nUsoSueloId;
        domicilio.value = response.cDomicilio;
        descripcion.value = response.cDescripcion;
        numext.value = response.cNumExt;
        numint.value = response.cNumInt;
        edificionum.value = response.cNumEdi;
        estatus.value = response.cStatus;
        tipo.value = response.cTipo;
        construccion.value = response.dConstruccion;
        frente.value = response.nFrente;
        fondo.value = response.nFondo;
        terrenosuper.value = response.nTerrenoSuper;
        constSuperf.value = response.nConstSuperf; 
        niveles.value = response.nNiveles;
        amenidades.value = response.cAmenidades;
        pago.value = response.nPago;
        espacios.value = response.cFinanciamiento;
        servicios.value = response.nPropiedadId;
        extra.value = response.cExtra;
        latitud.value = response.nLatitud;
        longitud.value = response.nLongitud;
        destacada.value = response.nDestacada;
        document.getElementById("registrar").style.display = "block";
        registrar.value = "Actualizar"

        document.getElementById('propiedadId').disabled=false
        document.getElementById('titulo').disabled=false
        document.getElementById('agente').disabled=false
        document.getElementById('estados').disabled=false
        document.getElementById('municipios').disabled=false
        document.getElementById('localidades').disabled=false
        document.getElementById('colonias').disabled=false
        document.getElementById('vialidadtipo').disabled=false
        document.getElementById('usuSuelo').disabled=false
        document.getElementById('domicilio').disabled=false
        document.getElementById('descripcion').disabled=false
        document.getElementById('numext').disabled=false
        document.getElementById('numint').disabled=false
        document.getElementById('edificionum').disabled=false
        document.getElementById('estatus').disabled=false
        document.getElementById('tipo').disabled=false
        document.getElementById('construccion').disabled=false
        document.getElementById('frente').disabled=false
        document.getElementById('fondo').disabled=false
        document.getElementById('terrenosuper').disabled=false
        document.getElementById('constSuperf').disabled=false
        document.getElementById('niveles').disabled=false
        document.getElementById('amenidades').disabled=false
        document.getElementById('pago').disabled=false
        document.getElementById('espacios').disabled=false
        document.getElementById('servicios').disabled=false
        document.getElementById('extra').disabled=false
        document.getElementById('latitud').disabled=false
        document.getElementById('longitud').disabled=false
        document.getElementById('destacada').disabled=false

        document.getElementById('url_imagen').disabled=false

    })
}
buscarProp.addEventListener("keyup", () => {
    const valor = buscarProp.value;
    if (valor == "") {
        mostrarPropiedad();
    }else{
        mostrarPropiedad(valor);
    }
});

function verprop(nPropiedadId) {
    fetch("./adminPhp/propiedades/editarProp.php", {
        method: "POST",
        body: nPropiedadId
    }).then(response => response.json()).then(response => {
        propiedadId.value = response.nPropiedadId;
        titulo.value = response.cTituloPropiedad;
        agente.value = response.cAgenteId;
       
        estados.value = response.nEstadoId;
        municipios.value = response.nMunicipioId;
        localidades.value = response.nLocalidadId;
        colonias.value = response.nColoniaId;
        vialidadtipo.value = response.nVialidadTipoId;
        usuSuelo.value = response.nUsoSueloId;
        domicilio.value = response.cDomicilio;
        descripcion.value = response.cDescripcion;
        numext.value = response.cNumExt;
        numint.value = response.cNumInt;
        edificionum.value = response.cNumEdi;
        estatus.value = response.cStatus;
        tipo.value = response.cTipo;
        construccion.value = response.dConstruccion;
        frente.value = response.nFrente;
        fondo.value = response.nFondo;
        terrenosuper.value = response.nTerrenoSuper;
        constSuperf.value = response.nConstSuperf; 
        niveles.value = response.nNiveles;
        amenidades.value = response.cAmenidades;
        pago.value = response.nPago;
        espacios.value = response.cFinanciamiento;
        servicios.value = response.nPropiedadId;
        extra.value = response.cExtra;
        latitud.value = response.nLatitud;
        longitud.value = response.nLongitud;
        destacada.value = response.nDestacada;
        
        
        
        document.getElementById('propiedadId').disabled=true
        document.getElementById('titulo').disabled=true
        document.getElementById('agente').disabled=true
        document.getElementById('estados').disabled=true
        document.getElementById('municipios').disabled=true
        document.getElementById('localidades').disabled=true
        document.getElementById('colonias').disabled=true
        document.getElementById('vialidadtipo').disabled=true
        document.getElementById('usuSuelo').disabled=true
        document.getElementById('domicilio').disabled=true
        document.getElementById('descripcion').disabled=true
        document.getElementById('numext').disabled=true
        document.getElementById('numint').disabled=true
        document.getElementById('edificionum').disabled=true
        document.getElementById('estatus').disabled=true
        document.getElementById('tipo').disabled=true
        document.getElementById('construccion').disabled=true
        document.getElementById('frente').disabled=true
        document.getElementById('fondo').disabled=true
        document.getElementById('terrenosuper').disabled=true
        document.getElementById('constSuperf').disabled=true
        document.getElementById('niveles').disabled=true
        document.getElementById('amenidades').disabled=true
        document.getElementById('pago').disabled=true
        document.getElementById('espacios').disabled=true
        document.getElementById('servicios').disabled=true
        document.getElementById('extra').disabled=true
        document.getElementById('latitud').disabled=true
        document.getElementById('longitud').disabled=true
        document.getElementById('destacada').disabled=true

        document.getElementById('url_imagen').disabled=true

        document.getElementById("registrar").style.display = "none";
        
   })
}