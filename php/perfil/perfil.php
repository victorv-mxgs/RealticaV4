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
$susActiv=$resultado[0]['bSuscripcion'];


$consulta = $pdo->prepare("SELECT sust.nSuscripTipoId,sust.cNombre,sust.cDescripcion,sust.nPrecio, 
sus.nPubRestantes, sus.nPubActivas,
sust.nMeses,sust.nPublicaciones, sus.nSuscripcionId	, sus.nUsuarioId,
sus.nSuscripcionTipoId	,sus.dRegistro	,sus.dPago	,sus.nPago, usu.nUsuarioId
from suscriptipo sust
INNER join suscripcion sus ON sust.nSuscripTipoId = sus.nSuscripcionTipoId INNER join usuario usu
 ON usu.nUsuarioId = sus.nUsuarioId WHERE usu.cUsers='$usu'");
$consulta->execute();
$res = $consulta->fetch(PDO::FETCH_ASSOC);
$suscripcion=$res['cNombre'];
$descripcion=$res['cDescripcion']; 
$precio=$res['nPrecio']; 
$meses=$res['nMeses'];
$publicaciones=$res['nPublicaciones']; 
$registro=$res['dRegistro'];
$publicacionesRestantes=$res['nPubRestantes'];
$publicacionesActivas=$res['nPubActivas'];
  

if($susActiv>0)
{
    foreach($resultado as $data){
   
        echo "
<div class='col-md-4 mb-3'>   
    <div class='card'>
        <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center>
            <img src='https://bootdey.com/img/Content/avatar/avatar7.png' alt='Admin' class='rounded-circle' width='150'>
                <div class='mt-3'>
                    <h4>". $data['cNombre'] ."</h4>
                    <p class='text-secondary mb-1'>". $data['cUsers'] ."</p>
                    <p class='text-muted font-size-sm'> ". $data['cDomicilio'] ."</p>
                    <a href='suscripcion.html'class='btn btn-outline-primary me-2'>Cambiar plan</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class='card mt-3'>
        <ul class='list-group list-group-flush'>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Suscripcion activa</h6>
                <span class='text-secondary'>";echo $suscripcion;echo"</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Publicaciones por suscripcion</h6>
                <span class='text-secondary'>";echo $publicaciones;echo"</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Publicaciones activas</h6>
                <span class='text-secondary'>";echo $publicacionesActivas;echo"</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Publicaciones restantes</h6>
                <span class='text-secondary'>";echo $publicacionesRestantes;echo"</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Descripcion</h6>
                <span class='text-secondary'>";echo $descripcion;echo"</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Costo por suscripcion</h6>
                <span class='text-secondary'>$";echo $precio;echo" pesos</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Duracion de la suscripcion</h6>
                <span class='text-secondary'>";echo $meses;echo" meses</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Activa desde</h6>
                <span class='text-secondary'>";echo $registro;echo"</span>
            </li>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
            <div class='col-sm-12'>
            <button type='button' data-bs-toggle='modal' class='btn btn-info'data-bs-target='#myModal' onclick=publicar('" . $data['nUsuarioId'] . "')>
            Publicar Propiedad
            </button>
            </div>
            </li>
        </ul>
    </div>
</div>

<div class='col-md-8'>
    <div class='card mb-3'>
        <div class='card-body'>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Nombre Completo</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cNombre'] ."  ". $data['cApellidos'] ."
                </div>
            </div>
            <hr>
            <div class='row'>
            <div class='col-sm-3'>
                <h6 class='mb-0'>Nombre de usuario</h6>
            </div>
            <div class='col-sm-9 text-secondary'>
            ". $data['cUsers'] ."  
            </div>
        </div>
        <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Numero de Telefono</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['nTel'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Tipo de Telefono</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cTelTipo'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Correo Electronico</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cEmail'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Domicilio</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cDomicilio'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Tipo de Persona</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cPersonaTipo'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Registro Federal de Contribuyentes</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cRFC'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-12'>
                <button type='button' data-bs-toggle='modal' data-bs-target='#modalperfil' class='btn btn-info' onclick=editar('" . $data['nUsuarioId'] . "')>
                Editar Informacion
                </button>
                </div>
            </div>
        </div>
    </div>
</div>
        
         
";
  }

}else{
 
    foreach($resultado as $data){
   
        echo "
<div class='col-md-4 mb-3'>   
    <div class='card'>
        <div class='card-body'>
            <div class='d-flex flex-column align-items-center text-center>
            <img src='https://bootdey.com/img/Content/avatar/avatar7.png' alt='Admin' class='rounded-circle' width='150'>
                <div class='mt-3'>
                    <h4>". $data['cNombre'] ."</h4>
                    <p class='text-secondary mb-1'>". $data['cUsers'] ."</p>
                    <p class='text-muted font-size-sm'> ". $data['cDomicilio'] ."</p>
                    <a href='suscripcion.html'class='btn btn-outline-primary me-2'>Suscripcion</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class='card mt-3'>
        <ul class='list-group list-group-flush'>
            <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                <h6 class='mb-0'>Suscripcion activa</h6>
                <span class='text-secondary'>";echo "Ninguna suscripcion activa";echo"</span>
            </li>
        </ul>
    </div>
</div>

<div class='col-md-8'>
    <div class='card mb-3'>
        <div class='card-body'>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Nombre Completo</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cNombre'] ."  ". $data['cApellidos'] ."
                </div>
            </div>
            <hr>
            <div class='row'>
            <div class='col-sm-3'>
                <h6 class='mb-0'>Nombre de usuario</h6>
            </div>
            <div class='col-sm-9 text-secondary'>
            ". $data['cUsers'] ."  
            </div>
        </div>
        <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Numero de Telefono</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['nTel'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Tipo de Telefono</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cTelTipo'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Correo Electronico</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cEmail'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Domicilio</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cDomicilio'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Tipo de Persona</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cPersonaTipo'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Registro Federal de Contribuyentes</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                ". $data['cRFC'] ."  
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-12'>
                <button type='button' data-bs-toggle='modal' data-bs-target='#modalperfil' class='btn btn-info' onclick=editar('" . $data['nUsuarioId'] . "')>
                Editar Informacion
                </button>
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
      
?>



   
  

 
    