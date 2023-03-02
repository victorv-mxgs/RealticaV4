<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("DELETE FROM permisoTipo WHERE nPermisoTipoId = :nPermisoTipoId");
    $query->bindParam(":nPermisoTipoId", $data);
    $query->execute();
    echo "eliminado";
?>