<?php 
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$no_uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$folder_admin."/";
 ?>

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">My Presensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

           <li class="nav-item">
            <a href="index.php" class="nav-link <?php  if( (strpos($actual_link, 'index.php') || $actual_link==$no_uri) !== false ) echo 'active'; ?> ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <!-- menu-open -->
          <li class="nav-item has-treeview <?php  if( strpos($actual_link, 'jabatan.php' ) !== false || strpos($actual_link, 'karyawan.php' ) !== false ) echo 'menu-open'; ?>">
            <!-- active -->
            <a href="#" class="nav-link <?php  if( strpos($actual_link, 'jabatan.php' ) !== false || strpos($actual_link, 'karyawan.php' ) !== false ) echo 'active'; ?>">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <!-- active -->
                <a href="jabatan.php" class="nav-link <?php  if( strpos($actual_link, 'jabatan.php' ) !== false ) echo 'active'; ?>"> 
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="karyawan.php" class="nav-link <?php  if( strpos($actual_link, 'karyawan.php' ) !== false ) echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="presensi.php" class="nav-link <?php  if( strpos($actual_link, 'presensi.php' ) !== false ) echo 'active'; ?>">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Presensi
              </p>
            </a>
          </li>
           <!-- menu-open -->
          <li class="nav-item has-treeview <?php  if( strpos($actual_link, 'rekaper.php' ) !== false ) echo 'menu-open'; ?>">
            <!-- active -->
            <a href="#" class="nav-link <?php  if( strpos($actual_link, 'rekaper.php' ) !== false ) echo 'active'; ?>">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <!-- active -->
                <a href="rekaper.php" class="nav-link <?php  if( strpos($actual_link, 'rekaper.php' ) !== false ) echo 'active'; ?>"> 
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Presensi</p>
                </a>
              </li>
            </ul>
          </li>
          <div style="height: 100vh;"></div>
  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>