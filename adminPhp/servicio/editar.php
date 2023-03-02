<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM servicioTipo WHERE nServicioTipoId  = :nServicioTipoId ");
    $query->bindParam(":nServicioTipoId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
?>