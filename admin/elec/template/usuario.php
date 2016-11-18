<?php session_start(); 
?>

<!-- Menu Toggle Button -->
<a href="" class="dropdown-toggle" data-toggle="dropdown">
  <!-- The user image in the navbar-->
  <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
  <!-- hidden-xs hides the username on small devices so only the image appears. -->
  <!--<span class="hidden-xs"><?php echo $nombre; ?></span>-->
</a>
<ul class="dropdown-menu">
  <!-- The user image in the menu -->
  <li class="user-header">
    <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
    <p>
      Administrador
      <small>{{ currentDate | date:'dd-MM-yyyy' }}</small>
    </p>
  </li>
  <!-- Menu Body -->
  <!-- Menu Footer-->
  <li class="user-footer">
    <div class="pull-right">
      <a href="../public" class="btn btn-default btn-flat">Salir</a>
    </div>
  </li>
</ul>