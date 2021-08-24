<?php
/*
░██████╗███╗░░░███╗░█████╗░██████╗░████████╗██╗░░██╗░█████╗░███╗░░░███╗███████╗
██╔════╝████╗░████║██╔══██╗██╔══██╗╚══██╔══╝██║░░██║██╔══██╗████╗░████║██╔════╝
╚█████╗░██╔████╔██║███████║██████╔╝░░░██║░░░███████║██║░░██║██╔████╔██║█████╗░░
░╚═══██╗██║╚██╔╝██║██╔══██║██╔══██╗░░░██║░░░██╔══██║██║░░██║██║╚██╔╝██║██╔══╝░░
██████╔╝██║░╚═╝░██║██║░░██║██║░░██║░░░██║░░░██║░░██║╚█████╔╝██║░╚═╝░██║███████╗
╚═════╝░╚═╝░░░░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝░░░╚═╝░░░╚═╝░░╚═╝░╚════╝░╚═╝░░░░░╚═╝╚══════╝

* Aplicación web para la finalización del 3er cuatrimestre cursado
en Universidad Tecnólogica del Sur de Sonora.

* Made with ❤ by Thomas
*/

$corepage = explode("/", $_SERVER["PHP_SELF"]);
$corepage = end($corepage);

if($corepage !== "index.php") {
	if($corepage == $corepage) {
		$corepage = explode(".", $corepage);
		header("Location: index.php?page=".$corepage[0]);
    }
}

if(isset($_POST["añadirdispositivo"])) {
	$nd = $_POST["nd"];
  	$ip = $_POST["ip"];
  	$lugar = $_POST["lugar"];
	
  	$query = "INSERT INTO `dispositivos`(`nd`, `lugar`, `ip`) VALUES ('$nd', '$lugar', '$ip');";
  	if (mysqli_query($db_con, $query)) {
  		$datainsert["insertsucess"] = "<p style='color: green;'>¡DISPOSITIVO AGREGADO!</p>";
  	} else {
  		$datainsert["inserterror"]= "<p style='color: red;'>¡HA OCURRIDO UN PROBLEMA!</p>";
  	}
}
?>

<h1 style="color: #2d2d2d;"><i class="fas fa-plus" ></i>  Añadir dispositivo</h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard </a></li>
     <li class="breadcrumb-item active" aria-current="page">Añadir dispositivo</li>
  </ol>
</nav>

<div class="row">

<div class="col-sm-6">
	<?php if(isset($datainsert)) { ?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
		<div class="toast-header">
			<strong class="mr-auto">Notificación</strong>
			<small><?php echo date("d-M-Y"); ?></small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
	    	</button>
		</div>
		<div class="toast-body">
			<?php 
			if(isset($datainsert["insertsucess"])) {
	    		echo $datainsert["insertsucess"];
	    	}
	    	if(isset($datainsert["inserterror"])) {
	    		echo $datainsert["inserterror"];
	    	}
			?>
		</div>
	</div>
	<?php } ?>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
		    <label for="nd">Nombre del dispositivo</label>
		    <input name="nd" type="text" class="form-control" id="nd" value="<?= isset($nd)? $nd: "" ; ?>" required="">
	  	</div>
		
	  	<div class="form-group">
		    <label for="ip">Dirección IP</label>
		    <input name="ip" type="text" value="<?= isset($ip)? $ip: "" ; ?>" class="form-control" id="ip" required="">
	  	</div>
		
	  	<div class="form-group">
		    <label for="lugar">Lugar</label>
		    <select name="lugar" class="form-control" id="lugar" required="">
		    	<option>Seleccionar...</option>
		    	<option value="Cocina">Cocina</option>
		    	<option value="Sala">Sala</option>
		    	<option value="Estancia">Estancia</option>
		    	<option value="Cuarto">Cuarto</option>
		    	<option value="Patio">Patio</option>
		    </select>
	  	</div>
		
	  	<div class="form-group text-center">
		    <input name="añadirdispositivo" value="Añadir" type="submit" class="btn btn-danger">
	  	</div>
	</form>
</div>