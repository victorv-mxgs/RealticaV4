<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM usosuelo WHERE nUsoSueloId = :nUsoSueloId");
    $query->bindParam(":nUsoSueloId", $data);
    $query->execute();
    echo "eliminado";
?>