<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM suscripTipo WHERE nSuscripTipoId = :nSuscripTipoId");
    $query->bindParam(":nSuscripTipoId", $data);
    $query->execute();
    echo "eliminado";
?>