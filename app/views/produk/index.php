<div class="wrap">
    <h2 class="title">Our Menu</h2>

    <!-- Navigasi Kategori -->
    <div class="menu-categories">
        <a href="#" class="category-link active" data-category="all">View All</a>
        <a href="#" class="category-link" data-category="drink-card">Minuman</a>
        <a href="#" class="category-link" data-category="food-card">Makanan</a>
    </div>

    <!-- Container Produk -->
    <div class="product-container">
        <!-- Card Produk Minuman -->
        <?php foreach($data['minuman'] as $minuman) : ?>
        <div class="product-card drink-card"> <!-- Kategori "drink-card" untuk Minuman -->
            <img src="<?= BASEURL . '/uploads/' . $minuman['gambar']; ?>" alt="Gambar Produk Minuman" class="product-image">
            <h3 class="product-name"><?= $minuman['nama_produk']; ?></h3>
            <p class="product-size"><?= $minuman['nama_ukuran']; ?></p>
            <p class="product-price">Rp <?= number_format($minuman['harga'], 2, ',', '.'); ?></p>
            <div class="product-actions">
                <a href="#" class="add-to-cart">Add to Cart</a>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Card Produk Makanan -->
        <?php foreach($data['makanan'] as $makanan) : ?>
        <div class="product-card food-card"> <!-- Kategori "food-card" untuk Makanan -->
            <img src="<?= BASEURL . '/uploads/' . $makanan['gambar']; ?>" alt="Gambar Produk Makanan" class="product-image">
            <h3 class="product-name"><?= $makanan['nama_produk']; ?></h3>
            <p class="product-price">Rp <?= number_format($makanan['harga'], 2, ',', '.'); ?></p>
            <div class="product-actions">
                <a href="#" class="buy-now">Tidak Ada Ukuran</a>
                <a href="#" class="add-to-cart">Add to Cart</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
