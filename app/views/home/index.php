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
 <section id="hero">
      <div class="wrap">
        <div class="text">
          <h2 class="sec-title">NyokCoffee</h2>
          <p class="desc">
            Where the warmth of a rural ambiance meets premium coffee flavors,
            offering an authentic and delightful coffee experience.
          </p>
        </div>
      </div>
    </section>

    <section id="motto">
      <div class="wrap">
        <div>
          <h3>
            We believe in creating a welcoming space where every cup of coffee
            brings people together and fosters a sense of community.
          </h3>
          <p>Farhan Maulana, Director of KopiPos</p>
        </div>
        <div>
          <img src="<?= BASEURL; ?>/img/Owner.jpg"  alt="" />
        </div>
      </div>
    </section>

    <section id="offers">
      <div class="wrap">
        <h3>We offers a cozy and welcoming space, perfect for students.</h3>
        <p>
          Enjoy our comfortable seating, free Wi-Fi, and a quiet atmosphere
          ideal for studying, meeting friends, or taking a break with a
          delicious cup of coffee.
        </p>
      </div>
    </section>

    <section id="testimonial">
      <div class="wrap">
        <h2 class="sec-title">What They Say About Us</h2>
        <div class="slider">
          <button class="prev">
            <i class="fas fa-chevron-left"></i>
          </button>
          <div class="slider-wrapper">
            <div class="slide">
              <div class="card">
                <p>
                  ‟Absolutely love this place! The coffee is rich and flavorful,
                  and the cozy atmosphere is perfect for unwinding. Friendly
                  staff too - highly recommended!”
                </p>
                <h5>Farhan Maulana</h5>
              </div>
              <div class="card">
                <p>
                  ‟This café has become my go-to spot. Expertly crafted drinks
                  and an inviting ambiance make it a delightful experience every
                  time.”
                </p>
                <h5>Abi Qhafari</h5>
              </div>
            </div>
            <div class="slide">
              <div class="card">
                <p>
                  ‟As a coffee connoisseur, I'm thrilled with the outstanding
                  selection of premium blends here. The cozy setting and
                  welcoming staff keep me coming back.”
                </p>
                <h5>Muhammad Hamdani</h5>
              </div>
              <div class="card">
                <p>
                  ‟Stepping into this café is like finding an oasis of calm. The
                  exceptional coffee and inviting vibe make it the perfect spot
                  to unwind.”
                </p>
                <h5>MD. Adhyaksa</h5>
              </div>
            </div>
            <div class="slide">
              <div class="card">
                <p>
                  ‟Love the cozy vibe and amazing coffee at Tani Kopi! A perfect
                  spot to unwind after a long day.”
                </p>
                <h5>Abdi Gunawan</h5>
              </div>
              <div class="card">
                <p>
                  ‟A hidden gem! Tani Kopi offers the perfect blend of comfort
                  and quality. Highly recommend.”
                </p>
                <h5>MD. Agus</h5>
              </div>
            </div>
          </div>
          <button class="next">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </section>

    <section id="map">
      <div class="wrap">
        <h2 class="sec-title">Find Us on Maps</h2>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.875774784615!2d113.81134647368451!3d-7.908043992115143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6dd5d5b282879%3A0x8236e086c2ac0724!2sNyok%20Cafe!5e0!3m2!1sen!2sid!4v1732458385683!5m2!1sen!2sid" 
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
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

<main>
      <div class="wrap">
        
        <h2 class="title">Contact Us</h2>
        
        <div class="contact">
          <div class="form">
            <div class="name">
              <label>Name</label>
              <input placeholder="Your name"/>
            </div>
            <div class="email">
              <label>Email</label>
              <input placeholder="example@mail.com"/>
            </div>
            <div class="msg">
              <label>Messages</label>
              <textarea placeholder="Use your wise word here..."></textarea>
            </div>
            <button class="submit">Send <i class="fas fa-paper-plane"></i></button>
          </div>
          <div class="img"></div>
        </div>

      </div>
    </main>