<div class="main p-2 shadow mt-3 rounded">
    <h2 class="text mb-4">Data Produk</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategory Produk</th>
                <th>Ukuran Produk</th>
                <th>Harga Harga</th>
                <th>Stok Produk</th>
                <th>Gambar Produk</th>
                <th>Waktu Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data['produk'] as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($p['nama_produk']); ?></td>
                    <td><?= htmlspecialchars($p['nama_kategori']); ?></td>
                    <td><?= htmlspecialchars($p['nama_ukuran']); ?></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($p['stok']); ?></td>
                    <td>
                        <?php if (!empty($p['gambar'])) : ?>
                            <img src="path/to/images/<?= htmlspecialchars($p['gambar']); ?>" alt="<?= htmlspecialchars($p['nama_produk']); ?>" width="50">
                        <?php else : ?>
                            Tidak Ada Gambar
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['created_at']); ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
