<div class="container-fluid mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Daftar Makanan</h3>
                <?php Flasher::flashProduk(); ?>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <!-- Form pencarian -->
                <form class="d-flex w-50">
                    <input class="form-control me-2" type="search" placeholder="Cari Makanan" aria-label="Search" style="max-width: 250px;">
                </form>
                
                <!-- Tombol untuk menambah data -->
                <button type="button" class="btn btn-primary d-flex align-items-center TambahMakanan" data-bs-toggle="modal" data-bs-target="#formModal">
                    <i class="lni lni-plus me-2"></i> Tambah Makanan
                </button>
            </div>

            <!-- Tabel daftar makanan -->
            <div class="table-responsive mt-4">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th style="background-color: #1d335f; color: white;">No</th>
                            <th style="background-color: #1d335f; color: white;">Nama Makanan</th>
                            <th style="background-color: #1d335f; color: white;">Kategori</th>
                            <th style="background-color: #1d335f; color: white;">Stok</th>
                            <th style="background-color: #1d335f; color: white;">Harga</th>
                            <th style="background-color: #1d335f; color: white;">Gambar</th>
                            <th style="background-color: #1d335f; color: white;">Tanggal Input</th>
                            <th style="background-color: #1d335f; color: white;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['produk'] as $makanan) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($makanan['nama_produk']); ?></td>
                                <td><?= htmlspecialchars($makanan['nama_kategori']); ?></td>
                                <td><?= number_format($makanan['stok'], 0, ',', '.'); ?></td>
                                <td>Rp. <?= htmlspecialchars($makanan['harga']); ?></td>
                                <td>
                                    <img src="<?= BASEURL . '/uploads/' . $makanan['gambar']; ?>" alt="Gambar Makanan" 
                                    class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td><?= date('d M Y, H:i:s', strtotime($makanan['created_at'])); ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm EditMakanan" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $makanan['id_produk']; ?>">Edit</a>
                                    <a href="<?= BASEURL; ?>/admin/hapusMakanan/<?= $makanan['id_produk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus makanan ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModalMakanan">Tambah Data Makanan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/admin/inputDataMakanan" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="hidden" name="id_produk" id="IdMakanan">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="namaProduk" name="nama_produk" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok Produk</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="text" class="form-control" id="harga" name="harga" required pattern="^\d+(\.\d{1,2})?$" placeholder="Contoh: 1000.50">
                <small class="text-muted">Masukkan harga dalam format desimal (opsional 2 angka di belakang koma).</small>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Gambar Produk</label>
                <!-- Pratinjau Gambar Lama -->
                <div class="mb-2">
                    <img id="gambarLamaPreview" src="" alt="Gambar Lama" style="width: 100px; height: 100px; object-fit: cover; display: none;">
                </div>
                <input class="form-control" type="file" id="formFile" name="gambar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
