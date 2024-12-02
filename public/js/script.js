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

// menambahkan produk ke keranjang belanja
$(document).ready(function () {
  $(".produk-cart").on("click", function (e) {
    e.preventDefault(); // Hindari reload halaman
    const idProduk = $(this).data("id_produk");
    // Kirim data ke server dengan AJAX
    $.ajax({
      url: "http://localhost/Nyokcoffe/public/shoppingCart",
      method: "POST",
      data: { id_produk: idProduk },

      success: function (respons) {
        // Parsing respons JSON
        const data = JSON.parse(respons);
        console.log(data.produk);
        if (data.success === true) {
          // Tambahkan produk ke modal keranjang belanja
          const cartContent = $("#cart");
          const newItem = `
          <div class="cart-item" data-id="${
            data.produk.id_produk
          }" data-price="${data.produk.harga}">
            <img src="${data.produk.gambar}" alt="${
            data.produk.nama_produk
          }" width="60">
            <div class="item-info">
              <p>${data.produk.nama_produk}</p>
              <p>Rp ${Number(data.produk.harga).toLocaleString("id-ID")}</p>
            </div>
            <div class="quantity-controls">
              <button class="btn-decrease">-</button>
              <span class="quantity">${data.produk.quantity}</span>
              <button class="btn-increase">+</button>
            </div>
            <a href="#" class="btn-remove">
              <i class="fa fa-trash"></i>
            </a>
          </div>
        `;
          cartContent.append(newItem);

          // Update total harga
          updateTotal();
        } else {
          alert(data.message);
        }
      },
    });
  });

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
