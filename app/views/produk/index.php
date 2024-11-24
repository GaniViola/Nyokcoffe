<div class="product-container">
    <!-- Card Produk Minuman -->
    <?php foreach($data['minuman'] as $minuman) : ?>
    <div class="product-card">
        <img src="<?= BASEURL . '/uploads/' . $minuman['gambar']; ?>" alt="Gambar Produk Minuman" class="product-image">
        <h3 class="product-name"><?= $minuman['nama_produk']; ?></h3>
        <p class="product-size">Ukuran: <?= $minuman['nama_ukuran']; ?></p>
        <p class="product-price">Rp <?= $minuman['harga']; ?></p>
        <div class="product-actions">
            <a href="#" class="buy-now">Beli Sekarang</a>
            <a href="#" class="add-to-cart">Tambahkan ke Keranjang</a>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Card Produk Makanan -->
    <?php foreach($data['makanan'] as $makanan) : ?>
    <div class="product-card">
        <img src="<?= BASEURL . '/uploads/' . $makanan['gambar']; ?>" alt="Gambar Produk Makanan" class="product-image">
        <h3 class="product-name"><?= $makanan['nama_produk']; ?></h3>
        <p class="product-price">Rp <?= $makanan['harga']; ?></p>
        <div class="product-actions">
            <a href="#" class="buy-now">Beli Sekarang</a>
            <a href="#" class="add-to-cart">Tambahkan ke Keranjang</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
