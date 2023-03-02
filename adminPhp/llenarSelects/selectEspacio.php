<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM espacioTipo");
while($row=mysqli_fetch_array($result)){
	echo '<label class="col-md-4">
<input  class="col-md-4" type="text" id="'.$row['nEspacioTipoId'].'"  placeholder="0" value="">  ';
	echo $row['cDescripcion'];
	echo'</label>';
}	
