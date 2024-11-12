<div class="wrapper">
  <aside id="sidebar">
    <div class="d-flex">
      <button class="toggle-btn" type="button">
        <i class="lni lni-grid-alt"></i>
      </button>
      <div class="sidebar-logo">
        <a href="<?= BASEURL ?>/admin">Nyokcoffe</a>
      </div>
    </div>
    <ul class="sidebar-nav">
      <li class="sidebar-item">
        <a href="#" class="sidebar-link">
          <i class="lni lni-user"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= BASEURL ?>/admin/produk" class="sidebar-link">
          <i class="lni lni-agenda"></i>
          <span>Produk</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="#" class="sidebar-link">
          <i class="lni lni-popup"></i>
          <span>Notification</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="#" class="sidebar-link">
          <i class="lni lni-cog"></i>
          <span>Setting</span>
        </a>
      </li>
    </ul>
    <div class="sidebar-footer">
      <a href="<?= BASEURL; ?>/logout" class="sidebar-link">
        <i class="lni lni-exit"></i>
        <span>Logout</span>
      </a>
    </div>
  </aside>
  <div class="main p-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border shadow-sm rounded">
      <div class="container-fluid">
        <form class="d-flex w-50" role="search">
          <input class="form-control me-2 rounded" type="search" placeholder="Search" aria-label="Search">
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="d-flex align-items-center ms-auto">
            <a href="#" class="nav-link position-relative me-3">
              <i class="lni lni-envelope text-dark fs-4"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">5</span>
            </a>
            <div class="dropdown">
              <a href="#" class="nav-link dropdown-toggle text-dark fw-bold" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['EmailorUser']; ?></a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
