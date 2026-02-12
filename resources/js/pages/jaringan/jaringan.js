
class JaringanKantor {
    constructor() {
        this.map = null;
        this.markers = [];
        this.currentKantor = null;
        this.activeFilter = "all";
        this.searchInput = null;
    }

    init() {
        this.initializeFilters();
        this.initializeSearch();
        console.log("Jaringan Kantor (Tailwind) ready");
    }

    /* ================= FILTER & SEARCH ================= */

    initializeFilters() {
        const buttons = document.querySelectorAll(".filter-btn");
        buttons.forEach((btn) => {
            btn.addEventListener("click", () => {
                buttons.forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
                this.activeFilter = btn.dataset.filter;
                this.filterRows();
            });
        });
    }

    initializeSearch() {
        this.searchInput = document.getElementById("searchKantor");
        if (!this.searchInput) return;

        this.searchInput.addEventListener("input", () => {
            this.filterRows();
        });
    }

    filterRows() {
        const keyword = this.searchInput
            ? this.searchInput.value.toLowerCase()
            : "";

        document.querySelectorAll(".kantor-row").forEach((row) => {
            const type = row.dataset.type || "cabang";
            const text = row.textContent.toLowerCase();

            const matchFilter =
                this.activeFilter === "all" || this.activeFilter === type;
            const matchSearch = !keyword || text.includes(keyword);

            row.classList.toggle("hidden", !(matchFilter && matchSearch));
        });
    }

    /* ================= MODAL & MAP ================= */

    openMapModal(kantor) {
        this.currentKantor = kantor;

        document.getElementById("modalKantorName").innerText = this.getLabel(
            kantor.tipe || kantor.type,
        );
        document.getElementById("modalKantorFullName").innerText = kantor.nama;
        document.getElementById("modalKantorAlamat").innerText = kantor.alamat;
        document.getElementById("modalKantorTelepon").innerText =
            kantor.telepon || "-";

        const modal = document.getElementById("mapModal");
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                this.initMap(kantor);
            });
        });
    }

    closeModal() {
        const modal = document.getElementById("mapModal");
        modal.classList.add("hidden");
        document.body.style.overflow = "";

        if (this.map) {
            this.map.remove();
            this.map = null;
        }
    }

    initMap(kantor) {
        const lat = parseFloat(kantor.latitude || kantor.lat);
        const lng = parseFloat(kantor.longitude || kantor.lng);

        if (this.map) {
            this.map.remove();
            this.map = null;
        }

        this.map = L.map("map").setView(
            isNaN(lat) || isNaN(lng) ? [-8.5833, 116.1167] : [lat, lng],
            15,
        );

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap",
        }).addTo(this.map);

        if (!isNaN(lat) && !isNaN(lng)) {
            const marker = L.marker([lat, lng]).addTo(this.map);
            marker.bindPopup(`<b>${kantor.nama}</b>`).openPopup();
        }

        setTimeout(() => this.map.invalidateSize(), 300);
    }

    /* ================= UTIL ================= */

    getLabel(type) {
        return (
            {
                pusat: "Kantor Pusat",
                cabang: "Kantor Cabang",
                kas: "Kantor Kas",
            }[type?.toLowerCase()] || "Kantor"
        );
    }

getDirections() {
    if (!this.currentKantor) return;
    const lat = this.currentKantor.latitude || this.currentKantor.lat;
    const lng = this.currentKantor.longitude || this.currentKantor.lng;
    
    // URL ini otomatis memerintahkan Google Maps menggunakan lokasi perangkat saat ini sebagai titik start
    window.open(
        `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`,
        "_blank",
    );
}

    shareLocation() {
        if (!this.currentKantor) return;
        const text = `${this.currentKantor.nama}\n${this.currentKantor.alamat}`;
        navigator.clipboard.writeText(text);
        alert("Alamat disalin");
    }
}

/* ================= GLOBAL ================= */

const jaringanKantor = new JaringanKantor();

window.openMapModal = (data) => jaringanKantor.openMapModal(data);
window.closeModal = () => jaringanKantor.closeModal();
window.getDirections = () => jaringanKantor.getDirections();
window.shareLocation = () => jaringanKantor.shareLocation();

document.addEventListener("DOMContentLoaded", () => jaringanKantor.init());
