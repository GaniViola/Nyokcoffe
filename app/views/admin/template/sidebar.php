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
        <i class="lni lni-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target="#auth"
              aria-expanded="false"
              aria-controls="auth"
            >
            <i class="lni lni-package"></i>
              <span>Produk</span>
            </a>
            <ul
              id="auth"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a href="<?= BASEURL; ?>/admin/makanan" class="sidebar-link">Makanan</a>
              </li>
              <li class="sidebar-item">
                <a href="<?= BASEURL; ?>/admin/minuman" class="sidebar-link">Minuman</a>
              </li>
            </ul>
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
        <!-- Profile with icon -->
        <li><a class="dropdown-item" href="<?= BASEURL ?>/admin/Profil">
            <i class="fas fa-user me-2"></i>Profile</a>
        </li>

        <!-- Settings with icon -->
        <li><a class="dropdown-item" href="#">
            <i class="fas fa-cogs me-2"></i>Settings</a>
        </li>

        <li><hr class="dropdown-divider" /></li>

        <!-- Logout with icon -->
        <li><a class="dropdown-item" href="#">
            <i class="fas fa-sign-out-alt me-2"></i>Logout</a>
        </li>
    </ul>
</div>

          </div>
        </div>
      </div>
    </nav>