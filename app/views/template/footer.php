<!-- Footer -->
<footer class="footer">
  <div class="footer_container bd-container">
    <!-- Kolom 1: Logo dan Deskripsi -->
    <div class="footer_section logo-section">
      <div class="footer_logo-container">
        <img src="<?= BASEURL; ?>/img/logoo.png" alt="Nyok Coffee" class="footer_logo-img">
        <div class="footer_logo-text">
          <h3 class="footer_logo-name">Nyok Coffee</h3>
          <p class="footer_logo-slogan">Nikmati kopi terbaik bersama kami.</p>
        </div>
      </div>
      <p class="footer_description">
        Kami menghadirkan rasa kopi autentik yang dibuat dari biji pilihan dengan cinta untuk setiap cangkir Anda. Coba sekarang!
      </p>
    </div>

    <!-- Kolom 2: Navigasi -->
    <div class="footer_section nav-section">
      <h3 class="footer_title">Navigasi</h3>
      <ul class="footer_links">
        <li><a href="<?= BASEURL; ?>" class="footer_link"><i class="fas fa-home footer_nav-icon"></i> Beranda</a></li>
        <li><a href="#about" class="footer_link"><i class="fas fa-users footer_nav-icon"></i> Tentang Kami</a></li>
        <li><a href="#product" class="footer_link"><i class="fas fa-coffee footer_nav-icon"></i> Produk</a></li>
        <li><a href="#contact" class="footer_link"><i class="fas fa-envelope footer_nav-icon"></i> Kontak</a></li>
      </ul>
    </div>

    <!-- Kolom 3: Hubungi Kami -->
    <div class="footer_section contact-section">
      <h3 class="footer_title">Hubungi Kami</h3>
      <ul class="footer_contact">
        <li><i class="fas fa-map-marker-alt footer_icon"></i> Bondowoso, Jawa Timur</li>
        <li><i class="fas fa-phone-alt footer_icon"></i> <a href="tel:+6281234567890" class="footer_contact-link">+62 812-3456-7890</a></li>
        <li><i class="fas fa-envelope footer_icon"></i> <a href="mailto:info@nyokcoffee.com" class="footer_contact-link">info@nyokcoffee.com</a></li>
        <li><i class="fas fa-clock footer_icon"></i> Jam Buka: Senin - Jumat, 09:00 - 18:00</li>
      </ul>
    </div>

    <!-- Kolom 4: Ikuti Kami -->
    <div class="footer_section social-section">
      <h3 class="footer_title">Ikuti Kami</h3>
      <div class="footer_social-icons">
        <a href="https://facebook.com/nyokcoffee" class="social-icon facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com/nyokcoffee" class="social-icon instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://twitter.com/nyokcoffee" class="social-icon twitter" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://youtube.com/nyokcoffee" class="social-icon youtube" title="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <!-- Hak Cipta -->
  <div class="footer_bottom">
    <p class="footer_copy">&copy; <?= date('Y'); ?> Nyok Coffee. Semua hak dilindungi.</p>
  </div>
</footer>
