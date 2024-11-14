<div class="container-fluid mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Daftar Minuman</h3>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <!-- Form pencarian -->
                <form class="d-flex w-50">
                    <input class="form-control me-2" type="search" placeholder="Cari Minuman" aria-label="Search" style="max-width: 250px;">
                </form>
                <!-- Tombol untuk menambah data -->
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#formModal">
                    <i class="lni lni-plus me-2"></i> Tambah Minuman
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
                            <th style="background-color: #1d335f; color: white;">Ukuran</th>
                            <th style="background-color: #1d335f; color: white;">Stok</th>
                            <th style="background-color: #1d335f; color: white;">Harga</th>
                            <th style="background-color: #1d335f; color: white;">Gambar</th>
                            <th style="background-color: #1d335f; color: white;">Tanggal Input</th>
                            <th style="background-color: #1d335f; color: white;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['produk'] as $minuman) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($minuman['nama_produk']); ?></td>
                                <td><?= htmlspecialchars($minuman['nama_kategori']); ?></td>
                                <td><?= htmlspecialchars($minuman['nama_ukuran']); ?></td>
                                <td><?= number_format($minuman['stok']); ?></td>
                                <td>Rp. <?= htmlspecialchars($minuman['harga']); ?></td>
                                <td><?= htmlspecialchars($minuman['gambar']); ?></td>
                                <td><?= htmlspecialchars($minuman['created_at']); ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Tambah Data Minuman</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="namaProduk" name="nama_produk" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok Produk</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga Produk</label>
                    <input type="text" class="form-control" id="harga" name="harga" required pattern="^\d+(\.\d{1,2})?$" placeholder="Contoh: 1000.50">
                    <small class="text-muted">Masukkan harga dalam format desimal (opsional 2 angka di belakang koma).</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ukuran" class="form-label">Ukuran Produk</label>
                    <select class="form-select" id="ukuran" name="ukuran" required>
                        <option value="" selected disabled>Pilih Ukuran</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Gambar Produk</label>
                <input class="form-control" type="file" id="formFile" name="gambar_produk">
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
