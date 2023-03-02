<?php
$data = file_get_contents("php://input");
require "conexion.php";
$baseUrl = 'http://localhost/RealticaV4/adminHtml/adminPhp/suscripcion';



session_start();
               
if(isset($_SESSION['nombre_usuario'])){
$usu=$_SESSION['nombre_usuario'];

$consulta = $pdo->prepare("SELECT * from usuario where cUsers='$usu' ");
$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

 foreach($resultado as $dd){
   $idusuario=$dd['nUsuarioId'];
}

}

$consulta = $pdo->prepare("SELECT * FROM suscriptipo ORDER BY nSuscripTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM suscriptipo WHERE nSuscripTipoId LIKE '%".$data."%' OR cNombre LIKE '%".$data."%'");
    $consulta->execute();
}
$resultadosusc = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultadosusc as $data) {
    echo '<div class="text-center">
    <div class="col">
      <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
          <h4 class="my-0 fw-normal">'. $data['cNombre'] .'</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">$ '. $data['nPrecio'] .' pesos</h1>
          <ul class="list-unstyled mt-3 mb-4">
            <li>'. $data['nMeses'] .' meses</li>
            <li>'. $data['nPublicaciones'] .' publicaciones</li>
            <li>'. $data['cDescripcion'] .'</li>
            
          </ul>
          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_pay">
            <input type="hidden" name="business" value="sb-ozd9m23435471@business.example.com">
            <input type="hidden" name="cmd" value="_xclick">
       
            <input type="hidden" name="item_name" id="" value="'. $data['cNombre'] .'" required=""><br>
            <input type="hidden" name="idsus" id="idsus" value="'. $data['nSuscripTipoId'].'" required=""><br>
            
            <input type="hidden" name="amount" id="" value=" '. $data['nPrecio'] .'" required=""><br>

            <input type="hidden" name="currency_code" value="MXN">
            <input type="hidden" name="quantity" id="" value="1" required=""><br>
            <input type="hidden" name="item_number" value="1">
            <input type="hidden" name="lc" value="es_ES">
            <input type="hidden" name="no_shipping" value="1">
            <input type="hidden" name="image_url" value="https://picsum.photos/150/150">
            <input type="hidden" name="return" value=" '. $baseUrl.'/receptor.php">
            <input type="hidden" name="cancel_return" value="'. $baseUrl.'/pago_cancelado.php">
        
            <button type="submit" class="w-100 btn btn-lg btn-outline-primary">Pagar ahora con Paypal!</button>
            <hr>
        </form>
          <button type="button" class="w-100 btn btn-lg btn-outline-primary">Comprar ahora</button>
        </div>
      </div>
    </div>
  </div>';
}
?>



