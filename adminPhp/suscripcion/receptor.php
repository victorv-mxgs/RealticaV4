<?php
$baseUrl = 'http://localhost/RealticaV4';

$data = file_get_contents("php://input");

$servidor = "mysql:dbname=Realticabd;host=localhost";
$user = "root";
$pass = "";
try {
    $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
    echo "conexion fallida" .$e->getMessage();
}

// Para cambiar al entorno de producción usar: www.paypal.com
$paypal_hostname = 'www.sandbox.paypal.com';

// El token lo obtenemos en las opciones de nuestra cuenta Paypal cuando activamos PDT
$pdt_identity_token = 'tQadNQidK7ualsyQGVghD7RKBg4l-USqmPte7EDwDXc3N9Vnc_BHrefN_EW';

$tx = $_GET['tx'];

$query = "cmd=_notify-synch&tx=$tx&at=$pdt_identity_token";

$request = curl_init();
// Establecemos las opciones necesarias para realizar la solicitud a paypal
curl_setopt($request, CURLOPT_URL, "https://$paypal_hostname/cgi-bin/webscr");
curl_setopt($request, CURLOPT_POST, TRUE);
curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($request, CURLOPT_POSTFIELDS, $query);

// Opciones recomendadas especialmente en entornos de producción
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, TRUE);
// Si tu servidor no incluye los certificados verisign predeterminados debes establecer
// la ruta del certificado verisign cacert.pem, lo puedes descargar en: https://curl.se/docs/caextract.html
//curl_setopt($request, CURLOPT_CAINFO, __DIR__ . '\cacert.pem');
curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($request, CURLOPT_HTTPHEADER, array("Host: $paypal_hostname"));

// Ejecutamos la solicitud
$response = curl_exec($request);
curl_close($request);

if (!$response) {
    //HTTP ERROR
    echo "Error";
    return;
}

// Dividimos $response por líneas
$lines = explode("\n", trim($response));
$keyarray = array();


// Validamos la respuesta
if (strcmp($lines[0], "SUCCESS") == 0) {
    for ($i = 1; $i < count($lines); $i++) {
        $temp = explode("=", $lines[$i], 2);
        $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
    }

    // Verificamos que el estado de pago esté Completado
    // Comprobamos que txn_id no ha sido procesado previamente
    // Verificamos que el importe de pago y la moneda de pago sean correctos

    // En el siguiente enlace puedes encontrar una lista completa de Variables IPN y PDT.
    // https://developer.paypal.com/docs/api-basics/notifications/ipn/IPNandPDTVariables/

    $mc_gross = $keyarray['mc_gross'];
    $payment_status = $keyarray['payment_status'];
    $quantity = $keyarray['quantity'];
    $item_name = $keyarray['item_name'];
    


    session_start();


    if(isset($_SESSION['nombre_usuario'])){
    $usu=$_SESSION['nombre_usuario'];
    
    $consulta = $pdo->prepare("UPDATE usuario Set bSuscripcion=bSuscripcion+1  where cUsers=? ");
    $consulta->execute([$usu]);
   
$consult = $pdo->prepare("SELECT * from usuario where cUsers=? ");
$consult->execute([$usu]);
$ress = $consult->fetch(PDO::FETCH_ASSOC);
$id=$ress['nUsuarioId'];

/*


$consul = $pdo->prepare("SELECT * from suscriptipo where nSuscripTipoId=? ");
$consul->execute([$idsus]);
$ress = $consul->fetch(PDO::FETCH_ASSOC);
echo $id;

$nSuscripTipoId=$ress['nSuscripTipoId'];
$cNombre=$data['cNombre'];
$cDescripcion=$data['cDescripcion'];
$nPrecio=$data['nPrecio'];
$nMeses=$data['nMeses'];
$publicaciones=$data['nPublicaciones'];
echo $id;
echo $nSuscripTipoId;
echo $cNombre;
echo $cDescripcion;
echo $nPrecio;
echo $publicaciones;
$query = $pdo->prepare("INSERT INTO suscripcion(nUsuarioId,nSuscripcionTipoId,
nPago) 
VALUES (:id,:pre,:susId)");
$query->bindParam(":id", $id);

$query->bindParam(":pre", $nPrecio);

$query->bindParam(":susId", $nSuscripTipoId);
$query->execute();
$pdo = null;

$consu = "SELECT MAX(nSuscripcionId) AS ids FROM suscripcion";
$res = $conf->consulta($consulta);
$idsuscripcion = $res[0]["ids"];

$cons = $pdo->prepare("UPDATE suscripcion Set nPublicaciones=nPublicaciones+$publicaciones
  where nSuscripcionId=? ");
$cons->execute([$idsuscripcion]);

*/



    }
   
    echo "<h1>¡Hemos procesado tu pago exitosamente!</h1> 
    Recibimos $mc_gross Pesos en concepto de:  $item_name.<hr>
    Vuelve a comprar dando clic <a href='$baseUrl/perfil.html'>aquí</a>";
    return;
} else if (strcmp($lines[0], "FAIL") == 0) {
    // Registramos datos para realizar una investigación
    echo "FAIL";
    return;
}
