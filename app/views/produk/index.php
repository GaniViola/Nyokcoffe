<div class="product-container">
    <!-- Card Produk 1 -->
    <?php foreach($data['minuman'] as $minuman) : ?>
    <div class="product-card">
        <img src="<?= BASEURL . '/uploads/' . $minuman['gambar']; ?>" alt="Gambar Produk 1" class="product-image">
        <h3 class="product-name"><?= $minuman['nama_produk']; ?></h3>
        <p class="product-size"><?= $minuman['nama_ukuran']; ?></p>
        <p class="product-price">Rp <?= number_format($minuman['harga'], 2, ',', '.'); ?></p>
        <div class="product-actions">
            <a href="#" class="add-to-cart">Add to Cart</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
