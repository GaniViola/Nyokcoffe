// Show Menu Function
const showMenu = (toggleId, navId) => {
  const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId);

  // Check if toggle and nav exist
  if (toggle && nav) {
    // When the toggle is clicked
    toggle.addEventListener("click", () => {
      nav.classList.toggle("show-menu");
    });

    // Close the menu when a menu item is clicked
    const navLinks = document.querySelectorAll(".nav_link");
    navLinks.forEach((link) =>
      link.addEventListener("click", () => {
        nav.classList.remove("show-menu");
      })
    );
  }
};

showMenu("nav-toggle", "nav-menu");

// Change navbar style on scroll
window.addEventListener("scroll", () => {
  const nav = document.querySelector(".nav");
  nav.classList.toggle("scrolled", window.scrollY > 0);
});

document.addEventListener("DOMContentLoaded", function () {
  const loginIcon = document.querySelector(".nav_user"); // Pilih ikon pengguna
  const loginModal = document.getElementById("loginModal");
  const closeModal = document.getElementById("closeModal");

  // Tampilkan modal saat ikon pengguna diklik
  loginIcon.addEventListener("click", (event) => {
    event.preventDefault(); // Mencegah perilaku default anchor
    loginModal.style.display = "flex"; // Tampilkan modal
  });

  // Sembunyikan modal saat tombol tutup diklik
  closeModal.addEventListener("click", () => {
    loginModal.style.display = "none";
  });

  // Sembunyikan modal saat mengklik di luar modal
  window.addEventListener("click", (event) => {
    if (event.target === loginModal) {
      loginModal.style.display = "none";
    }
  });
});

// js modal keranjang
const cartBtn = document.getElementById("cart-btn");
const cartModal = document.getElementById("cart-modal");
const closeCart = document.getElementById("close-cart");

cartBtn.addEventListener("click", () => {
  cartModal.classList.add("active");
});

closeCart.addEventListener("click", () => {
  cartModal.classList.remove("active");
});

document.addEventListener("DOMContentLoaded", function () {
  const cartContent = document.getElementById("cart-content");
  const totalPriceElement = document.getElementById("total-price");

  // Fungsi untuk menghitung total harga
  const calculateTotal = () => {
    let total = 0;
    const items = cartContent.querySelectorAll(".cart-item");
    items.forEach((item) => {
      const price = parseInt(item.dataset.price);
      const quantity = parseInt(item.querySelector(".quantity").innerText);
      total += price * quantity;
    });
    totalPriceElement.innerText = `Rp ${total.toLocaleString("id-ID")}`;
  };

  // Event listener untuk tombol tambah dan kurangi
  cartContent.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-increase")) {
      const quantityElement = e.target.previousElementSibling;
      let quantity = parseInt(quantityElement.innerText);
      quantity++;
      quantityElement.innerText = quantity;
    }

    if (e.target.classList.contains("btn-decrease")) {
      const quantityElement = e.target.nextElementSibling;
      let quantity = parseInt(quantityElement.innerText);
      if (quantity > 1) {
        quantity--;
        quantityElement.innerText = quantity;
      }
    }

    // Recalculate total price
    calculateTotal();
  });

  // Kalkulasi total saat pertama kali
  calculateTotal();
});

// Tangkap semua tautan kategori
const categoryLinks = document.querySelectorAll(".category-link");
const productCards = document.querySelectorAll(".product-card");

// Tambahkan event listener untuk setiap tautan
categoryLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault(); // Mencegah reload halaman
    const category = link.getAttribute("data-category");

    // Atur kelas "active" pada link yang diklik
    categoryLinks.forEach((l) => l.classList.remove("active"));
    link.classList.add("active");

    // Tampilkan/hilangkan produk berdasarkan kategori
    productCards.forEach((card) => {
      if (category === "all" || card.classList.contains(category)) {
        card.style.display = "block"; // Tampilkan kartu
      } else {
        card.style.display = "none"; // Sembunyikan kartu
      }
    });
  });
});

