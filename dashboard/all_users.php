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

<h1 style="color: #2d2d2d;"><i class="fas fa-users"></i>  Todos los usuarios</h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard </a></li>
     <li class="breadcrumb-item active" aria-current="page">Todos los usuarios</li>
  </ol>
</nav>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">NOMBRE DE USUARIO</th>
      <th scope="col">ESTADO</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $query = mysqli_query($db_con, 'SELECT * FROM `usuarios`');
    $i = 1;
    while($result = mysqli_fetch_array($query)) { ?>
    <tr>
      <?php 
      echo "<td>".$i."</td>
      <td>".ucwords($result["nombre"])."</td>
      <td>".ucwords($result["nombredeusuario"]).'</td>
      <td>'.$result['estado'].'</td>';?>
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