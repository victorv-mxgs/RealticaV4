<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM servicioTipo WHERE nServicioTipoId = :nServicioTipoId");
    $query->bindParam(":nServicioTipoId", $data);
    $query->execute();
    echo "eliminado";
?>