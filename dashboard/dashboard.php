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
?>

<h1><a href="index.php" style="color: #2d2d2d;"><i class="fas fa-tachometer-alt"></i>  Dashboard</a></h1>

<hr>

<div class="row student">
  <div class="col-sm-4">
    <div class="card text-white bg-primary mb-3" style="background-color: #ffc107!important;">

      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fas fa-network-wired fa-3x"></i>
          </div>

          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px"><?php $stu = mysqli_query($db_con, "SELECT * FROM `dispositivos`"); $stu = mysqli_num_rows($stu); echo $stu; ?></span></div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Dispositivos registrados</div>
          </div>
        </div>
      </div>

      <div class="list-group-item-primary list-group-item list-group-item-action">
        <div class="row">

          <div class="col-sm-8">
            <p class="">Ver más</p>
          </div>

          <div class="col-sm-4">
            <a href="all-student.php"><i class="fa fa-arrow-right float-sm-right"></i></a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-info mb-3">
      <div class="card-header">
        <div class="row">

          <div class="col-sm-4">
            <i class="fa fa-users fa-3x"></i>
          </div>

          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px"><?php $tusers = mysqli_query($db_con, "SELECT * FROM `usuarios`"); $tusers = mysqli_num_rows($tusers); echo $tusers; ?></span></div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Usuarios registrados</div>
          </div>

        </div>
      </div>

      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="index.php?page=all-users">
          <div class="row">
            <div class="col-sm-8">
              <p class="">Ver más</p>
            </div>
            
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<h3 style="color: #2d2d2d;">Últimos dispositivos registrados: </h3>

<h5 style="color: #bd2130;">
<?php 
$query = mysqli_query($db_con, "SELECT * FROM `dispositivos` ORDER BY `dispositivos`.`datetime` DESC;");
$i = 1;

while($result = mysqli_fetch_array($query)) {
  echo "<hr>".ucwords($result["nd"]);
  $i++; 
} 
?>
</h5>