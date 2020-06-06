  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="<?=BASEURL?>vendor/almasaeed2010/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Kencana</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <!-- <ul class="navbar-nav"></ul> -->
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <?=isset($_SESSION['kencana_namasession']) ? $_SESSION['kencana_namasession'] : ""?>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=BASEURL?>auth/logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- /.navbar -->