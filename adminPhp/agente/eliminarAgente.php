<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM agente WHERE nAgenteId = :nAgenteId");
    $query->bindParam(":nAgenteId", $data);
    $query->execute();
    echo "eliminado";
?>