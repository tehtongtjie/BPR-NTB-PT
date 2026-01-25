/**
 * Smart Advisor AI Logic - BPR NTB
 * Path: resources/js/pages/simulasi/rekomendasi.js
 */

const APP_CONFIG = {
    deposito: {
        bunga: { 1: 5.0, 3: 5.25, 6: 5.5, 12: 6.0 },
        min: 5000000,
        pajakTh: 7500000,
        pajakRate: 0.2
    },
    kredit: {
        modal: 12.5,
        konsumtif: 15.0
    }
};

let userData = {
    tujuan: '',
    profil: '',
    prioritas: '',
    nominal: 10000000
};

// Menempelkan fungsi ke window agar bisa dipanggil dari atribut 'onclick' di Blade
window.nextStep = function(step, data) {
    Object.assign(userData, data);
    
    document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
    const targetStep = document.getElementById(`step-${step}`);
    if (targetStep) targetStep.classList.remove('hidden');

    const progressBar = document.getElementById('progress-bar');
    const stepCounter = document.getElementById('step-counter');
    
    if (progressBar) progressBar.style.width = (step / 4 * 100) + '%';
    if (stepCounter) stepCounter.innerText = `Step ${step} of 4`;

    if (step === 2) buildStep2();
    if (step === 3) buildStep3();
    if (step === 4) showFinalResult();
};

function buildStep2() {
    const qEl = document.getElementById('question-step-2');
    const optEl = document.getElementById('options-step-2');
    if (!optEl) return;
    optEl.innerHTML = '';

    if (userData.tujuan === 'tabungan') {
        qEl.innerText = "Siapa yang akan memiliki tabungan ini?";
        addOption(optEl, 'Pelajar / Mahasiswa', () => window.nextStep(3, { profil: 'pelajar' }));
        addOption(optEl, 'Masyarakat Umum / Perorangan', () => window.nextStep(3, { profil: 'umum' }));
    } else if (userData.tujuan === 'investasi') {
        qEl.innerText = "Pilih rencana nominal dana Anda:";
        addOption(optEl, 'Dibawah Rp 7.5 Juta', () => window.nextStep(3, { profil: 'kecil' }));
        addOption(optEl, 'Rp 7.5 Juta atau Lebih', () => window.nextStep(3, { profil: 'besar' }));
    } else {
        qEl.innerText = "Apa kategori profil pekerjaan Anda?";
        addOption(optEl, 'Pegawai Tetap / PNS', () => window.nextStep(3, { profil: 'pegawai' }));
        addOption(optEl, 'Wirausaha / UMKM', () => window.nextStep(3, { profil: 'bisnis' }));
    }
}

function buildStep3() {
    const qEl = document.getElementById('question-step-3');
    const optEl = document.getElementById('options-step-3');
    if (!optEl) return;
    optEl.innerHTML = '';

    if (userData.tujuan === 'tabungan') {
        qEl.innerText = "Apa kebutuhan prioritas Anda?";
        addOption(optEl, 'Tanpa Potongan Admin', () => window.nextStep(4, { prioritas: 'admin' }));
        addOption(optEl, 'Ibadah Qurban Terencana', () => window.nextStep(4, { prioritas: 'qurban' }));
    } else if (userData.tujuan === 'investasi') {
        qEl.innerText = "Berapa lama dana ingin disimpan?";
        addOption(optEl, 'Pendek (1 - 6 Bulan)', () => window.nextStep(4, { prioritas: 'pendek' }));
        addOption(optEl, 'Panjang (12 Bulan)', () => window.nextStep(4, { prioritas: 'panjang' }));
    } else {
        qEl.innerText = "Preferensi jangka waktu angsuran?";
        addOption(optEl, 'Tenor Singkat ( < 5 Tahun )', () => window.nextStep(4, { prioritas: 'pendek' }));
        addOption(optEl, 'Tenor Panjang ( s.d 12 Th )', () => window.nextStep(4, { prioritas: 'panjang' }));
    }
}

