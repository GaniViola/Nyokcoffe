<header class="l-header" id="header">
  <nav class="nav bd-container">
    <div class="nav_toggle" id="nav-toggle">
      <i class="bx bx-menu"></i>
    </div>
    <a href="<?= BASEURL; ?>" class="nav_logo">
      <img src="<?= BASEURL; ?>/img/logo.png" alt="" class="logo-img" />
      <span class="logo-text">Nyok coffe</span>
    </a>
    <div class="nav_menu" id="nav-menu">
      <ul class="nav_list">
        <li class="nav_item">
          <a href="<?= BASEURL; ?>" class="nav_link active-link"
            >Home</a
          >
        </li>
        <li class="nav_item">
          <a href="#about" class="nav_link"
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
        <?php Flasher::navLogin(); ?>
      </ul>
    </div>
    <div class="nav_icons">
      <?php Flasher::Login(); ?>
    <!-- Added class "nav_user" -->
    <a href=""><i class='bx bx-heart'></i></a>
    <a href="javascript:void(0)" id="cart-btn" class="cart-icon"><i class="bx bx-shopping-bag"></i></a>
</div>
  </nav>
</header>

<!-- Popup Login Modal -->
<div class="modal" id="loginModal">
  <div class="modal_content">
    <span class="close" id="closeModal">&times;</span>
    <h2>Login</h2>
    <span>Silahkan login untuk mendapatkan fitur maximal dari website kami</span>
    <p>Belum punya akun? <a href="<?= BASEURL; ?>/register">daftar</a></p>
    <form action="<?= BASEURL; ?>/login" method="post">
      <label for="EmailorUser">Email or Username</label>
      <input type="text" id="EmailorUser" name="EmailorUser" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
      <a href="">Lupa kata sandi?</a>
    </form>
  </div>
</div>

<!-- keranjang -->
<div id="cart-modal" class="cart-modal">
    <div class="cart-modal-header">
        <h2>Keranjang Belanja</h2>
        <button class="close-btn" id="close-cart">&times;</button>
    </div>
    <div class="cart-modal-content" id="cart-content">
        <!-- Contoh item -->
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <div class="cart-item" data-price="100000">
            <img src="https://via.placeholder.com/60" alt="Produk">
            <div class="item-info">
                <p>Nama Produk</p>
                <p>Rp 100.000</p>
            </div>
            <div class="quantity-controls">
                <button class="btn-decrease">-</button>
                <span class="quantity">1</span>
                <button class="btn-increase">+</button>
            </div>
        </div>
        <!-- Tambahkan item lain di sini -->
    </div>
    <div class="cart-modal-footer">
        <div class="total">
            <span>Total: </span>
            <span id="total-price">Rp 100.000</span>
        </div>
        <button class="checkout-btn">Checkout</button>
    </div>
</div>
