<?php
if (isset($_POST)) {
    $agentenombre = $_POST['agentenombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
   
    require("conexion.php");
    if (empty($_POST['agenteid'])){
        $query = $pdo->prepare("INSERT INTO agente (cNombre,cCorreo,cTelefono) VALUES (:age,:cor,:tel)");
        $query->bindParam(":age", $agentenombre);
        $query->bindParam(":cor", $correo);
        $query->bindParam(":tel", $telefono);
        $query->execute();
        $pdo = null;
        echo "ok";
    }else{
        $nAgenteId = $_POST['agenteid'];
        $query = $pdo->prepare("UPDATE agente SET cNombre =:age,cCorreo =:cor, cTelefono=:tel WHERE nAgenteId = :nAgenteId");
        $query->bindParam(":age", $agentenombre);
        $query->bindParam(":cor", $correo);
        $query->bindParam(":tel", $telefono);
        $query->bindParam("nAgenteId", $nAgenteId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
     
}
