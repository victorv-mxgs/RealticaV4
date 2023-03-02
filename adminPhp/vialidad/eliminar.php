<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM vialidadTipo WHERE nVialidadTipoId = :nVialidadTipoId");
    $query->bindParam(":nVialidadTipoId", $data);
    $query->execute();
    echo "eliminado";
?>