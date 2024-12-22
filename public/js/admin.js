const hamBurger = document.querySelector(".toggle-btn");
hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

// ================== Minuman ======================
$(document).ready(function () {
  $(".tombolTambahData").on("click", function () {
    console.log("okeee");
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
    $("#ukuran").val("").prop("disabled", false);
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
        $("#ukuran").val(data.nama_ukuran).prop("disabled", true);

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

// ================== Makanan ======================
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
