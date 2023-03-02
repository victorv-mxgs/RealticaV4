
$("document").ready(function () {
  $("#estados").load("adminHtml/estadosPhp/estados.php");

  $("#estados").change(function () {
    var estadoId = $("#estados").val();
    $.get("adminHtml/estadosPhp/municipios.php", { paramId: estadoId }).done(function (data) {
      $("#municipios").html(data);
    })
    
  })
  $("#municipios").change(function () {
    var municipioId = $("#municipios").val();
    $.get("adminHtml/estadosPhp/localidad.php", { paramId: municipioId }).done(function (data) {
      $("#localidades").html(data);
    })
    
  })

  $("#localidades").change(function () {
    var localidadId = $("#localidades").val();
    $.get("adminHtml/estadosPhp/colonia.php", { paramId: localidadId }).done(function (data) {
      $("#colonias").html(data);
    })
    
  })

})