function addOption(parent, text, action) {
    const btn = document.createElement('button');
    btn.className = "p-6 bg-white border border-slate-200 rounded-[2rem] font-black text-[#00326B] text-[10px] uppercase tracking-widest hover:border-indigo-600 hover:bg-indigo-50 transition-all";
    btn.innerText = text;
    btn.onclick = action;
    parent.appendChild(btn);
}

function showFinalResult() {
    const calcVal = document.getElementById('calc-value');
    const calcBox = document.getElementById('calc-display');
    const features = document.getElementById('product-features');
    const actionLink = document.getElementById('action-link');

    if (!features) return;
    features.innerHTML = '';
    if (calcBox) calcBox.classList.remove('hidden');

    if (userData.tujuan === 'tabungan') {
        if (calcBox) calcBox.classList.add('hidden');
        if (userData.prioritas === 'qurban') {
            setRes("Tabungan SIMBADA", "Ibadah Qurban terencana dengan asuransi jiwa.", "/tabungan/simbada", ['Gratis Asuransi', 'Bunga 5%', 'Collector Service']);
        } else if (userData.profil === 'pelajar') {
            setRes("Tabungan KU", "Khusus perorangan, syarat ringan & bebas biaya admin.", "/tabungan/tabungan-ku", ['Admin Rp 0', 'Bunga Fix 4%', 'Hanya KTP/KIA']);
        } else {
            setRes("Tabungan Sukses", "Bunga harian s.d 5% dengan layanan collector ke rumah.", "/tabungan/tabungan-sukses", ['Bunga Tinggi', 'Layanan Collector', 'Setoran Mudah']);
        }
    } else if (userData.tujuan === 'investasi') {
        const tenor = userData.prioritas === 'panjang' ? 12 : 3;
        const rate = APP_CONFIG.deposito.bunga[tenor] / 100;
        const nominal = (userData.profil === 'besar') ? 10000000 : 5000000;
        let bunga = nominal * rate * (tenor / 12);
        if (nominal > APP_CONFIG.deposito.pajakTh) bunga = bunga * (1 - APP_CONFIG.deposito.pajakRate);

        if (calcVal) calcVal.innerText = "+" + formatIDR(bunga);
        setRes("Deposito Berjangka", "Investasi aman dengan hasil pasti dijamin LPS.", "/deposito", [`Bunga s.d ${tenor==12?'6%':'5.25%'}`, 'Dijamin LPS', 'Sangat Aman']);
    } else {
        const bungaBase = userData.profil === 'pegawai' ? APP_CONFIG.kredit.konsumtif : APP_CONFIG.kredit.modal;
        const estimasi = (userData.nominal / 12) + (userData.nominal * (bungaBase / 100 / 12));

        if (calcVal) calcVal.innerText = formatIDR(estimasi) + "/bln";
        setRes(userData.profil === 'pegawai' ? "Kredit Konsumtif" : "Kredit Modal Kerja", "Pendanaan cepat dengan plafon besar & bunga bersaing.", "/pinjaman", ['Cair 3 Hari', `Bunga ${bungaBase}%`, 'Tanpa Ribet']);
    }
}

function setRes(name, desc, url, feats) {
    document.getElementById('product-name').innerText = name;
    document.getElementById('product-desc').innerText = desc;
    document.getElementById('action-link').href = url;

    const features = document.getElementById('product-features');
    feats.forEach(text => {
        const div = document.createElement('div');
        div.className = "flex items-center gap-3 bg-slate-50 p-3 rounded-2xl border border-slate-100";
        div.innerHTML = `<i class="bi bi-patch-check-fill text-indigo-500"></i> <span class="text-[9px] font-black uppercase tracking-widest text-slate-700">${text}</span>`;
        features.appendChild(div);
    });
}

function formatIDR(n) {
    return "Rp " + Math.round(n).toLocaleString("id-ID");
}