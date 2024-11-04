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