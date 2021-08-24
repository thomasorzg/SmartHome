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

require_once "db_con.php";

session_start();

if(isset($_POST["register"])) {
	$nombre = $_POST["nombre"];
	$nombredeusuario = $_POST["nombredeusuario"];
	$contraseña = $_POST["contraseña"];
	$c_contraseña = $_POST["c_contraseña"];

	$input_error = array();

	if(empty($nombre)) {
		$input_error["nombre"] = "Por favor, escribe tú nombre...";
	}
	if(empty($nombredeusuario)) {
		$input_error["nombredeusuario"] = "Por favor, escribe un nombre de usuario...";
	}
	if(empty($contraseña)) {
		$input_error["contraseña"] = "Por favor, escribe una contraseña segura...";
	}
	if(!empty($contraseña)) {
		if($c_contraseña !== $contraseña) {
			$input_error["notmatch"] = "Las contraseñas no coinciden &#128528;";
		}
	}
	if(count($input_error) == 0) {
		$check_username = mysqli_query($db_con, "SELECT * FROM `usuarios` WHERE `nombredeusuario`='$nombredeusuario';");
		if(mysqli_num_rows($check_username) == 0) {
			if(strlen($nombredeusuario) > 7) {
				if(strlen($contraseña) > 7) {
					$contraseña = sha1(md5($contraseña));
					$query = "INSERT INTO `usuarios`(`nombre`, `nombredeusuario`, `contraseña`, `estado`) VALUES ('$nombre', '$nombredeusuario', '$contraseña', 'inactivo');";
					$result = mysqli_query($db_con, $query);
					if($result) {
						header("Location: register.php?insert=sucess");
					} else {
						header("Location: register.php?insert=error");
					}
					} else {
						$passlan="Al parecer está contraseña tiene más de 8 caracteres &#128528;...";
					}
				} else {
					$usernamelan= "El nombre de usuario es muy largo &#128528;...";
				}
			} else {
				$username_error="Al parecer este nombre de usuario ya está en uso &#128533;...";
			}	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
	<link rel="shortcut icon" href="../assets/images/icon.png" type="image/pgn">
	
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
</head>
<body>
	<div class="container">
		<br>
		<h1 class="text-center" style="color: white;">Registro</h1>
		<hr>
		<br>
		<div class="d-flex justify-content-center">
			<?php 
			if(isset($_GET["insert"])) {
				if($_GET["insert"] == "sucess") {
					echo "<div role='alert' aria-live='assertive' aria-atomic='true' align='center' class='toast alert alert-success fade hide' data-delay='2000'>¡Has sido registrado!</div>";
				}
          	};
			?>
		</div>
		<div class="row animate__animated animate__pulse">
			<div class="col-md-8 offset-md-2">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group row">
				    	<div class="col-sm-6">
				      		<input type="text" class="form-control" value="<?= isset($nombre)? $nombre:'' ?>" name="nombre" placeholder="Nombre" id="inputEmail3">
							<?= isset($input_error["nombre"])? "<label for='inputEmail3' class='error'>".$input_error["nombre"]."</label>":""; ?>
				    	</div>
				  	</div>
					
				  	<div class="form-group row">
				  		<div class="col-sm-4">
				      		<input type="text" name="nombredeusuario" value="<?= isset($nombredeusuario)? $nombredeusuario:"" ?>" class="form-control" id="inputPassword3" placeholder="Nombre de usuario"><?= isset($input_error['nombredeusuario'])? '<label class="error">'.$input_error['nombredeusuario'].'</label>':'';  ?><?= isset($username_error)? '<label class="error">'.$username_error.'</label>':'';  ?><?= isset($usernamelan)? '<label class="error">'.$usernamelan.'</label>':'';  ?>
				    	</div>
				    	<div class="col-sm-4">
				      		<input type="password" name="contraseña" class="form-control" id="inputPassword3" placeholder="Contraseña"><?= isset($input_error['contraseña'])? '<label class="error">'.$input_error['contraseña'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>  
				    	</div>
				    	<div class="col-sm-4">
				      		<input type="password" name="c_contraseña" class="form-control" id="inputPassword3" placeholder="Confirmar contraseña"><?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>
				    	</div>
				  	</div>
					  <button type="submit" name="register" class="btn btn-danger">Registrarme</button>
						<hr>
						<p style="color: white;">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>

				</form>
            </div>
		</div>
    </div>

	<footer style="background-color: #bd2130;">
		<div class="container text-center">
			<p>Made with &#10084 by Thomas and Mahatma</p>
    	</div>
  	</footer>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
    	$(".toast").toast("show");
    </script>

</body>
</html>