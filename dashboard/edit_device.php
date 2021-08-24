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
    
$id = base64_decode($_GET["id"]);

if(isset($_POST["actualizardispositivo"])) {
	$nd = $_POST["nd"];
  	$ip = $_POST["ip"];
  	$lugar = $_POST["lugar"];
	
  	$query = "UPDATE `dispositivos` SET `nd`='$nd', `lugar` = '$lugar', `ip` = '$ip' WHERE `id` = $id";
  	
	if(mysqli_query($db_con, $query)) {
		$datainsert["insertsucess"] = "<p style='color: green;'>¡DISPOSITIVO ACTUALIZADO!</p>";
  		header("Location: index.php?page=all-student&edit=success");
  	} else {
  		header("Location: index.php?page=all-student&edit=error");
	}
}
?>

<h1 style="color: #2d2d2d;"><i class="fas fa-network-wired"></i>  Editar dispositivo</h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los dispositivos </a></li>
     <li class="breadcrumb-item active" aria-current="page">Editar dispositivo</li>
  </ol>
</nav>

<?php
if (isset($id)) {
	$query = "SELECT `id`, `nd`, `lugar`, `ip`, `datetime` FROM `dispositivos` WHERE `id`=$id";
	$result = mysqli_query($db_con, $query);
	$row = mysqli_fetch_array($result);
}
?>

<div class="row">
	<div class="col-sm-6">
		<form action="" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nd">Nombre del dispositivo</label>
		    <input name="nd" type="text" class="form-control" id="nd" value="<?php echo $row['nd']; ?>" required="">
	  	</div>

	  	<div class="form-group">
		    <label for="ip">Dirección IP</label>
		    <input name="ip" type="text" class="form-control" id="ip" value="<?php echo $row['ip']; ?>" required="">
	  	</div>
		
	  	<div class="form-group">
		    <label for="lugar">Lugar</label>
		    <select name="lugar" class="form-control" id="lugar" required="" value="">
		    	<option>Seleccionar</option>
		    	<option value="1st" <?= $row['lugar']=='Cocina'? 'selected':'' ?>>Cocina</option>
		    	<option value="2nd" <?= $row['lugar']=='Sala'? 'selected':'' ?>>Sala</option>
		    	<option value="3rd" <?= $row['lugar']=='Estancia'? 'selected':'' ?>>Estancia</option>
		    	<option value="4th" <?= $row['lugar']=='Cuarto'? 'selected':'' ?>>Cuarto</option>
		    	<option value="5th" <?= $row['lugar']=='Patio'? 'selected':'' ?>>Patio</option>
		    </select>
	  	</div>
		
	  	<div class="form-group text-center">
		    <input name="actualizardispositivo" value="Actualizar" type="submit" class="btn btn-danger">
	  	</div>
	 	</form>
	</div>
</div>