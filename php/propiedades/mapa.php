<?php
$servername="localhost";
$username="root";
$password="";
$dbname="Realticabd";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
	die("Connection Failed".$conn->connect_error);
}else{
	
}

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


$query = "SELECT * from  propiedad";
$result = mysqli_query($conn,$query);
if (!$result) {
  die('Invalidproyecto query: ' . mysqli_error());
}

header("Content-type: text/xml");


echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;

while ($row = @mysqli_fetch_assoc($result)){

  echo '<marker ';
  echo 'idmapa="' . $row['nPropiedadId'] . '" ';
  echo 'persona="' . $row['cTituloPropiedad'] . '" ';
  echo 'descripcion="' . parseToXML($row['nPago']) . '" ';
  echo 'lat="' . $row['nLatitud'] . '" ';
  echo 'lng="' . $row['nLongitud'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}


echo '</markers>';

?>
