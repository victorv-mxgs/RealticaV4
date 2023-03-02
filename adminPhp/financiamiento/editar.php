<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM financiamientoTipo WHERE nFinanciamientoTipoId  = :nFinanciamientoTipoId ");
    $query->bindParam(":nFinanciamientoTipoId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
?>