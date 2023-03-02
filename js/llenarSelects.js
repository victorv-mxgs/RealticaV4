$("document").ready(function () {
    
    $("#vialidadtipo").load("./adminHtml/adminPhp/llenarSelects/selectVialidad.php");//para mostrar los tipos de vialidad al momento de registrar una propiedad

    $("#espacios").load("./adminHtml/adminPhp/llenarSelects/selectEspacio.php");//

    $("#financiamiento").load("./adminHtml/adminPhp/llenarSelects/selectFinanciamiento.php");//para mostrar los tipos de financiamiento al momento de registrar una propiedad

    $("#servicios").load("./adminHtml/adminPhp/llenarSelects/selectServicio.php");//

    $("#usuSuelo").load("./adminHtml/adminPhp/llenarSelects/selectUsoSuelo.php");//para mostrar los tipos de uso de suelo al momento de registrar una propiedad

    $("#suscripcion").load("./adminHtml/adminPhp/llenarSelects/selectSuscripcion.php");//

    $("#agente").load("./adminHtml/adminPhp/llenarSelects/selectAgente.php");//

    $("#rolid").load("./adminHtml/adminPhp/llenarSelects/selectRol.php");//


    
})