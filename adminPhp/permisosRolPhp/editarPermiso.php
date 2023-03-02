<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $query = $pdo->prepare("SELECT * FROM permisoTipo WHERE nPermisoTipoId = :nPermisoTipoId");
    $query->bindParam(":nPermisoTipoId", $data);
    $query->execute();
    $resultado1 = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado1);
?>