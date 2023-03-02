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
 require 'config.php';
 $consulta = $pdo->prepare("SELECT * from usuario where cUsers='$usu' ");
 $consulta->execute();
 $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

  foreach($resultado as $data){
    $idusuario=$data['nUsuarioId'];
    
   
//muestra todas las propiedades del usuario y su informacion
$consulta = $pdo->prepare("SELECT * from propiedad where nUsuarioId=$idusuario and nActiva='1'
ORDER BY nPropiedadId ASC ");
$consulta->execute();
$prop = $consulta->fetchAll(PDO::FETCH_ASSOC);

 foreach($prop as $row){
   $id=$row['nPropiedadId'];
   $activo=$row['nActiva'];
  
   echo "
   
   <div class='col'>
           <div class='card shadow-sm'>"
       ;
                            
       $imagen="adminHtml/adminPhp/img/subidas/$id/portada.jpg";
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
                                  <a class='btn btn-info' href='vista.php?id=";echo $row['nPropiedadId'];echo"&token=";echo hash_hmac('sha1',$row['nPropiedadId'], KEY_TOKEN); echo" '>ver mas</a>
                                  <a class='btn btn-info' href='fotos.php?id=";echo $row['nPropiedadId'];echo"&token=";echo hash_hmac('sha1',$row['nPropiedadId'], KEY_TOKEN); echo" '>Agregar mas fotos</a>                                
                                  </div>"; 
                                 
                                  
                                  if($activo==1){
                                  echo "            
                                  <button type='button' class='btn btn-danger me-2'  onclick=archivar('" . $row['nPropiedadId'] . "') >Archivar</button>
                                
                                   </div>";
                              
                                  }else if($activo==0){
                                      echo "
                                      <button type='button' class='btn btn-danger me-2'  onclick=activar('" . $row['nPropiedadId'] . "') >Activar</button>
                                      
                                      </div>"; 
                                  }
                               
                        echo "
                          
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
      
 

  



   
  

 
    