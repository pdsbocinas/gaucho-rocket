<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php
      if ($_SESSION['rol'] == 'admin') {
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href=" . $path->getEvent('admin', 'index') . ">Admin</a>";
        echo "</li>";
      }
    ?>
    </ul>
    <div class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Login
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
        if (isset($_SESSION['nombre_de_usuario'])) {
          echo "Bienvenido:" . $_SESSION['nombre_de_usuario'] . "";
        } else {
          include("form.php");
          echo "<p>" . $data . "</p>";
        }
        ?>
      </div>
    </div>
  </div>
</nav>