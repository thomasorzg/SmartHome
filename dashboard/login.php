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

if(isset($_SESSION["user_login"])) {
	header("Location: index.php");
}

if(isset($_POST["login"])) {
	$nombredeusuario = $_POST["nombredeusuario"];
	$contraseña = $_POST["contraseña"];

	$input_arr = array();

	if(empty($nombredeusuario)) {
		$input_arr["input_user_error"] = "Por favor, escribe tú nombre de usuario...";
	}

	if(empty($contraseña)) {
		$input_arr["input_pass_error"] = "Por favor, escribe tú contraseña...";
	}

	if(count($input_arr) == 0) {
		$query = "SELECT * FROM `usuarios` WHERE `nombredeusuario` = '$nombredeusuario';";
		$result = mysqli_query($db_con, $query);
		
		if(mysqli_num_rows($result)==1) {
			$row = mysqli_fetch_assoc($result);
			
			if($row["contraseña"] == sha1(md5($contraseña))) {
				if($row["estado"] == "activo") {
					$_SESSION["user_login"] = $nombredeusuario;
					header("Location: index.php");
				} else {
					$status_inactive = "Estado inactivo";
				}
			} else {
				$worngpass= "¡Contrase incorrecta!";	
			}
		} else {
			$usernameerr= "¡El nombre de usuario no ha sido encontrado!";
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
	<title>Iniciar sesión</title>
	<link rel="shortcut icon" href="../assets/images/icon.png" type="image/pgn">

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
</head>
<body>
	<div class="container">
		<br>
		<center><img src="../assets/images/logo.png" alt="SmartHome" width="215px" height="140px"></center>
		<hr>
		<h1 class="text-center" style="color: white;">Iniciar sesión</h1>
		<h5 class="text-center" style="color: white;">Por favor ingresa tus datos para ingresar: </h3>
		<br>
		<div class="d-flex justify-content-center">
			<!-- 1 -->
			<?php if(isset($usernameerr)) { ?>
			
			<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000">
				<?php echo $usernameerr; ?>
			</div>

			<?php }; ?>
			<!-- /1 -->

			<!-- 2 -->
			<?php if(isset($$worngpass)) { ?>
			
			<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000">
				<?php echo $$worngpass; ?>
			</div>

			<?php }; ?>
			<!-- /2 -->

			<!-- 3 -->
			<?php if(isset($status_inactive)) { ?>
			
			<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000">
				<?php echo $status_inactive; ?>
			</div>

			<?php }; ?>
			<!-- /3 -->
		</div>
		<div class="row animate__animated animate__pulse">
			<div class="col-md-4 offset-md-4">
				<form action="" method="post">
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="nombredeusuario" value="<?= isset($nombredeusuario)? $nombredeusuario: ""; ?>" placeholder="Nombre de usuario" id="inputEmail3">
							<?php echo isset($input_arr["input_user_error"])? "<label style='color: red;'>".$input_arr["input_user_error"]."</label>":""; ?>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-12">
							<input type="password" class="form-control" name="contraseña" placeholder="Contraseña" id="inputPassword3">
							<?php echo isset($input_arr["input_pass_error"])? "<label style='color: red;'>".$input_arr["input_pass_error"]."</label>":""; ?>
						</div>
					</div>

					<div class="text-center">
						<button type="submit" name="login" class="btn btn-success">ACCEDER</button>
						<hr>
						<p style="color: white;">¿No tienes una cuenta? <a href="register.php" style="color: #00c45d;">¡Regístrate ahora!</a></p>
					</div>
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