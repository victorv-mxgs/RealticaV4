
<!DOCTYPE html>
<html>
<head>
<!--/tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- //tags -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/include-html.js"></script><!--para incluir partes de codigo html-->
<!-- //for bootstrap working -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
<!--estilo bootstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<div data-include="php/menus/menu.php"></div><!--barra de menu-->

<div data-include="partesHtml/btnRedesSociales.html"></div><!--boton de whatsapp y redes sociales-->

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
 require 'php/config.php';


 $idprop= isset($_GET['id']) ? $_GET['id'] : '' ;

 $token= isset($_GET['token']) ? $_GET['token'] : '' ;


if($idprop == ''|| $token == ''){
    echo "error";
    exit;
}
else{
    $token_tmp= hash_hmac('sha1',$idprop,KEY_TOKEN);
    if($token==$token_tmp){
    $consulta = $pdo->prepare("SELECT count(nPropiedadId) from propiedad where nPropiedadId=? ");
    $consulta->execute([$idprop]);
    if($consulta->fetchColumn()>0){
		
		$consulta = $pdo->prepare("UPDATE propiedad set nVisitas=nVisitas+1 where nPropiedadId=?");
		$consulta->execute([$idprop]);

        $consulta = $pdo->prepare("SELECT * from propiedad where nPropiedadId=? ");
        $consulta->execute([$idprop]);
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        $titulo=$resultado['cTituloPropiedad'];
        $numeroExterior=$resultado['cNumExt'];
        $numeroInterior=$resultado['cNumInt'];
        $numeroEdificio=$resultado['cNumEdi'];
        $descripcion=$resultado['cDescripcion'];
        $status=$resultado['cStatus'];
        $tipo=$resultado['cTipo'];

        $construidadesde=$resultado['dConstruccion'];
        $frente=$resultado['nFrente'];
        $fonto=$resultado['nFondo'];
        $irregular=$resultado['bIregular'];
        $terreno=$resultado['nTerrenoSuper'];

        $nConstSuperf=$resultado['nConstSuperf'];
        $extra=$resultado['cExtra'];

        $niveles=$resultado['nNiveles'];
        $amenidades=$resultado['cAmenidades'];
        $pago=$resultado['nPago'];
        $latitud=$resultado['nLatitud'];
        $longitud=$resultado['nLongitud'];
        $registro=$resultado['dRegistro'];
        $publicacion=$resultado['dPublicacion'];

		 $dir_images='adminHtml/adminPhp/img/subidas/'.$idprop.'/';
		 $principal= $dir_images.'portada.jpg';

		 if(!file_exists($principal)){
			//echo "no existe";
		 }
		 $imagenes =array();
		 $dir=dir($dir_images);
		 while(($archivo=$dir->read())!=false){
			if($archivo != 'portada.jpg'&& (strpos($archivo,'jpg')||strpos($archivo,'jpeg'))){
			
				$imagenes[]=$dir_images.$archivo;
			}
		 }
		 $dir->close();

    }
    
    }else{
    echo "error al mostrar";
    exit;
    }
}
 

session_start();


if(isset($_SESSION['nombre_usuario'])){
$usu=$_SESSION['nombre_usuario'];

$consulta = $pdo->prepare("SELECT * from propiedad where nPropiedadId=? ");
$consulta->execute([$idprop]);
$consulta->execute();
$res = $consulta->fetch(PDO::FETCH_ASSOC);
$usuarioProp=$res['nUsuarioId'];


$consulta = $pdo->prepare("SELECT * from usuario where nUsuarioId=? ");
$consulta->execute([$usuarioProp]);
$consulta->execute();
$ress = $consulta->fetch(PDO::FETCH_ASSOC);

$nombreU=$ress['cNombre'];
$app=$ress['cApellidos'];
$telefono=$ress['nTel'];
$correo=$ress['cEmail'];

$consulta = $pdo->prepare("SELECT * from financiamiento where nPropiedadId=? ");
$consulta->execute([$idprop]);
$consulta->execute();
$resss = $consulta->fetch(PDO::FETCH_ASSOC);

$finan=$resss['nFinanciamientoTipoId'];

$consulta = $pdo->prepare("SELECT * from financiamientotipo where nFinanciamientoTipoId=? ");
$consulta->execute([$finan]);
$consulta->execute();
$resss = $consulta->fetch(PDO::FETCH_ASSOC);

$financiamiento=$resss['cFinanciamiento'];


}

	
	$consulta = $pdo->prepare("SELECT * from propiedad where nPropiedadId=? ");
	$consulta->execute([$idprop]);
	$consulta->execute();
	$res = $consulta->fetch(PDO::FETCH_ASSOC);
	$usuarioProp=$res['nUsuarioId'];
	
	
	$consulta = $pdo->prepare("SELECT * from usuario where nUsuarioId=? ");
	$consulta->execute([$usuarioProp]);
	$consulta->execute();
	$ress = $consulta->fetch(PDO::FETCH_ASSOC);
	
	$nombreU=$ress['cNombre'];
	$app=$ress['cApellidos'];
	$telefono=$ress['nTel'];
	$correo=$ress['cEmail'];
	
	$consulta = $pdo->prepare("SELECT * from financiamiento where nPropiedadId=? ");
	$consulta->execute([$idprop]);
	$consulta->execute();
	$resss = $consulta->fetch(PDO::FETCH_ASSOC);
	
	$finan=$resss['nFinanciamientoTipoId'];
	
	$consulta = $pdo->prepare("SELECT * from financiamientotipo where nFinanciamientoTipoId=? ");
	$consulta->execute([$finan]);
	$consulta->execute();
	$resss = $consulta->fetch(PDO::FETCH_ASSOC);
	
	$financiamiento=$resss['cFinanciamiento'];
	
	
	

