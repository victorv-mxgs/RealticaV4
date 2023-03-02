<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM usuario WHERE nUsuarioId = :nUsuarioId");
    $query->bindParam(":nUsuarioId", $data);
    $query->execute();
    echo "eliminado";
?>