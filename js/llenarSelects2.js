$("document").ready(function () {
    $("#rolid").load("adminPhp/llenarSelects/selectRol.php");//para mostrar los roles al momento de registrar un nuevo usuario
    
    $("#vialidadtipo").load("adminPhp/llenarSelects/selectVialidad.php");//para mostrar los tipos de vialidad al momento de registrar una propiedad

    $("#espacios").load("adminPhp/llenarSelects/selectEspacio.php");//

    $("#financiamiento").load("adminPhp/llenarSelects/selectFinanciamiento.php");//para mostrar los tipos de financiamiento al momento de registrar una propiedad

    $("#servicios").load("adminPhp/llenarSelects/selectServicio.php");//

    $("#usuSuelo").load("adminPhp/llenarSelects/selectUsoSuelo.php");//para mostrar los tipos de uso de suelo al momento de registrar una propiedad

    $("#suscripcion").load("adminPhp/llenarSelects/selectSuscripcion.php");//

    $("#agente").load("adminPhp/llenarSelects/selectAgente.php");//

    
})