$(document).ready(function () {
  // Fungsi untuk memuat item keranjang dari server saat halaman dimuat
  function loadCartItems() {
    $.ajax({
      url: "http://localhost/Nyokcoffe/public/shoppingCart/getCartItems",
      method: "GET",
      success: function (respons) {
        try {
          const data = JSON.parse(respons);
          if (data.success) {
            const cartContent = $("#cart");
            cartContent.empty(); // Bersihkan isi keranjang sebelumnya
            data.cartItems.forEach((item) => {
              const newItem = `
                <div class="cart-item" data-id="${
                  item.id_produk
                }" data-price="${item.harga}">
                  <img src="http://localhost/Nyokcoffe/public/uploads/${
                    item.gambar
                  }" alt="${item.nama_produk}" width="60">
                  <div class="item-info">
                    <p class="namaproduk">${item.nama_produk}</p>
                    <p>Rp ${Number(item.harga).toLocaleString("id-ID")}</p>
                  </div>
                  <div class="quantity-controls">
                    <button class="btn-decrease">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="btn-increase">+</button>
                  </div>
                  <a href="#" class="btn-remove">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>`;
              cartContent.append(newItem);
            });
            updateTotal();
          }
        } catch (error) {
          console.error("Error parsing response:", error);
        }
      },
      error: function () {
        console.error("Terjadi kesalahan saat memuat data keranjang.");
      },
    });
  }

  // Panggil fungsi loadCartItems saat halaman dimuat
  loadCartItems();

  $(".produk-cart").on("click", function (e) {
    e.preventDefault();
    const idProduk = $(this).data("id_produk");

    $.ajax({
      url: "http://localhost/Nyokcoffe/public/shoppingCart",
      method: "POST",
      data: { id_produk: idProduk },
      success: function (respons) {
        try {
          const data = JSON.parse(respons);
          if (data.success === true) {
            const cartContent = $("#cart");
            const existingItem = cartContent.find(
              `.cart-item[data-id="${data.produk.id_produk}"]`
            );

            if (existingItem.length) {
              const quantityEl = existingItem.find(".quantity");
              const newQuantity = parseInt(quantityEl.text(), 10) + 1;
              quantityEl.text(newQuantity);
            } else {
              const newItem = `
                <div class="cart-item" data-id="${
                  data.produk.id_produk
                }" data-price="${data.produk.harga}">
                  <img src="${data.produk.gambar}" alt="${
                data.produk.nama_produk
              }" width="60">
                  <div class="item-info">
                    <p class="namaproduk">${data.produk.nama_produk}</p>
                    <p>Rp ${Number(data.produk.harga).toLocaleString(
                      "id-ID"
                    )}</p>
                  </div>
                  <div class="quantity-controls">
                    <button class="btn-decrease">-</button>
                    <span class="quantity">${data.produk.quantity}</span>
                    <button class="btn-increase">+</button>
                  </div>
                  <a href="#" class="btn-remove">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>`;
              cartContent.append(newItem);
            }

            updateTotal();
          } else {
            alert(data.message);
          }
        } catch (error) {
          console.error("Error parsing response:", error);
        }
      },
      error: function () {
        alert("Terjadi kesalahan saat menghubungi server.");
      },
    });
  });

  $(document).on("click", ".btn-decrease", function () {
    const cartItem = $(this).closest(".cart-item");
    const idProduk = cartItem.data("id");
    const quantityEl = cartItem.find(".quantity");
    let quantity = parseInt(quantityEl.text(), 10);

    if (quantity > 1) {
      quantity--;
      updateQuantity(idProduk, quantity, quantityEl);
    } else {
      alert("Quantity tidak boleh kurang dari 1.");
    }
  });

  $(document).on("click", ".btn-increase", function () {
    const cartItem = $(this).closest(".cart-item");
    const idProduk = cartItem.data("id");
    const quantityEl = cartItem.find(".quantity");
    let quantity = parseInt(quantityEl.text(), 10);

    quantity++;
    updateQuantity(idProduk, quantity, quantityEl);
  });

  $(document).on("click", ".btn-remove", function (e) {
    e.preventDefault();
    const cartItem = $(this).closest(".cart-item");
    const idProduk = cartItem.data("id");

    $.ajax({
      url: "http://localhost/Nyokcoffe/public/shoppingCart/deleteCartItem",
      method: "POST",
      data: { id_produk: idProduk },
      success: function (respons) {
        const data = JSON.parse(respons);
        if (data.success) {
          cartItem.remove();
          updateTotal();
        } else {
          alert(data.message);
        }
      },
      error: function () {
        alert("Gagal menghapus item dari keranjang.");
      },
    });
  });

  function updateQuantity(idProduk, quantity, quantityEl) {
    $.ajax({
      url: "http://localhost/Nyokcoffe/public/shoppingCart/updateCartQuantity",
      method: "POST",
      data: { id_produk: idProduk, quantity: quantity },
      success: function (respons) {
        const data = JSON.parse(respons);
        if (data.success) {
          quantityEl.text(quantity);
          updateTotal();
        } else {
          alert(data.message);
        }
      },
      error: function () {
        alert("Gagal memperbarui quantity.");
      },
    });
  }

  function updateTotal() {
    let total = 0;
    $(".cart-item").each(function () {
      const price = parseInt($(this).data("price"), 10);
      const quantity = parseInt($(this).find(".quantity").text(), 10);
      total += price * quantity;
    });
    $("#total-price").text(`Rp ${total.toLocaleString("id-ID")}`);
  }
});

