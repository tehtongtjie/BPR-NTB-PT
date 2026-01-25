document.addEventListener("DOMContentLoaded", function () {
    const nominalInput = document.getElementById("nominal");
    const tenorSelect = document.getElementById("tenor");
    const bungaInput = document.getElementById("bunga");
    
    // Elemen Display (Disesuaikan dengan ID di HTML Blade Anda)
    const displayPokok = document.getElementById("summary_plafond"); // ID di Blade: summary_plafond
    const displayBunga = document.getElementById("display_bunga");
    const displayTotal = document.getElementById("display_total");
    const errorText = document.getElementById("nominal-error");

    // Pastikan elemen ada sebelum lanjut
    if (!nominalInput || !tenorSelect) return;

    const CONFIG = {
        bungaTenor: {
            1: 5.0,
            3: 5.25,
            6: 5.5,
            12: 6.0,
        },
        minNominal: 5000000,
        thresholdPajak: 7500000,
        ratePajak: 0.2, // Pajak 20%
    };

    const formatIDR = (angka) => {
        return "Rp " + Math.floor(angka).toLocaleString("id-ID");
    };

    const parseRaw = (str) => {
        return parseInt(str.replace(/\D/g, "")) || 0;
    };

    function hitungDeposito() {
        const nominal = parseRaw(nominalInput.value);
        const tenor = parseInt(tenorSelect.value);

        // Validasi Minimal Nominal
        if (nominal > 0 && nominal < CONFIG.minNominal) {
            errorText.classList.remove("hidden");
            nominalInput.classList.add("ring-2", "ring-red-500");
        } else {
            errorText.classList.add("hidden");
            nominalInput.classList.remove("ring-2", "ring-red-500");
        }

        // Reset display jika input tidak valid atau tenor belum dipilih
        if (!nominal || isNaN(tenor) || nominal < CONFIG.minNominal) {
            if (displayPokok) displayPokok.innerText = "Rp 0";
            if (displayBunga) displayBunga.innerText = "Rp 0";
            if (displayTotal) displayTotal.innerText = "Rp 0";
            return;
        }

        const rateBunga = CONFIG.bungaTenor[tenor] / 100;
        let bungaBruto = nominal * rateBunga * (tenor / 12);

        // Hitung Pajak jika di atas threshold Rp 7.500.000
        let pajak = 0;
        if (nominal > CONFIG.thresholdPajak) {
            pajak = bungaBruto * CONFIG.ratePajak;
        }

        const bungaNetto = bungaBruto - pajak;
        const total = nominal + bungaNetto;

        // Update Tampilan
        if (displayPokok) displayPokok.innerText = formatIDR(nominal);
        if (displayBunga) displayBunga.innerText = formatIDR(bungaNetto);
        if (displayTotal) displayTotal.innerText = formatIDR(total);
    }

    // Listener Input dengan Formatting Ribuan Otomatis
    nominalInput.addEventListener("input", function (e) {
        let cursorStart = this.selectionStart;
        let oldLength = this.value.length;
        let angka = parseRaw(this.value);

        if (angka > 0) {
            this.value = angka.toLocaleString("id-ID");
        } else {
            this.value = "";
        }

        let newLength = this.value.length;
        cursorStart = cursorStart + (newLength - oldLength);
        this.setSelectionRange(cursorStart, cursorStart);

        hitungDeposito();
    });

    // Listener Ganti Tenor
    tenorSelect.addEventListener("change", function () {
        const val = this.value;
        if (val) {
            bungaInput.value = CONFIG.bungaTenor[val].toFixed(2) + "%";
        }
        hitungDeposito();
    });

    // Jalankan kalkulasi awal
    hitungDeposito();
});