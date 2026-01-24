document.addEventListener("DOMContentLoaded", function () {
    const pinjamanInput = document.getElementById("pinjaman");

    if (!pinjamanInput) return;

    const jenisSelect = document.getElementById("jenis_kredit");
    const tenorSelect = document.getElementById("tenor");
    const sistemSelect = document.getElementById("sistem_bunga");
    const bungaInfo = document.getElementById("bunga-info");
    const errorText = document.getElementById("pinjaman-error");
    const sistemWrapper = document.getElementById("sistem-bunga-wrapper");
    const displayAngsuran = document.getElementById("display_angsuran");
    const summaryPlafond = document.getElementById("summary_plafond");
    const summaryBunga = document.getElementById("summary_bunga");
    const anuitasInfo = document.getElementById("anuitas-info");

    function rupiah(n) {
        return "Rp " + Math.round(n).toLocaleString("id-ID");
    }

    function angka(v) {
        return parseInt(v.replace(/[^0-9]/g, "")) || 0;
    }

    function minimalPinjaman(jenis) {
        if (jenis === "tanpa_agunan") return 1500000;
        if (jenis === "agunan") return 5000000;
        if (jenis === "konsumtif") return 5000000;
        return 0;
    }

    function validasiLangsung() {
        const P = angka(pinjamanInput.value);
        const jenis = jenisSelect.value;

        if (!P || !jenis) {
            pinjamanInput.classList.remove("ring-2", "ring-red-500");
            errorText.classList.add("hidden");
            return false;
        }

        const min = minimalPinjaman(jenis);

        if (P < min) {
            pinjamanInput.classList.add("ring-2", "ring-red-500");
            errorText.classList.remove("hidden");
            const msgSpan = errorText.querySelector("span") || errorText;
            msgSpan.textContent = `Minimal pinjaman untuk jenis ini adalah ${rupiah(min)}`;
            return false;
        }

        pinjamanInput.classList.remove("ring-2", "ring-red-500");
        errorText.classList.add("hidden");
        return true;
    }

    function filterTenor() {
        const jenis = jenisSelect.value;
        const sistem = sistemSelect.value;
        const P = angka(pinjamanInput.value);
        const options = tenorSelect.querySelectorAll("option");

        options.forEach((opt) => {
            opt.hidden = false;
            opt.disabled = false;
        });

        function allowTenor(list) {
            options.forEach((opt) => {
                const t = parseInt(opt.value);
                if (!t) return;
                if (!list.includes(t)) {
                    opt.hidden = true;
                    opt.disabled = true;
                }
            });
        }

        if (jenis === "konsumtif" && sistem === "flat") {
            if (P >= 5000000 && P <= 25000000) allowTenor([12, 24, 36, 48, 60]);
            else if (P >= 30000000 && P <= 100000000)
                allowTenor([12, 24, 36, 48, 60, 96, 120]);
            else if (P >= 125000000)
                allowTenor([12, 24, 36, 48, 60, 96, 120, 144]);
            return;
        }

        if (jenis === "konsumtif" && sistem === "anuitas") {
            if (P >= 5000000 && P <= 25000000) allowTenor([12, 24, 36, 48, 60]);
            else if (P >= 30000000 && P <= 100000000)
                allowTenor([12, 24, 36, 48, 60, 72, 84, 96, 108, 120]);
            else if (P >= 125000000)
                allowTenor([
                    12, 24, 36, 48, 60, 72, 84, 96, 108, 120, 132, 144,
                ]);
            return;
        }

        if (jenis === "agunan" && (sistem === "anuitas" || sistem === "flat")) {
            if (P >= 300000000) allowTenor([6, 12, 18, 24, 36, 48, 60, 72]);
            else if (P >= 60000000) allowTenor([6, 12, 18, 24, 36, 48, 60]);
            else if (P >= 5000000) allowTenor([6, 12, 18, 24, 36]);
            return;
        }

        if (jenis === "tanpa_agunan") {
            allowTenor([6, 12, 18, 24]);
            return;
        }
    }

    function rateAnuitas(pinjaman, tenor, jenis) {
        if (jenis === "agunan") {
            if (pinjaman >= 300000000 && tenor === 72) return 64.2;
            if (pinjaman >= 60000000) {
                if (tenor === 48) return 41;
                if (tenor === 60) return 52.4;
            }
            if (pinjaman >= 5000000) {
                if (tenor === 6) return 5.3;
                if (tenor === 12) return 10;
                if (tenor === 18) return 14.9;
                if (tenor === 24) return 19.8;
                if (tenor === 36) return 30.1;
            }
            return null;
        }
        if (jenis === "konsumtif") {
            if (pinjaman >= 125000000) {
                if (tenor === 132) return 130.3;
                if (tenor === 144) return 144.7;
            }
            if (pinjaman >= 30000000) {
                if (tenor === 72) return 64.2;
                if (tenor === 84) return 76.5;
                if (tenor === 96) return 89.3;
                if (tenor === 108) return 102.6;
                if (tenor === 120) return 116.2;
            }
            if (pinjaman >= 5000000) {
                if (tenor === 12) return 10;
                if (tenor === 24) return 19.8;
                if (tenor === 36) return 30.1;
                if (tenor === 48) return 41;
                if (tenor === 60) return 52.4;
            }
        }
        return null;
    }

    function hitungAngsuran() {
        const P = angka(pinjamanInput.value);
        const n = parseInt(tenorSelect.value);
        const jenis = jenisSelect.value;
        const sistem = sistemSelect.value;

        if (!validasiLangsung()) return;
        if (!P || !n || !jenis) {
            displayAngsuran.textContent = "Rp 0";
            bungaInfo.textContent = "Suku Bunga (%)";
            return;
        }

        let angsuran = 0;

        if (jenis === "tanpa_agunan") {
            const bungaTahunan = 16;
            const bungaBulanan = bungaTahunan / 100 / 12;
            bungaInfo.textContent = "Suku Bunga: 1,33% / bulan (16% / tahun)";
            angsuran = Math.round(P / n + P * bungaBulanan);
        } else {
            if (!sistem) return;

            if (sistem === "flat") {
                let bungaTahunan = 0;
                if (jenis === "agunan") {
                    if (P >= 300000000) bungaTahunan = 12;
                    else if (P >= 60000000) bungaTahunan = 13;
                    else if (P >= 5000000) bungaTahunan = 15;
                } else if (jenis === "konsumtif") {
                    if (P >= 125000000) bungaTahunan = 12;
                    else if (P >= 30000000) bungaTahunan = 13;
                    else if (P >= 5000000) bungaTahunan = 15;
                }
                const i = bungaTahunan / 100 / 12;
                bungaInfo.textContent = `Suku Bunga: ${(bungaTahunan / 12).toFixed(3)}% / bulan`;
                angsuran = P / n + P * i;
            }

            if (sistem === "anuitas") {
                const totalPersen = rateAnuitas(P, n, jenis);
                if (!totalPersen) {
                    displayAngsuran.textContent = "Rp 0";
                    bungaInfo.textContent = "Tenor tidak tersedia";
                    return;
                }
                bungaInfo.textContent = `Suku Bunga: ${(totalPersen / n).toFixed(3)}% / bulan`;
                angsuran = P / n + (P * (totalPersen / 100)) / n;
                angsuran = P / n + (P * (totalPersen / 100)) / n;
            }
        }

        displayAngsuran.textContent = rupiah(angsuran);
        summaryPlafond.textContent = rupiah(P);
        summaryBunga.textContent = rupiah(angsuran * n - P);
    }

    pinjamanInput.addEventListener("input", function (e) {
        const input = e.target;
        const start = input.selectionStart;
        const oldLength = input.value.length;
        const raw = angka(input.value);

        input.value = raw ? raw.toLocaleString("id-ID") : "";

        const newLength = input.value.length;
        const diff = newLength - oldLength;
        const newPos = start + diff;
        input.setSelectionRange(newPos, newPos);

        validasiLangsung();
        filterTenor();
        hitungAngsuran();
    });

    jenisSelect.addEventListener("change", function () {
        anuitasInfo.classList.add("hidden");
        if (this.value === "tanpa_agunan") {
            sistemSelect.value = "flat";
            sistemWrapper.classList.add("hidden");
        } else {
            sistemSelect.value = "";
            sistemWrapper.classList.remove("hidden");
        }
        filterTenor();
        validasiLangsung();
        hitungAngsuran();
    });

    sistemSelect.addEventListener("change", function () {
        filterTenor();
        hitungAngsuran();
        if (this.value === "anuitas") anuitasInfo.classList.remove("hidden");
        else anuitasInfo.classList.add("hidden");
    });

    tenorSelect.addEventListener("change", hitungAngsuran);
});
