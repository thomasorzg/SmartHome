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

session_start();

if(isset($_SESSION["user_login"])) {
	$id = base64_decode($_GET["id"]);

	if(mysqli_query($db_con, "DELETE FROM `dispositivos` WHERE `id` = '$id'")) {
		header("Location: index.php?page=all_devices&delete=success");
	} else {
		header("Location: index.php?page=all_devices&delete=error");
	}
} else {
	header("Location: login.php");
}