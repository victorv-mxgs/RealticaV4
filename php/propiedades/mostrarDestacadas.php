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
 require 'config.php';
 $consulta = $pdo->prepare("SELECT pro.cTituloPropiedad, pro.cExtra, pro.cStatus, pro.dConstruccion, pro.nPago, pro.nPropiedadId,  me.cNombre from propiedad pro inner join media me on me.nPropiedadId = pro.nPropiedadId
 WHERE nDestacada =1 ORDER BY dRegistro desc limit 6 ");
 $consulta->execute();
 $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

 foreach($resultado as $row){
    $id=$row['nPropiedadId'];
    
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
                            <p class='card-title'>". $row['cTituloPropiedad'] ." </p>
                            <small>". $row['cExtra'] ." </small>
                            <div class='d-flex justify-content-between aling-items-center'>
                                   <div class='btn-group'>
                                   <a  class='btn btn-info' href='vista.php?id=";echo $row['nPropiedadId'];echo"&token=";echo hash_hmac('sha1',$row['nPropiedadId'], KEY_TOKEN); echo" '>ver mas</a>

                                   </div>
                           
                            </div>
                    </div>
            </div>                         
    </div>
        "; 
  }
      
 
 
      




 
    