<div class="main p-2 shadow mt-3 rounded">
    <h2 class="text mb-4">Data Produk</h2>
    <div class="row">
        <!-- Card Makanan -->
        <div class="col-md-4">
            <div class="card mb-4" style="background-color: #1d335f; color: #ffffff;">
                <div class="card-body text-center">
                    <i class="bi bi-basket3-fill display-4 mb-3"></i>
                    <h5 class="card-title">Makanan</h5>
                    <p class="card-text fs-5">Total Makanan: <strong>120</strong></p>
                </div>
                <div class="card-footer text-center" style="background-color: rgba(255, 255, 255, 0.1); color: #ffffff;">
                    <small>Data diperbarui secara berkala</small>
                </div>
            </div>
        </div>

        <!-- Card Minuman -->
        <div class="col-md-4">
            <div class="card mb-4" style="background-color: #1d335f; color: #ffffff;">
                <div class="card-body text-center">
                    <i class="bi bi-cup-fill display-4 mb-3"></i>
                    <h5 class="card-title">Minuman</h5>
                    <p class="card-text fs-5">Total Minuman: <strong>80</strong></p>
                </div>
                <div class="card-footer text-center" style="background-color: rgba(255, 255, 255, 0.1); color: #ffffff;">
                    <small>Data diperbarui secara berkala</small>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="POST">
        <div class="mb-3">
            <select class="form-select form-select-lg mb-3" name="kategori" onchange="this.form.submit()">
                <option selected>Pilih kategori produk</option>
                <option value="Minuman">Minuman</option>
                <option value="Makanan">Makanan</option>
            </select>
        </div>
    </form>