<body class="g-sidenav-show bg-gray-100">
  <!-- Background -->
  <div class="min-height-300 bg-dark position-absolute w-100"></div>

  <!-- Sidebar -->
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html" target="_blank">
        <img src="<?= BASEURL; ?>/img/logo.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Kopi Pos</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="<?= BASEURL; ?>/dashboard/index">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-tachometer-alt text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
       <li class="nav-item">
          <a
            href="#"
            class="nav-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#produk-dropdown"
            aria-expanded="false"
            aria-controls="produk-dropdown"
          >
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-basket text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Produk</span>
          </a>
          <ul
            id="produk-dropdown"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidenav-collapse-main"
          >
            <li class="sidebar-item">
              <a href="<?= BASEURL; ?>/admin/makanan" class="sidebar-link">Makanan</a>
            </li>
            <li class="sidebar-item">
              <a href="<?= BASEURL; ?>/admin/minuman" class="sidebar-link">Minuman</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASEURL; ?>/datauser/index">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-users text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">User account</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASEURL; ?>/akunkasir/index">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-id-badge text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kasier Account</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASEURL; ?>/laporan/index">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-file-alt text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan Transaksi</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASEURL; ?>/profil/index">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= BASEURL; ?>/Logout">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-sign-out-alt text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="<?= BASEURL; ?>/img/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">ada masalah?</h6>
            <p class="text-xs font-weight-bold mb-0">Silahkan Hubungi Kami</p>
          </div>
        </div>
      </div>
      <a href="https://facebook.com/nyokcoffee" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Facebook</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://instagram.com/nyokcoffee" type="button">Instagram</a>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">