?>
<body>
  <br><br><br>  <br><br><br>

<div class="banner-bootom-w3-agileits">
	<div class="container">
	    <div class="col-md-12 col-lg-6 ">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					
					<ul class="slides">
						<li data-thumb="<?php echo $principal; ?>">
							<div class="thumb-image"> <img src="<?php echo $principal; ?>" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						<?php foreach($imagenes as $img){?>
							<li data-thumb="<?php echo $img; ?>">
							<div class="thumb-image"> <img src="<?php echo $img; ?>" data-imagezoom="true" class="img-responsive"> </div>
						</li>	
							
							<?php } ?>
						
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>

		<div class="col-md-12 col-lg-6  single-right-left simpleCart_shelfItem">
					<h3><?php echo $titulo; ?></h3> 
					<p><span class="item_price">$ <?php echo number_format($pago,2,'.',','); ?> </span> </p>
					
					<div class="occasional">
						<h5>Direcciones :</h5>
						<div class="colr ert">
							<label class="radio text-center"><input type="radio" name="radio"><i></i>Numero de edificio <br> <?php echo $numeroEdificio; ?></label>
						</div>
						<div class="colr">
							<label class="radio text-center"><input type="radio" name="radio"><i></i>Numero exterior <br> <?php echo $numeroExterior; ?> </label>
						</div>
						<div class="colr">
							<label class="radio text-center"><input type="radio" name="radio"><i></i>Numero interior <br> <?php echo $numeroInterior; ?></label>
						</div>
						<div class="clearfix"> </div>
					</div>
					
					<div class="occasional">
						<h5>Caracteristicas :</h5>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio"><i></i>Status<br> <?php echo $status; ?></label>
						</div>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio"><i></i>Tipo de propiedad<br> <?php echo $tipo; ?></label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>Numero de niveles<br>  <?php echo $niveles; ?> </label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>Construida desde <br>  <?php echo $construidadesde; ?></label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="occasional">
						<h5>Medidas de la propiedad :</h5>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio"><i></i>Frente<br> <?php echo $frente; ?></label>
						</div>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio"><i></i>Fondo<br> <?php echo $fonto; ?></label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>Superficie de terreno<br>  <?php echo $terreno; ?> </label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>Superficie de construccion <br>  <?php echo $nConstSuperf; ?></label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>La propiedad es irregular <br>  <?php echo $irregular; ?></label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="occasional">
						<h5>Mas informacion :</h5>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio"><i></i>Amenidades<br> <?php echo $amenidades; ?></label>
						</div>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio"><i></i>Fecha de publicion<br> <?php echo $publicacion; ?></label>
						</div>
						
						
						<div class="clearfix"> </div>
					</div>
            </div>	
																			
	</div>					
</div>




	<!-- /new_arrivals --> 
<div class="responsive_tabs_agileits"> 
<div id="horizontalTab">
		<ul class="resp-tabs-list">
			<li>Descripcion</li>
			<li>Contactar</li>
			<li>Information</li>
		</ul>
	<div class="resp-tabs-container">
					<!--/tab_one-->
	<div class="tab1">
        <div class="single_page_agile_its_w3ls">
            <h6>Descripcion</h6>
            
            <p class="w3ls_para"><?php echo $descripcion; ?></p><hr>
        </div>
	</div>
						<!--//tab_one-->
	<div class="tab2">				
	    <div class="single_page_agile_its_w3ls">
		    <div class="bootstrap-tab-text-grids">

			    <div class="bootstrap-tab-text-grid">
				    <div class="bootstrap-tab-text-grid-left">
					    <img src="" alt=" " class="img-responsive">
				    </div>
			        <div class="bootstrap-tab-text-grid-right">
				        <ul>
					        <li><a href="#">Informacion de contacto</a></li>
					     
				        </ul>
				            <label for="">Nombre del propietario: <?php echo $nombreU;?> <?php echo $app; ?></label><br>
							<label for="">Telefono: <?php echo $telefono; ?></label><br>
							<label for="">Correo electronico: <?php echo $correo; ?></label><br><hr>
				    </div>
				    <div class="clearfix"> </div>
				</div>

			</div>
		</div>
	</div>

	<div class="tab3">
        <div class="single_page_agile_its_w3ls">
			<h6>Informacion extra</h6>
			<p><?php echo $extra; ?></p>
			<p><?php echo $financiamiento; ?></p>
			
			<hr>
		</div>
	</div>
						
</div>



<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<script src="js/modernizr.custom.js"></script>

<script src="js/imagezoom.js"></script>
<!-- single -->
<!-- script for responsive tabs -->						
<script src="js/easy-responsive-tabs.js"></script>
<script>
	$(document).ready(function () {
	$('#horizontalTab').easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion           
	width: 'auto', //auto or any width like 600px
	fit: true,   // 100% fit in a container
	closed: 'accordion', // Start closed if in accordion view
	activate: function(event) { // Callback function if tab is switched
	var $tab = $(this);
	var $info = $('#tabInfo');
	var $name = $('span', $info);
	$name.text($tab.text());
	$info.show();
	}
	});
	$('#verticalTab').easyResponsiveTabs({
	type: 'vertical',
	width: 'auto',
	fit: true
	});
	});
</script>
<!-- FlexSlider -->
<script src="js/jquery.flexslider.js"></script>
						<script>
						// Can also be used with $(document).ready()
							$(window).load(function() {
								$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
								});
							});
						</script>
					<!-- //FlexSlider-->
<!-- //script for responsive tabs -->		
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
<!--Iconos redes sociales-->
<script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script><footer class="pie-pagina">

<footer>
    <div data-include="partesHtml/footer.html"></div><!--pie de pagina-->
    
</footer>

</html>
