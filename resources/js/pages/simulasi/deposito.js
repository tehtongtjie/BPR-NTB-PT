document.addEventListener("DOMContentLoaded", function () {
    const nominalInput = document.getElementById("nominal");
    const tenorSelect = document.getElementById("tenor");

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
        ratePajak: 0.2,
    };

    const bungaInput = document.getElementById("bunga");
    const displayBunga = document.getElementById("display_bunga");
    const displayTotal = document.getElementById("display_total");
    const errorText = document.getElementById("nominal-error");

    const formatIDR = (angka) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(angka);
    };

    const parseRaw = (str) => parseInt(str.replace(/[^0-9]/g, "")) || 0;

    function hitungDeposito() {
        const nominal = parseRaw(nominalInput.value);
        const tenor = parseInt(tenorSelect.value);

        if (nominal > 0 && nominal < CONFIG.minNominal) {
            errorText.classList.remove("hidden");
            nominalInput.classList.add("ring-2", "ring-red-500");
        } else {
            errorText.classList.add("hidden");
            nominalInput.classList.remove("ring-2", "ring-red-500");
        }

        if (!nominal || !tenor || nominal < CONFIG.minNominal) {
            updateDisplay(0, 0);
            return;
        }

        const rateBunga = CONFIG.bungaTenor[tenor] / 100;
        let bungaBruto = nominal * rateBunga * (tenor / 12);

        let pajak = 0;
        if (nominal > CONFIG.thresholdPajak) {
            pajak = bungaBruto * CONFIG.ratePajak;
        }

        const bungaNetto = bungaBruto - pajak;
        const total = nominal + bungaNetto;

        updateDisplay(bungaNetto, total);
    }

    function updateDisplay(bunga, total) {
        if (displayBunga)
            displayBunga.innerText =
                bunga > 0 ? formatIDR(Math.floor(bunga)) : "Rp 0";
        if (displayTotal)
            displayTotal.innerText =
                total > 0 ? formatIDR(Math.floor(total)) : "Rp 0";
    }

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

    tenorSelect.addEventListener("change", function () {
        const val = this.value;

        if (val) {
            bungaInput.value = CONFIG.bungaTenor[val].toFixed(2);
        } else {
            bungaInput.value = "0.00";
        }

        hitungDeposito();
    });
});
