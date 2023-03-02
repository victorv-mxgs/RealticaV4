<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM espacioTipo WHERE nEspacioTipoId  = :nEspacioTipoId ");
    $query->bindParam(":nEspacioTipoId", $data);
    $query->execute();
    $resultadoEspacio = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultadoEspacio);
?>