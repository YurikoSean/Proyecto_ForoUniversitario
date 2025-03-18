<!--HEADER DEL PERFIL CON MENÚ-->
<header class="p-3 mb-3 border-bottom colorBarra">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="../index.php" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="" alt="">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li class="nav-item dropdown">
            <a href="#" class="nav-link px-2 link-primary li-text dropdown-toggle" data-bs-toggle="dropdown">Asignaturas</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="posts.php?asignatura=sistemas_informaticos">Sistemas Informáticos</a></li>
                <li><a class="dropdown-item" href="posts.php?asignatura=lenguaje_marcas">Lenguaje de Marcas</a></li>
                <li><a class="dropdown-item" href="posts.php?asignatura=entorno_cliente">Entorno Cliente</a></li>
                <li><a class="dropdown-item" href="posts.php?asignatura=base_datos">Base de Datos</a></li>
              </ul>
          </li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Busqueda..." aria-label="Search">
        </form>

        <div class="dropdown text-end colorwhite">
          <a href="#" class="d-block link-body-emphasis link-primary text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../img/robot_foro.png" alt="mdo" width="55" height="40" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="func/nuevoPost.php">Nuevo post</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="#">Cerrar Sesisón</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>