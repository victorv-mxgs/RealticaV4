<?php  
validarvacio("url_imagen");

function validarvacio($imagen){
	if(empty($_FILES[$imagen]["name"])){
		echo"vacio";
		return;
	}
	else{
		
		$extension = pathinfo($_FILES[$imagen]["name"],PATHINFO_EXTENSION);
		$ext_formatos = array('png','jpg','jpeg');
		if(!in_array(strtolower($extension),$ext_formatos)){
			echo"novalido";
			return;
		}else{
			require("conn.php");
			session_start();
			$usu=$_SESSION['nombre_usuario'];
			$query = $pdo->prepare("SELECT * from usuario where cUsers='$usu' ");
			$query->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			$idusuario=$resultado[0]['nUsuarioId']; 

			include 'conexion.php';
			$titulo = $_POST['titulo'];
  			$agente = $_POST['agente'];
    		$descripcion=$_POST['descripcion'];
    		$irregular = $_POST['irregular'];
    
    		$estados = $_POST['estados'];
    		$municipios = $_POST['municipios'];
    		$localidades = $_POST['localidades'];
    		$vialidadtipo=$_POST['vialidadtipo'];

    		$usuSuelo=$_POST['usuSuelo'];
    		$domicilio=$_POST['domicilio'];
    		$numext=$_POST['numext'];
    		$numint=$_POST['numint'];

    		$edificionum=$_POST['edificionum'];
    		$estatus=$_POST['estatus'];
    		$tipo=$_POST['tipo'];
    		
   			$frente=$_POST['frente'];
    		$fondo=$_POST['fondo'];
    		$terrenosuper=$_POST['terrenosuper'];
    		$constSuperf=$_POST['constSuperf'];
 
    		$Extra=$_POST['extra'];
    		$niveles=$_POST['niveles'];
    		$amenidades=$_POST['amenidades'];
    		$pago=$_POST['pago'];

    		$financiamiento=$_POST['financiamiento'];
    		$espacios=$_POST['espacios'];
			$latitud=$_POST['latitud'];
            $longitud=$_POST['longitud'];

    		$noservicios=$_POST['noservicios'];
    		$servicios=$_POST['servicios'];
    		
			$destacada=$_POST['destacada'];
			$construccion=$_POST['construccion'];
			$irregular=$_POST['radio'];//checar
			//zona horaria de México.
 			date_default_timezone_set("America/Mexico_City");
			$fecha = date('Y-m-d');
		

			$conf = new Configuracion();
			$conf->conectarBD();
			$insertar = "INSERT INTO propiedad (nUsuarioId,nEstadoId,nMunicipioId,nLocalidadId,nVialidadTipoId,nUsoSueloId,cTituloPropiedad,cDomicilio,cNumExt,cNumInt,cNumEdi,cDescripcion,cStatus,cTipo,dConstruccion,nFrente,nFondo,bIrregular,nTerrenoSuper,nConstSuperf,cExtra,nNiveles,cAmenidades,nPago,nLatitud,nLongitud,dRegistro,dPublicacion,nDestacada)
			 VALUES ('$idusuario','$estados','$municipios','$localidades','$vialidadtipo','$usuSuelo','$titulo','$domicilio','$numext','$numint','$edificionum','$descripcion','$estatus','$tipo','$construccion','$frente','$fondo','$irregular','$terrenosuper','$constSuperf','$Extra','$niveles','$amenidades','$pago','$latitud','$longitud','$fecha','$fecha','$destacada')";
			$conf->actualizacion($insertar);
			
			$consulta = "SELECT MAX(nPropiedadId) AS id FROM propiedad";
			$res = $conf->consulta($consulta);
			$id_propiedad = $res[0]["id"];
			
			insertaImagen($id_propiedad,"url_imagen",$conf);

			financiamiento($id_propiedad,$financiamiento,$conf);

			

			publicacion($id_propiedad,$fecha,$conf);
			echo"ok";
		
			

			$conf->desconectarDB();
				
			
		}
		 
	
		 
	}
}


function insertaImagen($id_prop,$tipo_imagen,$conf){
	$extension = pathinfo($_FILES[$tipo_imagen]["name"],PATHINFO_EXTENSION);
	$ext_formatos = array('png','jpg','jpeg');
	$nombre = $_FILES[$tipo_imagen]["name"];
	$file_name = $_FILES[$tipo_imagen]["name"];

	$targetDir = "../img/subidas/$id_prop/";//aqui se guardan
    $ruta="img/subidas/$id_prop";//esto para que aparezca en la bd
	@rmdir($targetDir);

	if (!file_exists($targetDir)){

		@mkdir($targetDir,077,true);
	}

	$token = md5(uniqid(rand(), true));
	$portada='portada';
	$file_name =$portada.'.'.$extension;

	$add = $targetDir.$file_name;
	$db_url_img = "$ruta/$file_name";
	
	if(move_uploaded_file($_FILES[$tipo_imagen]["tmp_name"],$add)){

		$sql = "INSERT INTO media (nPropiedadId,cNombre,cArchivo) values('$id_prop','$portada','$db_url_img')";
		$conf ->actualizacion($sql);
		echo"ok";
	}

}

function espacios($id_prop,$espacios,$conf){
	
		$sql = "INSERT INTO espacio (nPropiedadId,nEspacioTipoId,nCantidad) 
		values('$id_prop','$espacios','$espacios')";
		$conf ->actualizacion($sql);
		echo"ok";


}
function servicios($id_prop,$servicios,$conf){
	
	$sql = "INSERT INTO servicio (nPropiedadId,nServicioTipoId) 
	values('$id_prop','$servicios')";
	$conf ->actualizacion($sql);
	echo"ok";


}
function financiamiento($id_prop,$financiamiento,$conf){
	
		$sql = "INSERT INTO financiamiento (nPropiedadId,nFinanciamientoTipoId) 
		values('$id_prop','$financiamiento')";
		$conf ->actualizacion($sql);
		echo"ok";


}
function publicacion($id_prop,$fecha,$conf){
	
	$sql = "INSERT INTO publicacion (nPropiedadId,dPublicacion) 
	values('$id_prop','$fecha')";
	$conf ->actualizacion($sql);
	echo"ok";


}

?>