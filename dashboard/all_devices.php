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

<h1 style="color: #2d2d2d;"><i class="fas fa-network-wired"></i>  Todos los dispositivos</h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard </a></li>
     <li class="breadcrumb-item active" aria-current="page">Todos los dispositivos </li>
  </ol>
</nav>

<?php if(isset($_GET["delete"]) || isset($_GET["edit"])) { ?>
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
    if(isset($_GET["delete"])) {
      if($_GET["delete"] == "success") {
        echo "<p style='color: green; font-weight: bold;'>¡DISPOSITIVO ELIMINADO!</p>";
      }  
    }
    if(isset($_GET["delete"])) {
      if($_GET["delete"] == "error") {
        echo "<p style='color: red'; font-weight: bold;>¡DISPOSITIVO NO ELIMINADO!</p>";
      }  
    }
    if(isset($_GET["edit"])) {
      if($_GET["edit"] == "success") {
        echo "<p style='color: green; font-weight: bold; '>¡DISPOSITIVO ACTUALIZADO!</p>";
      }
    }
    if(isset($_GET["edit"])) {
      if($_GET["edit"] == "error") {
        echo "<p style='color: red; font-weight: bold;'>¡DISPOSITIVO NO MODIFICADO!</p>";
      }  
    }
    ?>
  </div>
</div>
<?php } ?>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">LUGAR</th>
      <th scope="col">ACCIÓN</th>
    </tr>
  </thead>

  <tbody>
    <?php 
    $query = mysqli_query($db_con, 'SELECT * FROM `dispositivos` ORDER BY `dispositivos`.`datetime` DESC;');
    $i = 1;
    while ($result = mysqli_fetch_array($query)) { ?>
    <tr>
      <?php 
      echo "<td>".$i."</td>
      <td>".ucwords($result["nd"])."</td>
      <td>".ucwords($result["lugar"]).'</td>
      <td>
      <a class="btn btn-xs btn-warning" href="index.php?page=edit_device&id='.base64_encode($result['id']).'">
      <i class="fa fa-edit"></i></a>

      &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="index.php?page=delete&id='.base64_encode($result['id']).'">
      <i class="fas fa-trash-alt"></i></a></td>';
      ?>
    </tr>  
    <?php $i++; } ?>
  </tbody>
</table>

<script>
function confirmationDelete(anchor) {
  var conf = confirm("¿Está seguro de que desea eliminar este registro?");
  if(conf) {
    window.location=anchor.attr("href");
  }
}
</script>