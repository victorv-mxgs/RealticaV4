
      
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Realtica | Panel Administrador</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="panelAdministrador.html">Usuarios Registrados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="propiedadesAdmin.html">Propiedades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rolesAdmin.html">Roles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="extras.html">Extras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="../index.html">Realtica</a>
        </li>
         <?php
             session_start();        
                        if(isset($_SESSION['nombre_usuario'])){
                            echo '
                            </ul>
                            <div class="col-md-3 col-3 text-end">
                            <a href="../perfil.html" class="btn btn-outline-primary me-2">
                             '.$_SESSION['nombre_usuario'].' <span class="caret"></span>
                            </a>
                            <a href="php/salir.php"><button type="button" class="btn btn-primary me-2">
                            Logout</button>
                            </a>
                            </div>
                            ';
                        }
                        else{
                            echo '
                            </ul>
                            <div class="col-md-3 col-3 text-end">
                            <a href="../login.html"class="btn btn-outline-primary me-2">Login</a>
                            <a href="../registro.html"class="btn btn-outline-primary me-2">Sign-up</a>
                           
                            </div>
                            ';
                        }
          ?>    
      </div>
    </div>
  </nav>

