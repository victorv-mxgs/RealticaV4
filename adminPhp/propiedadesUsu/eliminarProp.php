<?php
    $data = file_get_contents("php://input");
    require "conn.php";
    $query = $pdo->prepare("DELETE FROM propiedad WHERE nPropiedadId = :nPropiedadId");
    $query->bindParam(":nPropiedadId", $data);
    $query->execute();
    echo "eliminado";
?>