// $("#orders-button").click(function () {
//   const totalPrice = $("#total-price")
//     .text()
//     .replace("Rp ", "")
//     .replace(/\./g, "");

//   const cartItems = [];
//   $(".cart-item").each(function () {
//     const id_produk = $(this).data("id");
//     const nama_produk = $(this).find(".namaproduk").text();
//     const harga = parseInt($(this).data("price"), 10);
//     const quantity = parseInt($(this).find(".quantity").text(), 10);

//     // Validasi data produk
//     if (id_produk && nama_produk && harga && quantity) {
//       cartItems.push({
//         id_produk,
//         nama_produk,
//         harga,
//         quantity,
//       });
//     }
//   });

//   // Validasi jika cart kosong
//   if (cartItems.length === 0) {
//     alert("Keranjang Anda kosong!");
//     return;
//   }

//   $.ajax({
//     url: "http://localhost/Nyokcoffe/public/AllProduk/Cekout",
//     method: "POST",
//     data: { Total: totalPrice, produk: cartItems },
//     dataType: "json", // Tambahkan tipe data respons JSON
//     success: function (response) {
//       if (response.success) {
//         alert("Pesanan berhasil dibuat!");
//         window.location.href = response.redirect_url; // Redirect jika diperlukan
//       } else {
//         alert("Gagal membuat pesanan: " + response.message);
//       }
//     },
//     error: function () {
//       alert("Terjadi kesalahan, silakan coba lagi.");
//     },
//   });
// });

$("#orders-button").click(function () {
  const totalPrice = $("#total-price")
    .text()
    .replace("Rp ", "")
    .replace(/\./g, ""); // Hapus format ribuan

  const cartItems = [];
  $(".cart-item").each(function () {
    const id_produk = $(this).data("id");
    const nama_produk = $(this).find(".namaproduk").text();
    const harga = parseInt($(this).data("price"), 10);
    const quantity = parseInt($(this).find(".quantity").text(), 10);

    if (id_produk && nama_produk && harga > 0 && quantity > 0) {
      cartItems.push({
        id_produk,
        nama_produk,
        harga,
        quantity,
      });
    }
  });

  if (cartItems.length === 0) {
    alert("Keranjang Anda kosong!");
    return;
  }

  $.ajax({
    url: "http://localhost/Nyokcoffe/public/AllProduk/Cekout",
    method: "POST",
    data: { Total: totalPrice, produk: cartItems },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        snap.pay(response.snap_token, {
          onSuccess: function () {
            alert("Pembayaran berhasil!");
            window.location.href =
              "http://localhost/Nyokcoffe/public/AllProduk/Success";
          },
          onPending: function () {
            alert("Menunggu pembayaran.");
          },
          onError: function () {
            alert("Pembayaran gagal!");
          },
          onClose: function () {
            alert("Pop-up ditutup tanpa pembayaran.");
          },
        });
      } else {
        alert("Gagal membuat pesanan: " + response.message);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error: ", error);
      alert("Terjadi kesalahan pada server, silakan coba lagi.");
    },
  });
});
