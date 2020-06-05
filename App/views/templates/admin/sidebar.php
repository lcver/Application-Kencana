  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?=BASEURL?>vendor/almasaeed2010/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=BASEURL?>vendor/almasaeed2010/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Guru sidebar -->
          <?php if($_SESSION['kencana_rolesession']==2): ?>
            <li class="nav-item">
              <a href="<?=BASEURL?>guru" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-header">DATA</li>
            <li class="nav-item">
              <a href="<?=BASEURL?>guru/bank_soal" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Bank Soal
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=BASEURL?>guru/list_kelas" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Daftar Kelas
                </p>
              </a>
            </li>
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Important</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Warning</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Informational</p>
              </a>
            </li>
          <!-- Tata Usaha sidebar -->
          <?php elseif($_SESSION['kencana_rolesession']==3) : ?>
            <li class="nav-item">
              <a href="<?=BASEURL?>administration" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Tambah User
                </p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview ml-2">
                <li class="nav-item">
                  <a href="<?=BASEURL?>administration/tambah_guru" class="nav-link">
                    <i class="nav-icon fas fa-graduation-cap"></i>
                    <p>
                      Guru
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=BASEURL?>administration/tambah_siswa" class="nav-link">
                    <i class="nav-icon fas fa-glasses"></i>
                    <p>
                      Siswa
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>