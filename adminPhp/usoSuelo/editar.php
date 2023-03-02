<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM usosuelo WHERE nUsoSueloId  = :nUsoSueloId ");
    $query->bindParam(":nUsoSueloId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
?>