<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM espacioTipo WHERE nEspacioTipoId = :nEspacioTipoId");
    $query->bindParam(":nEspacioTipoId", $data);
    $query->execute();
    echo "eliminado";
?>