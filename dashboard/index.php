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

if(!isset($_SESSION["user_login"])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="shortcut icon" href="../assets/images/icon.png" type="image/pgn">

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="../assets/css/solid.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/js/fontawesome.min.js"></script>
  <script src="../assets/js/script.js"></script>
</head>
<body style="background-color: #b3b3b3;">

  <nav class="navbar navbar-expand-lg" style="background-color: #2d2d2d;">
    <img src="../assets/images/logo_h.png" alt="SmartHome" width="235px" height="70px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span></button>

    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
      <?php
      $showuser = $_SESSION["user_login"];
      $haha = mysqli_query($db_con, "SELECT * FROM `usuarios` WHERE `nombredeusuario` = '$showuser';");
      $showrow = mysqli_fetch_array($haha);
      ?>
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=user-profile" style="color: white;">
            <b><i class="fa fa-user"></i> ¡Hola <?php echo $showrow["nombre"]; ?>!</b>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" style="color: #bd2130;">
            <b><i class="fa fa-power-off"></i> Cerrar sesión</b>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <br>

  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="list-group">
          <a href="index.php?page=dashboard" class="list-group-item list-group-item-action active" style="background-color: #00c45d; border-color: #00c45d;">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>
          <a href="index.php?page=add_device" class="list-group-item list-group-item-action">
            <i class="fas fa-laptop-house"></i></i> Añadir nuevo dispositivo
          </a>
          <a href="index.php?page=all_devices" class="list-group-item list-group-item-action">
            <i class="fas fa-network-wired"></i> Todos los dispositivos
          </a>
          <a href="index.php?page=all_users" class="list-group-item list-group-item-action">
            <i class="fa fa-users"></i> Todos los usuarios
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <i class="fa fa-user"></i> Tú <i>(<?php echo $showrow["nombre"]; ?>)</i>
          </a>
        </div>
      </div>
      <div class="col-md-9">
        <div class="content">
          <?php
          if(isset($_GET["page"])) {
            $page = $_GET["page"].".php";
          } else {
            $page = "dashboard.php";
          }

          if(file_exists($page)) {
            require_once $page;
          } else {
            require_once "404.php";
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>

  <footer style="background-color: #bd2130;">
    <div class="container text-center">
      <p>Made with &#10084 by Thomas and Mahatma</p>
    </div>
  </footer>

  <script>
    jQuery(".toast").toast("show");
  </script>

</body>
</html>