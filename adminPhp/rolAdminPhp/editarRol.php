<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM rol WHERE nRolId = :nRolId");
    $query->bindParam(":nRolId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
?>