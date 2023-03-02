<?php
if (isset($_POST)) {
    $rol = $_POST['rol'];
   
    require("conexion.php");
    if (empty($_POST['rolId'])){
        $query = $pdo->prepare("INSERT INTO rol (cRol) VALUES (:cod)");
        $query->bindParam(":cod", $rol);
        $query->execute();
        $pdo = null;
        echo "ok";
    }else{
        $id = $_POST['rolId'];
        $query = $pdo->prepare("UPDATE rol SET cRol = :cod WHERE nRolId = :id");
        $query->bindParam(":cod", $rol);
        $query->bindParam("id", $id);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
}
