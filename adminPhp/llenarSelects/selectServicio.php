<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM serviciotipo");
while($row=mysqli_fetch_array($result)){
	echo '<label class="col-md-4"><input type="checkbox"  value="'.$row['nServicioTipoId'].'">';
	echo $row['cServicio'];
	echo'</label>';
}
