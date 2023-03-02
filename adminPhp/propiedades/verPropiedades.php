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
//muestra todas las propiedades y su informacion
$consulta = $pdo->prepare("SELECT pro.cTituloPropiedad, pro.cExtra, pro.cStatus, pro.dConstruccion, pro.nPago, pro.nPropiedadId,  me.cNombre from propiedad pro inner join media me on me.nPropiedadId = pro.nPropiedadId
ORDER BY nPropiedadId ASC ");
//$consulta = $pdo->prepare("SELECT * FROM media ORDER BY nMediaId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM propiedad WHERE nUsuarioId LIKE '%".$data."%' OR nPropiedadId LIKE '%".$data."%' OR dRegistro LIKE '%".$data."%'");
    $consulta->execute();
} 

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

foreach($resultado as $data){
    $id=$data['nPropiedadId'];
    
    echo "
    <div class='col'>
            <div class='card shadow-sm'>"
        ;
        $imagen="adminPhp/img/subidas/$id/portada.jpg";

           
            if(!file_exists($imagen)){
               //echo "no existe";style ='height: 330px; width: 360px;'
            }
                              
    echo "          
    <div class='card shadow-sm'>
    <img width='100%' height='100%' src='";  echo $imagen; echo "  '>
    </div>
                    <div class='card-body'>
                            <p class='card-title'>". $data['cTituloPropiedad'] ." </p>
                            <small>". $data['cExtra'] ." </small>
                            <div class='d-flex justify-content-center aling-items-center'>
                                   <div class='btn-group'>
                                   <a href='../vista.php?id=";echo $data['nPropiedadId'];echo"&token=";echo hash_hmac('sha1',$data['nPropiedadId'], KEY_TOKEN); echo" '>ver mas</a>
                                   <button type='button' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success md-2' onclick=editarprop('" . $data['nPropiedadId'] . "')>Editar</button>
                                   <button type='button' class='btn btn-danger ' onclick=Eliminarprop('" . $data['nPropiedadId'] . "')>Eliminar</button>
                                   
                                   </div>
                            </div>
                    </div>
            </div>
    </div>
        "; 
  }

    