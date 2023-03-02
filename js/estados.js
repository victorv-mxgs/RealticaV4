
$("document").ready(function () {
  $("#estados").load("estadosPhp/estados.php");

  $("#estados").change(function () {
    var estadoId = $("#estados").val();
    $.get("estadosPhp/municipios.php", { paramId: estadoId }).done(function (data) {
      $("#municipios").html(data);
    })
    
  })
  $("#municipios").change(function () {
    var municipioId = $("#municipios").val();
    $.get("estadosPhp/localidad.php", { paramId: municipioId }).done(function (data) {
      $("#localidades").html(data);
    })
    
  })

  $("#localidades").change(function () {
    var localidadId = $("#localidades").val();
    $.get("estadosPhp/colonia.php", { paramId: localidadId }).done(function (data) {
      $("#colonias").html(data);
    })
    
  })

})
