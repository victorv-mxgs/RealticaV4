<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM agente WHERE nAgenteId = :nAgenteId");
    $query->bindParam(":nAgenteId", $data);
    $query->execute();
    $resultadoage = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultadoage);
?>    