<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM suscripTipo WHERE nSuscripTipoId  = :nSuscripTipoId ");
    $query->bindParam(":nSuscripTipoId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
?>