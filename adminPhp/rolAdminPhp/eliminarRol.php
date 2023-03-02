<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM rol WHERE nRolId = :nRolId");
    $query->bindParam(":nRolId", $data);
    $query->execute();
    echo "eliminado";
?>