<?php
    $data = file_get_contents("php://input");
    require "conn.php";
    $query = $pdo->prepare("SELECT * FROM propiedad WHERE nPropiedadId = :nPropiedadId");
    $query->bindParam(":nPropiedadId", $data);
    $query->execute();
    $resultadoPropiedad = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultadoPropiedad);
?>