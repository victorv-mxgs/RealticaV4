<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM financiamientotipo WHERE nFinanciamientoTipoId = :nFinanciamientoTipoId");
    $query->bindParam(":nFinanciamientoTipoId", $data);
    $query->execute();
    echo "el";
?>