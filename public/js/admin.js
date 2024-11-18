const hamBurger = document.querySelector(".toggle-btn");
hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

// ========================================
$(document).ready(function () {
  $(".tombolTambahData").on("click", function () {
    $("#formModalLabel").html("Tambah Data Produk");
    $(".modal-footer button[type=submit]").html("Tambah Data");
    $(".modal-body form").attr(
      "action",
      "http://localhost/Nyokcoffe/public/admin/inputDataMinuman"
    );
    $("#gambarLamaPreview").hide(); // Sembunyikan gambar lama
    $("#formFile").val("");
    $("#namaProduk").val("");
    $("#stok").val("");
    $("#harga").val("");
    $("#ukuran").val("");
  });

  $(".tampilModalUbah").on("click", function () {
    $("#formModalLabel").html("Edit Data Produk");
    $(".modal-footer button[type=submit]").html("Edit Data");
    $(".modal-body form").attr(
      "action",
      "http://localhost/Nyokcoffe/public/admin/EditMinuman"
    );

    const id_produk = $(this).data("id_produk");
    const nama_ukuran = $(this).data("nama_ukuran");

    $.ajax({
      url: "http://localhost/Nyokcoffe/public/admin/getUbah",
      data: {
        id_produk: id_produk,
        nama_ukuran: nama_ukuran,
      },
      method: "post",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#IdMinuman").val(data.id_produk);
        $("#namaProduk").val(data.nama_produk);
        $("#stok").val(data.stok);
        $("#harga").val(data.harga);
        $("#ukuran").val(data.nama_ukuran);

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
