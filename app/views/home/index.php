<!-- Home -->
<main class="l-main">
    <section class="home">
        <div class="home_container bd-container bd-grid">
            <div class="home_data slide">
                <h1 class="home_title">Enjoy your day with Nyok coffee</h1>
                <h2 class="home_subtitle">Menyajikan berbagai menu sepcial food and drik for you</h2>
                <a href="#" class="button">Shop Now</a>  
            </div>
            <img src="<?= BASEURL; ?>/img/homeimg.png" alt="" class="home_img slide-gambar-home">
        </div>
    </section>
</main>
<!-- ============================== -->
 <!-- Tentang kami -->
 <section class="about section bd-container" id="about">
      <div class="about_container bd-grid">
        <div class="about_data">
          <span class="section-subtitle about_initial">About Us</span>
          <h2 class="section-title about_initial">Story of Nyok Coffee</h2>
          <p class="about_description">Nyok Coffee adalah sebuah coffee shop yang berdiri pada tahun 2018 oleh Noval Gustian, seorang pencinta kopi dari Bondowoso, Jawa Timur.</p>
          <a href="#" class="button">Cari Tahu Lebih Lanjut</a>
        </div>
        <img src="<?= BASEURL; ?>/img/about.jpg" alt="Nyok Coffee" class="about_img">
      </div>
    </section>
    <!-- Section Quality -->

    <!-- Section Quality -->
    <section class="quality" id="quality">
      <div class="quality_container">
        <div class="quality_data">
          <h2 class="section-title">Our Quality</h2>
          <p class="quality_description">
          Di Nyok Coffee, kami mengutamakan kualitas biji kopi kami, memastikan bahwa setiap cangkir menghasilkan cita rasa yang kaya dan autentik yang diinginkan para pencinta kopi. Biji kopi kami yang bersumber dari sumber yang baik menjalani pemeriksaan kualitas yang ketat untuk memenuhi standar tinggi kami.
          </p>
          <ul class="quality_list">
            <li class="quality_item">
              <i class="icon fas fa-coffee"></i>
              <h3>Fresh Beans</h3>
              <p>Kami hanya menggunakan biji kopi segar pada tiap penyeduhan, untuk memastikan hasil secangkir kopi yang sempurna setiap saat.</p>
            </li>
            <li class="quality_item">
              <i class="icon fas fa-leaf"></i>
              <h3>Toping</h3>
              <p>Tidak pelit dalam pemberian toping. Kami selalu mementingkan cita dan rasa produk</p>
            </li>
            <li class="quality_item">
              <i class="icon fas fa-heart"></i>
              <h3>Passion for Coffee</h3>
              <p>From farm to cup, our love for coffee shines through every step of the process.</p>
            </li>
          </ul>
        </div>
        <div class="quality_img">
          <img src="img/homeimg.png" alt="Quality Coffee">
        </div>
      </div>
    </section>

    <!-- Produk -->
    <section class="products" id="product">
  <div class="products_container">
    <h2 class="section-title">Produk Kami</h2>
    <p class="section-subtitle">Rasakan kelezatan kopi terbaik kami</p>

    <div class="product_slider">
      <?php foreach ($data['produk'] as $p) : ?>
        <div class="product_item">
          <img src="<?= BASEURL . '/uploads/' . $p['gambar']; ?>" alt="<?= $p['nama_produk']; ?>" class="product_img">
          <h3 class="product_name"><?= $p['nama_produk']; ?></h3>
          <span class="product_price">Rp.<?= $p['harga']; ?></span>
          <div class="product_size">
            <label for="size_select_<?= $p['nama_produk']; ?>">Ukuran:</label>
            <select id="size_select_<?php echo $p['nama_produk']; ?>" class="size_select">
                <option value="<?= $p['nama_ukuran']; ?>"><?= $p['nama_ukuran']; ?></option>
            </select>
          </div>
          <div class="product_buttons">
            <button class="product_button">Beli</button>
            <button class="product_button">Tambah ke Keranjang</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <a href="allproduk" class="button">Show all →</a>
  </div>
</section>