<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
   
    $query = $pdo->prepare("SELECT * FROM propiedad WHERE nPropiedadId = :nPropiedadId");
    $query->bindParam(":nPropiedadId", $data);
    $query->execute();
    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
    $nPropiedadId=$resultado[0]['nPropiedadId'];

 $servidor = "mysql:dbname=Realticabd;host=localhost";
 $user = "root";
 $pass = "";
 try {
     $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    
 } catch (PDOException $e) {
     echo "conexion fallida" .$e->getMessage();
 }




 session_start();

 
 if(isset($_SESSION['nombre_usuario'])){
 $usu=$_SESSION['nombre_usuario'];

 $consulta = $pdo->prepare("SELECT nUsuarioId,cUsers,bSuscripcion from usuario where cUsers='$usu' ");
 $consulta->execute();
 $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
 $susActiv=$resultado[0]['bSuscripcion'];

 if($susActiv>0)
{
    
$consulta = $pdo->prepare("SELECT sus.nPubRestantes, sus.nPubActivas,sus.nPublicaciones,usu.nUsuarioId
from suscripcion sus  INNER join usuario usu
 ON usu.nUsuarioId = sus.nUsuarioId WHERE usu.cUsers='$usu'");

$consulta->execute();
$res = $consulta->fetch(PDO::FETCH_ASSOC);

$nUsuarioId=$res['nUsuarioId']; 
$publicaciones=$res['nPublicaciones']; 
$publicacionesRestantes=$res['nPubRestantes'];
$publicacionesActivas=$res['nPubActivas'];


if($publicacionesRestantes < $publicaciones)
    {
       
        $consulta = $pdo->prepare("UPDATE suscripcion set nPubRestantes=nPubRestantes+1 where nUsuarioId=?");
		$consulta->execute([$nUsuarioId]);
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $consulta = $pdo->prepare("UPDATE suscripcion set nPubActivas=nPubActivas-1 where nUsuarioId=?");
		$consulta->execute([$nUsuarioId]);
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $consulta = $pdo->prepare("UPDATE  propiedad set  nActiva ='0' WHERE nPropiedadId =?");
		$consulta->execute([$nPropiedadId]);
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo "ok"; 
    }
    else{
        echo "error"; 
    }
}


}
else{
    echo "error no se ha iniciado sesion";
    
}

