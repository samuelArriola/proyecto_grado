<nav>
  <div class="nav-wrapper" style="background-color: orange;">
    <a href="#!" class="brand-logo" style="margin-left: 4px;font-size: 1em;">PROYECTOS - INEX</a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
        ADMINISTRADOR
        <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    </ul>
  </div>
</nav> 
<ul id="dropdown1" class="dropdown-content dropdown-menu">
  <li style="padding: 4px;"><?php echo $_SESSION["NOMB"]; ?></li>
  <li class="divider"></li>
  <li><a href="../config/cerrar.php"><i class="material-icons black-text">lock</i>Cerrar Sesión</a></li>
</ul>

<nav class="hide-on-med-and-down">
  <div class="nav-wrapper" style="background-color: white; ">
    <ul class="left hide-on-med-and-down">
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-trigger black-text" href="" data-target="menu1">
      	<i class="material-icons left teal-text">store</i>
      	Componentes
      	<i class="material-icons right grey-text">arrow_drop_down</i></a>
      </li>
    </ul>
    </ul>
  </div>
</nav>

<!-- Menu componentes -->
<ul id="menu1" class="dropdown-content dropdown-menu">
  <li><a href="javascript: enlace(1)"><i class="material-icons black-text">account_circle</i>Coordinadores</a></li>
  <li><a href="javascript: enlace(2)"><i class="material-icons black-text">work</i>Proyectos</a></li>
  <li><a href=""><i class="material-icons black-text">local_library</i>Reportes</a></li>
</ul>


<ul  id="mobile-demo" class="sidenav">
    <li style="padding-left: 10px; color: orange; font-size: 0.8em; font-weight: 500;">
      <?php echo $_SESSION["NOMB"]; ?>
    </li>
    <li class="divider"></li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header"><i class="material-icons teal-text" style="font-size: 1.8em;">store</i>
              Componentes
              <i class="material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a class="sidenav-close" href=""><i class="material-icons black-text">account_circle</i>Coordinadores</a></li>
                <li><a class="sidenav-close" href=""><i class="material-icons black-text">work</i>Proyectos</a></li>
                <li><a class="sidenav-close" href=""><i class="material-icons black-text">local_library</i>Reportes</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <li class="divider"></li>
      <li><a href="../config/cerrar.php" style="padding-left: 16px;"><i class="material-icons teal-text">lock</i>Cerrar Sesión</a></li>
    </ul>