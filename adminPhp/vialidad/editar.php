<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM vialidadTipo WHERE nVialidadTipoId  = :nVialidadTipoId ");
    $query->bindParam(":nVialidadTipoId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
?>