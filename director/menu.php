<?php
  

$_SESSION["IDEN"] = '1002491546';
$_SESSION["NOMB"] = 'OISMER SEHUANES GUZMAN';
$_SESSION["ROLE"] = 'J';

if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "J"){
?>

<div class="navbar-fixed">
<div class="navbar-fixed">
<nav>  
  <div class="nav-wrapper" style="background-color: orange;">
    <a href="" class="brand-logo" style="margin-left: 10px;font-size: 1em;">PROYECTOS INEX</a>
    <a href="" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
    <li><a class="dropdown-trigger" href="" data-target="dropdown1">
        LIDER
        <i class="material-icons right">arrow_drop_down</i>
        </a> 
    </li>
    </ul>
  </div> 

</nav> 
</div>

<nav class="hide-on-med-and-down">  
<div class="nav-wrapper" style="background-color: white; ">
<ul class="left hide-on-med-and-down" style="">

<li><a class="black-text" id="mnuProy" style="font-size: 0.8em; text-align: center; height: 64px;" href="lista_proyectos.php" >
  <i class="material-icons teal-text " style="height: 16px; line-height: 48px;">account_balance</i>Proyectos
</a></li>
<li><a class="black-text" id="mnuProy" style="font-size: 0.8em; text-align: center; height: 64px;" href="coordinadores.php" >
  <i class="material-icons teal-text " style="height: 16px; line-height: 48px;">supervisor_account</i>Coordinadores
</a></li>

</ul>
</div>
</nav>

<ul id="dropdown1" class="dropdown-content dropdown-menu">
  <li><a href="#modalUsuario" class="modal-trigger" Onclick="">
    <i class="material-icons black-text " >account_circle</i><?php echo $_SESSION["NOMB"]; ?></a></li>
  <li class="divider"></li>
  <li><a href="../config/cerrar.php"><i class="material-icons black-text">lock</i>Cerrar Sesión</a></li>
</ul>
</div>

<ul  id="mobile-demo" class="sidenav">
<li style="padding-left: 10px; background-color: #757575;">
  <div style="color: white; font-size: 0.8em; font-weight: 500;">
  <?php echo $_SESSION["NOMB"]; ?>
  </div>
<li><a href="javascript: $('.sidenav').sidenav('close');"  style="padding-left: 16px;">
	<i class="material-icons teal-text ">account_balance</i>Proyectos</a>
</li>

<li class="divider"></li>
<li><a href="../config/cerrar.php" style="padding-left: 16px;">
  <i class="material-icons teal-text">lock</i>Cerrar Sesión</a>
</li>
</ul>

<!--
<div class="row">
    <div class="col s6 m2 center" style="padding: 8px;">
      <i class="material-icons blue-text" style="">account_balance</i><div class="optionMenu">Construccción</div>
    </div>
    <div class="col s6 m2 center" style="padding: 8px;">
      <i class="material-icons orange-text" style="">account_balance</i><div class="optionMenu">Pendientes</div>
    </div>
    <div class="col s6 m2 center" style="padding: 8px;">
      <i class="material-icons teal-text" style="">account_balance</i><div class="optionMenu">Desarrollo</div>
    </div>
    <div class="col s6 m2 center" style="padding: 8px;">
      <i class="material-icons grey-text" style="">group</i><div class="optionMenu">Terminados</div>
    </div>

  </div>
--> 
<?php
}else{
	session_destroy();
	header('location: ../');
}
?>