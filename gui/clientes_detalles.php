<?php
$parent = dirname(__DIR__);
require_once $parent.'/controller/php/controller/ClientServicesBasesControllerObj.php';
require_once $parent."/config/ViewMaker.php";

session_start();
if(!isset($_SESSION['active']) || !$_SESSION['active'])
	header( "Location: ../");

$url = basename($_SERVER['PHP_SELF']);

if(!isset($_SESSION['access']["$url"]))
	header( "Location: ../");

if(!isset($_GET['idCliente']) || $_GET['idCliente'] == '' || !isset($_GET['Cliente']) || $_GET['Cliente'] == '')
	header("Location:clientes.php");

$detailsController = new ClientServicesBasesController();
$viewMaker = new ViewMaker();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Clientes: Detalles</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script  type="text/javascript" src="../controller/js/bootpage.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/volumetrias_styles.css">
	<link rel="stylesheet" href="css/clientes_styles.css">
	<link rel="stylesheet" href="css/clientes_detalles_styles.css">
	<script  type="text/javascript" src="../controller/js/bootstrapdatepicker.js"></script>
	<script  type="text/javascript" src="../controller/js/datepicker_controller.js"></script>
	<script  type="text/javascript" src="../controller/js/clientesDetallesController.js"></script>
	<link rel="stylesheet" href="css/bootstrapdatepicker_styles.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">
			<div>
				<img alt="Brand" src="./img/masnegocio_.png" width="130" height="70" style="padding-bottom:23px;">
			</div>
		  </a>
		</div>
		<ul class="nav navbar-nav">
		  <?php
			$viewMaker->getNavBarElements($_SESSION['pages'], basename($_SERVER['PHP_SELF']));
		  ?>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php" id="logout"><i class="glyphicon glyphicon-log-out"></i> Cerrar sesión</a></li>
		</ul>
	  </div>
	</nav>
	<div class="jumbotron text-center">
		<h1>Detalles</h1>
		<p>Información detallada de los clientes y sus servicios</p> 
	</div>
	<div class="container">
		<div id="dialog-confirm" title="Modificar elemento">
		</div>
		<div id="dialog-add" title="Agregar servicio">
			<form>
				<fieldset>
					<div class="form-group row">
						<label for="service-form-selector" class="col-2 col-form-label">Servicio</label>
						<div class="col-10">
							<select name="servicio" class="form-control service-client-form-input" id="service-form-selector" style="width:90%" 
							data-validation="required"
							data-validation-error-msg="Seeccione un elemento de la lista">
							</select>
							<input type="hidden" class="service-client-form-input" name="clienteid" id="input-form-cliente" value="<?php echo $_GET['idCliente']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="input-form-cantidad" class="col-2 col-form-label">Cantidad</label>
						<div class="col-10">
							<input type="number" class="service-client-form-input" name="cantidad" id="input-form-cantidad" placeholder="Cantidad">
						</div>
					</div>
					<div class="form-group row">
						<label for="input-form-unidad" class="col-2 col-form-label">Unidad</label>
						<div class="col-10">
							<input type="text" class="service-client-form-input" name="unidad" id="input-form-unidad" placeholder="Unidad">
						</div>
					</div>
					<div class="form-group row">
						<label for="input-form-vigencia" class="col-2 col-form-label">Vigencia</label>
						<div class="col-10">
							<input type="text" class="service-client-form-input" name="vigencia" id="input-form-vigencia" placeholder="Vigencia">
						</div>
					</div>
					
					<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
				</fieldset>
			</form>
		</div>
		<div class="row">
			<div class="col-sm-12" id="crud-table">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="blue-strip">
								<th id="tittle-cell" colspan="6"><?php echo $_GET['Cliente']; ?></th>
							</tr>
							<tr class="orange-strip">
								<th>ID</th>
								<th>Servicios  <button type="button" class="btn btn-default btn-circle add-btn" title="Nuevo servicio" data-toggle="popover" data-trigger="hover"><i class="glyphicon glyphicon-plus"></i></button></th>
								<th colspan="3" style="text-align:center;">Bases</th>
								<th style="text-align:center;">Opciones</th>
							</tr>
						</thead>
						<tbody id="detalles-tabla-body">
							<?php
								$detailsController->GetClientDetails($_GET);
							?>
						</tbody>
					</table>
					<div id="paginator-container">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="container-bar">
		<div class="col-sm-12 navbar-text navbar-static-bottom">
		</div>
	</div>
	
	<br>
	<br>
</body>
</html>