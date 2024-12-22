<div class="container-fluid mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Daftar Makanan</h3>
                <?php Flasher::flashProduk(); ?>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <!-- Form pencarian -->
                <form class="d-flex w-50" action="<?= BASEURL ?>/admin/cariMakanan" method="POST">
    <input class="form-control me-2" type="search" placeholder="Cari Makanan" aria-label="Search" style="max-width: 250px;" name="keyword" required>
    <button class="btn btn-outline-success" type="submit" name="search">Cari</button>
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
                        <?php 
                        $start_no = ($data['current_page'] - 1) * $data['limit'];
                        ?>
                        <?php foreach ($data['produk'] as $index => $makanan) : ?>
                            <tr>
                                <td><?= $start_no + $index + 1; ?></td>
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
            <nav>
                <ul class="pagination">
                    <!-- Tombol Previous -->
                    <li class="page-item <?= ($data['current_page'] == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= BASEURL; ?>/admin/makanan/<?= $data['current_page'] - 1; ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $data['total_pages']; $i++) : ?>
                        <li class="page-item <?= ($i == $data['current_page']) ? 'active' : ''; ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/admin/makanan/<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <!-- Tombol Next -->
                    <li class="page-item <?= ($data['current_page'] == $data['total_pages']) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= BASEURL; ?>/admin/makanan/<?= $data['current_page'] + 1; ?>">Next</a>
                    </li>
                </ul>
            </nav>
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
<script>
    $(document).ready(function () {
  $(".TambahMakanan").on("click", function () {
    $("#judulModalMakanan").html("Tambah Data Produk");
    $(".modal-footer button[type=submit]").html("Tambah Data");
    $(".modal-body form").attr(
      "action",
      "http://localhost/Nyokcoffe/public/admin/inputDataMakanan"
    );
    $("#gambarLamaPreview").hide(); // Sembunyikan gambar lama
    $("#formFile").val("");
    $("#namaProduk").val("");
    $("#stok").val("");
    $("#harga").val("");
  });

  $(".EditMakanan").on("click", function () {
    console.log("ada makanan");
    $("#judulModalMakanan").html("Edit Data Produk");
    $(".modal-footer button[type=submit]").html("Edit Data");
    $(".modal-body form").attr(
      "action",
      "http://localhost/Nyokcoffe/public/admin/EditMakanan"
    );

    const id_produkMakanan = $(this).data("id");

    $.ajax({
      url: "http://localhost/Nyokcoffe/public/admin/getUbahMakanan",
      data: {
        id_produkMakanan: id_produkMakanan,
      },
      method: "post",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#IdMakanan").val(data.id_produk);
        $("#namaProduk").val(data.nama_produk);
        $("#stok").val(data.stok);
        $("#harga").val(data.harga);
        if (data.gambar) {
          $("#gambarLamaPreview")
            .attr(
              "src",
              "http://localhost/Nyokcoffe/public/uploads/" + data.gambar
            )
            .show();
        } else {
          $("#gambarLamaPreview").hide();
        }
      },
    });
  });
});

</script>