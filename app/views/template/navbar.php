<header class="l-header" id="header">
  <nav class="nav bd-container">
    <div class="nav_toggle" id="nav-toggle">
      <i class="bx bx-menu"></i>
    </div>
    <a href="#" class="nav_logo">
      <img src="logo.png" alt="" class="logo-img" />
      <span class="logo-text">Nyok coffe</span>
    </a>
    <div class="nav_menu" id="nav-menu">
      <ul class="nav_list">
        <li class="nav_item">
          <a href="#" class="nav_link active-link"
            >Home</a
          >
        </li>
        <li class="nav_item">
          <a href="#/about" class="nav_link"
            >About</a
          >
        </li>
        <li class="nav_item">
          <a href="#quality" class="nav_link">Quality</a>
        </li>
        <li class="nav_item">
          <a href="#product" class="nav_link">Product</a>
        </li>
        <li class="nav_item">
          <a href="#contact" class="nav_link">Contact</a>
        </li>
      </ul>
    </div>
    <div class="nav_icons">
        <a href="#" class="nav_user">
            <i class="bx bx-user"></i>
        </a> <!-- Added class "nav_user" -->
    <a href=""><i class='bx bx-heart'></i></a>
    <a href=""><i class="bx bx-shopping-bag"></i></a>
</div>
  </nav>
</header>

<!-- Popup Login Modal -->
<div class="modal" id="loginModal">
  <div class="modal_content">
    <span class="close" id="closeModal">&times;</span>
    <h2>Login</h2>
    <span>Silahkan login untuk mendapatkan fitur maximal dari website kami</span>
    <p>Belum punya akun? <a href="">daftar</a></p>
    <form action="login.php" method="post">
      <label for="email">Email or Username</label>
      <input type="email" id="email" name="email" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      
      <button type="submit">Login</button>
      <a href="">Lupa kata sandi?</a>
    </form>
  </div>
</div>