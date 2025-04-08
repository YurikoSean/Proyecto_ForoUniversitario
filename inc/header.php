
<header class="p-3 mb-3 border-bottom colorBarra">
  <div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between">
      
      <!-- Sección Izquierda: Título Foro Universitario alineado a la izquierda -->
      <h1 class="navbar-brand fs-3 fw-bold text-primary ms-3 h1-tecno">Foro_Universitario</h1>

      <!-- Sección Centro: Barra de búsqueda + Crear Post (centrados) -->
      <div class="d-flex flex-grow-1 justify-content-center">
        <form class="mx-3 w-50" role="search">
          <input type="search" class="form-control" placeholder="Buscar..." aria-label="Search">
        </form>
        <a href="func/nuevoPost.php" class="btn btn-primary">Crear Post</a>
      </div>

      <!-- Sección Derecha: Imagen y Menú desplegable alineados a la derecha -->
      <div class="d-flex align-items-center me-3">
        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis link-primary text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../assets/img/robot_foro.png" alt="Usuario" width="55" height="40" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="//localhost/proyecto_forouniversitario/vistas/perfil/configuracion.php">Configuración</a></li>
            <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</header>