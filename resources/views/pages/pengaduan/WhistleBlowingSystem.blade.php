@extends('layouts.app')

@section('title', 'Whistle Blowing System - BPR NTB')

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-44 pb-24 font-sans antialiased relative overflow-hidden">
        {{-- Elemen Dekoratif Latar Belakang --}}
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-[#00326B]/5 to-transparent -z-10"></div>
        <div class="absolute top-[10%] -right-24 w-[500px] h-[500px] bg-[#fbbf24]/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div
                class="bg-white rounded-[3rem] lg:rounded-[4rem] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">

                {{-- Pattern Overlay --}}
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
                    style="background-image: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png');">
                </div>

                <div class="p-8 md:p-16 relative z-10">

                    {{-- HEADER --}}
                    <div class="text-center mb-12">
                        <div
                            class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-red-50 text-red-700 text-[10px] font-black uppercase tracking-[0.4em] mb-6 border border-red-100">
                            <i class="bi bi-shield-lock-fill"></i> Secure & Confidential
                        </div>
                        <h1 class="text-3xl lg:text-5xl font-black text-[#00326B] leading-tight tracking-tight mb-4">
                            Whistle Blowing System
                        </h1>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Saluran Pelaporan Pelanggaran
                            Langsung ke Direksi</p>
                    </div>

                    {{-- DESKRIPSI SINGKAT --}}
                    <div class="bg-slate-50 rounded-[2.5rem] p-8 mb-12 border border-slate-100">
                        <p class="text-slate-600 text-base leading-relaxed font-medium italic text-center">
                            "Setiap laporan yang Anda kirimkan akan diteruskan secara otomatis ke Telegram grup seluruh
                            Jajaran Direksi secara rahasia."
                        </p>
                    </div>

                    {{-- FORM --}}
                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Nama Pelapor --}}
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Nama Pelapor
                                    <span class="text-slate-400 font-medium">(Opsional)</span></label>
                                <input type="text" id="wbs_nama"
                                    class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-2xl focus:ring-2 focus:ring-[#fbbf24] focus:bg-white transition-all font-semibold text-slate-700"
                                    placeholder="Anonim">
                            </div>

                            {{-- Kategori --}}
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Kategori
                                    Pelanggaran <span class="text-red-500">*</span></label>
                                <select id="wbs_kategori"
                                    class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-2xl focus:ring-2 focus:ring-[#fbbf24] font-bold text-slate-700 cursor-pointer">
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <option value="Fraud / Kecurangan">Fraud / Kecurangan</option>
                                    <option value="Korupsi / Gratifikasi">Korupsi / Gratifikasi</option>
                                    <option value="Pelanggaran Kode Etik">Pelanggaran Kode Etik</option>
                                    <option value="Penyalahgunaan Wewenang">Penyalahgunaan Wewenang</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Nama Terlapor --}}
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Nama Terlapor
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="wbs_terlapor"
                                    class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-2xl focus:ring-2 focus:ring-[#fbbf24] font-semibold text-slate-700"
                                    placeholder="Siapa yang dilaporkan?">
                            </div>

                            {{-- Lokasi --}}
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Lokasi
                                    Kejadian <span class="text-red-500">*</span></label>
                                <input type="text" id="wbs_lokasi"
                                    class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-2xl focus:ring-2 focus:ring-[#fbbf24] font-semibold text-slate-700"
                                    placeholder="Cabang / Unit Kerja">
                            </div>
                        </div>

                        {{-- Uraian --}}
                        <div class="space-y-2">
                            <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Uraian Laporan
                                <span class="text-red-500">*</span></label>
                            <textarea id="wbs_laporan" rows="6"
                                class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-[2rem] focus:ring-2 focus:ring-[#fbbf24] font-medium text-slate-700"
                                placeholder="Ceritakan kronologis kejadian..."></textarea>
                        </div>

                        {{-- INPUT FOTO (DENGAN AKSES KAMERA) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Unggah Bukti Foto
                                <span class="text-slate-400 font-medium">(Maks 2MB)</span></label>
                            <input type="file" id="wbs_foto" accept="image/*" capture="environment"
                                class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-2xl focus:ring-2 focus:ring-[#fbbf24] font-semibold text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-[#00326B] file:text-white hover:file:bg-[#fbbf24] hover:file:text-[#00326B]">
                        </div>

                        {{-- Tombol Kirim --}}
                        <div class="pt-4">
                            <button type="button" onclick="kirimWbsKeTelegram(this)"
                                class="flex items-center justify-center gap-4 w-full bg-[#00326B] text-white py-6 rounded-2xl font-black uppercase text-xs tracking-[0.3em] shadow-xl shadow-blue-900/20 hover:bg-[#fbbf24] hover:text-[#00326B] transition-all transform active:scale-95 group">
                                <i class="bi bi-send-check-fill text-lg"></i>
                                Kirim Laporan Rahasia
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function kirimWbsKeTelegram(btn) {
            const formData = new FormData();
            const fotoInput = document.getElementById('wbs_foto');

            const data = {
                nama: document.getElementById('wbs_nama').value,
                kategori: document.getElementById('wbs_kategori').value,
                terlapor: document.getElementById('wbs_terlapor').value,
                lokasi: document.getElementById('wbs_lokasi').value,
                laporan: document.getElementById('wbs_laporan').value,
            };

            // Validasi Kosong
            if (!data.kategori || !data.terlapor || !data.lokasi || !data.laporan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Mohon lengkapi semua data yang bertanda bintang (*)',
                    confirmButtonColor: '#00326B'
                });
                return;
            }

            // Validasi Foto
            if (fotoInput.files.length > 0) {
                const file = fotoInput.files[0];
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Maksimal ukuran foto adalah 2MB',
                    });
                    return;
                }
                formData.append('foto', file);
            }

            formData.append('nama', data.nama);
            formData.append('kategori', data.kategori);
            formData.append('terlapor', data.terlapor);
            formData.append('lokasi', data.lokasi);
            formData.append('laporan', data.laporan);
            formData.append('_token', "{{ csrf_token() }}");

            // 1. Loading State - Lebih Elegan
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin text-lg"></i>';

            fetch("{{ route('pengaduan.wbs.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(async response => {
                    const resData = await response.json();
                    if (response.status === 429) throw new Error(
                        'Terlalu banyak mencoba. Sistem mengunci akses Anda sementara demi keamanan.');
                    if (!response.ok) throw new Error(resData.message || 'Gagal mengirim laporan');
                    return resData;
                })
                .then(res => {
                    // 2. Notifikasi Sukses Premium
                    Swal.fire({
                        title: '<span style="color: #00326B; font-family: sans-serif;">LAPORAN TERKIRIM</span>',
                        html: '<p style="color: #64748b; font-weight: 500;">Terima kasih atas keberanian Anda. Laporan telah kami teruskan secara <b>End-to-End Encrypted</b> langsung ke jajaran Direksi.</p>',
                        icon: 'success',
                        iconColor: '#fbbf24',
                        background: '#ffffff',
                        showConfirmButton: true,
                        confirmButtonText: 'SELESAI',
                        confirmButtonColor: '#00326B',
                        customClass: {
                            popup: 'rounded-[2.5rem]',
                            confirmButton: 'rounded-xl px-10 py-3 font-black tracking-widest text-xs'
                        },
                        backdrop: `rgba(0,50,107,0.4)`
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(err => {
                    // 3. Notifikasi Error yang Informatif
                    Swal.fire({
                        title: '<span style="color: #991b1b;">TERJADI KENDALA</span>',
                        text: err.message,
                        icon: 'error',
                        confirmButtonColor: '#991b1b',
                        confirmButtonText: 'COBA LAGI',
                        customClass: {
                            popup: 'rounded-[2rem]',
                            confirmButton: 'rounded-xl px-10 py-3 font-black text-xs'
                        }
                    });
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                });
        }
    </script>
@endsection