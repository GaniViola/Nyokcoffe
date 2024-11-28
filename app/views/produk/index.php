<div class="wrap">
    <h2 class="title">Our Menu</h2>

    <!-- Navigasi Kategori -->
    <div class="menu-categories">
        <a href="#" class="category-link active" data-category="all">View All</a>
        <a href="#" class="category-link" data-category="drink-card">Minuman</a>
        <a href="#" class="category-link" data-category="food-card">Makanan</a>
    </div>

    <!-- Container Produk -->
    <div class="produk-container">
        <!-- Loop Produk -->
        <?php foreach ($data['allProduk'] as $produk): ?>
        <div class="product-card drink-card">
            <img src="<?= BASEURL . '/uploads/' . $produk['gambar']; ?>" alt="Gambar Produk" class="produk-image">
            <h3 class="produk-name"><?= $produk['nama_produk']; ?></h3>
            <p class="produk-category">Kategori: <?= $produk['nama_kategori']; ?></p>
            <p class="produk-price">Rp <?= number_format($produk['harga'], 2, ',', '.'); ?></p>
            <p class="produk-stock">Stok: <?= $produk['stok']; ?></p>
            
            <?php if (!empty($produk['ukuran'])): ?>
                <p class="produk-size">Ukuran: <?= $produk['ukuran']; ?></p>
            <?php else: ?>
                <p class="produk-size"><br></p>
            <?php endif; ?>

            <div class="produk-actions">
                <a href="<?= $produk['id_produk']; ?>" class="produk-cart">Add to Cart</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
