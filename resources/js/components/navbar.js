// export function initNavbar() {
//     const mobileMenuButton = document.getElementById("mobile-menu-button");
//     const mobileMenu = document.getElementById("mobile-menu");
//     const navElement = document.querySelector("nav");

//     if (!mobileMenuButton || !mobileMenu) return;

//     // Toggle menu via Button
//     mobileMenuButton.addEventListener("click", (e) => {
//         e.stopPropagation(); // Mencegah event click document ikut terpicu
//         const isHidden = mobileMenu.classList.toggle("hidden");

//         // Sinkronisasi Icon
//         const icon = mobileMenuButton.querySelector("i");
//         if (icon) {
//             icon.classList.toggle("bi-list", isHidden);
//             icon.classList.toggle("bi-x", !isHidden);
//         }

//         // Kunci scroll body jika menu terbuka
//         document.body.style.overflow = isHidden ? "" : "hidden";
//     });

//     // Menutup menu jika klik di luar navbar
//     document.addEventListener("click", (event) => {
//         if (navElement && !navElement.contains(event.target)) {
//             if (!mobileMenu.classList.contains("hidden")) {
//                 mobileMenu.classList.add("hidden");
//                 document.body.style.overflow = "";

//                 // Kembalikan icon ke list
//                 const icon = mobileMenuButton.querySelector("i");
//                 if (icon) {
//                     icon.classList.add("bi-list");
//                     icon.classList.remove("bi-x");
//                 }
//             }
//         }
//     });
// }

// // Inisialisasi
// if (document.readyState === "loading") {
//     document.addEventListener("DOMContentLoaded", initNavbar);
// } else {
//     initNavbar();
// }
