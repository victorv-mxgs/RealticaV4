<?php
$data = file_get_contents("php://input");

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

 $consulta = $pdo->prepare("SELECT * from usuario where cUsers='$usu' ");
 $consulta->execute();
 $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

  foreach($resultado as $data){
    $idusuario=$data['nUsuarioId'];
    
   
//muestra todas las propiedades del usuario y su informacion
$consulta = $pdo->prepare("SELECT usu.nUsuarioId, sus.nUsuarioId,sus.nSuscripcionId,sus.nSuscripcionTipoId , 
sut.nSuscripTipoId,	sut.cNombre,	sut.cDescripcion,	sut.nPrecio,	sut.nMeses,	sut.nPublicaciones
from usuario usu inner join suscripcion sus on usu.nUsuarioId = sus.nUsuarioId INNER JOIN suscriptipo sut
on sus.nSuscripcionTipoId =sut.nSuscripTipoId");
$consulta->execute();
$prop = $consulta->fetchAll(PDO::FETCH_ASSOC);

 foreach($prop as $row){
   $id=$row['nPropiedadId'];
   /*$consulta = $pdo->prepare("UPDATE propiedad set nVisitas=nVisitas+1 where nPropiedadId=$id");
   $consulta->execute();*/

   echo "
   
   <div class='col'>
           <div class='card shadow-sm'>"
       ;
                            
       $imagen="adminHtml/adminPhp/img/subidas/$id/portada.png";
           if(!file_exists($imagen)){
              //echo "no existe";
           }
                            
   echo "          <img src='";  echo $imagen; echo "  '>
                   <div class='card-body'>
                           <p class='card-title'>". $row['cTituloPropiedad']." </p>
                           <p class='card-title'>". $row['nUsuarioId']." </p>
                           <p class='card-title'>". $row['nPropiedadId']." </p>
                           <small>". $row['cExtra'] ." </small>
                           <div class='d-flex justify-content-between aling-items-center'>
                                  <div class='mt-3'>
                                  <a href='login.html'class='btn btn-outline-primary me-2'>Ver mas</a>
                                  <a href='login.html'class='btn btn-primary me-2'>Agregar Fotos</a>
                                  <a href='login.html'class='btn btn-danger me-2'>Eliminar</a>
                                  </div>
                          
                           </div>
                   </div>
           </div>
   </div>
       ";
 

 }
    }
}
 else{
  echo "no se ha iniciado sesion";
 }
      
 

  



   
  

 
    