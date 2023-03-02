<?php
if (isset($_POST)) {
    $suelo = $_POST['suelo'];
    
    require("conexion.php");
    if (empty($_POST['UsoSueloId']) && (!empty($_POST['suelo']))){
        $query = $pdo->prepare("INSERT INTO usosuelo (cUsoSuelo) VALUES (:suelo)");
        $query->bindParam(":suelo", $suelo);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $nUsoSueloId = $_POST['UsoSueloId'];
        $query = $pdo->prepare("UPDATE usosuelo SET cUsoSuelo = :suelo  WHERE nUsoSueloId = :nUsoSueloId");
        $query->bindParam(":suelo", $suelo);
        $query->bindParam("nUsoSueloId", $nUsoSueloId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
