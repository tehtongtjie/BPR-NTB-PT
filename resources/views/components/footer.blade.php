<footer class="bg-[#00326B] font-sans antialiased text-white border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16">

            <div class="lg:col-span-4 space-y-8">
                <div class="space-y-4">
                    <h3 class="text-2xl font-black tracking-tighter italic">PT. BPR NTB <span
                            class="text-[#fbbf24]">PERSERODA</span></h3>
                    <p class="text-blue-100/70 text-sm leading-relaxed max-w-sm">
                        Menjadi lembaga perbankan yang sehat, kuat, dan terpercaya dalam mendorong pertumbuhan ekonomi
                        masyarakat Nusa Tenggara Barat.
                    </p>
                </div>

                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#fbbf24] hover:text-[#00326B] hover:-translate-y-1 transition-all">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#fbbf24] hover:text-[#00326B] hover:-translate-y-1 transition-all">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#fbbf24] hover:text-[#00326B] hover:-translate-y-1 transition-all">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-[#fbbf24]">Layanan Utama</h4>
                <ul class="space-y-4">
                    {{-- 1. Tabungan Simbada --}}
                    {{-- Di rute kamu: Route::get('/tabungan/{slug}', ...)->name('tabungan.show') --}}
                    <li>
                        <a href="{{ route('tabungan.show', 'simbada') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-2 group">
                            <div class="h-1 w-0 bg-[#fbbf24] group-hover:w-3 transition-all"></div>Tabungan Simbada
                        </a>
                    </li>

                    {{-- 2. Deposito Berjangka --}}
                    {{-- Di rute kamu: Route::prefix('deposito')->name('deposito.')... Route::get('/{slug}', ...)->name('show') --}}
                    <li>
                        <a href="{{ route('deposito.show', 'deposito-berjangka') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-2 group">
                            <div class="h-1 w-0 bg-[#fbbf24] group-hover:w-3 transition-all"></div>Deposito Berjangka
                        </a>
                    </li>

                    {{-- 3. Kredit Usaha (Menggunakan PinjamanController) --}}
                    {{-- Di rute kamu: Route::prefix('pinjaman')->name('pinjaman.')... Route::get('/{slug}', ...)->name('show') --}}
                    <li>
                        <a href="{{ route('pinjaman.show', 'kredit-usaha') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-2 group">
                            <div class="h-1 w-0 bg-[#fbbf24] group-hover:w-3 transition-all"></div>Kredit Usaha
                        </a>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-[#fbbf24]">Informasi Publik</h4>
                <ul class="grid grid-cols-1 gap-4">
                    {{-- 1. Laporan Tahunan --}}
                    {{-- Mengarah ke LaporanController dengan tipe keuangan --}}
                    <li>
                        <a href="{{ route('laporan.keuangan') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-3 transition-all">
                            <i class="bi bi-arrow-right-short text-[#fbbf24]"></i>Laporan Tahunan
                        </a>
                    </li>

                    {{-- 2. Karir & Talent --}}
                    {{-- Sesuai route: Route::get('/karir', ...)->name('karir.index') --}}
                    <li>
                        <a href="{{ route('karir.index') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-3 transition-all">
                            <i class="bi bi-arrow-right-short text-[#fbbf24]"></i>Karir & Talent
                        </a>
                    </li>

                    {{-- 3. Tata Kelola (GCG) --}}
                    {{-- Sesuai route: Route::get('/tata-kelola', ...)->name('laporan.gcg') --}}
                    <li>
                        <a href="{{ route('laporan.gcg') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-3 transition-all">
                            <i class="bi bi-arrow-right-short text-[#fbbf24]"></i>Tata Kelola (GCG)
                        </a>
                    </li>

                    {{-- 4. Whistleblowing System --}}
                    {{-- Sesuai route: Route::get('/whistle-blowing-system', ...)->name('pengaduan.wbs') --}}
                    <li>
                        <a href="{{ route('pengaduan.wbs') }}"
                            class="text-blue-100 hover:text-white font-medium text-sm flex items-center gap-3 transition-all">
                            <i class="bi bi-arrow-right-short text-[#fbbf24]"></i>Whistleblowing System
                        </a>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-[#fbbf24]">Kantor Pusat</h4>
                <div class="space-y-4">
                    <div class="flex gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <div class="w-10 h-10 rounded-xl bg-[#fbbf24]/10 flex items-center justify-center shrink-0">
                            <i class="bi bi-geo-alt-fill text-[#fbbf24]"></i>
                        </div>
                        <p class="text-blue-50 text-[13px] leading-relaxed">
                            Jln. Adi Sucipto, Ampenan, Kota Mataram, NTB
                        </p>
                    </div>
                    <div class="flex gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center shrink-0">
                            <i class="bi bi-envelope-fill text-blue-400"></i>
                        </div>
                        <p class="text-blue-50 text-[13px]">info@bprntb.co.id</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pt-12 border-t border-white/10 items-center">
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-lg">
                        <span class="text-[10px] font-black text-[#00326B]">OJK</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-lg">
                        <span class="text-[10px] font-black text-blue-700">LPS</span>
                    </div>
                    <h5 class="text-[10px] font-black uppercase tracking-widest text-white/60">Terdaftar & Diawasi</h5>
                </div>
                <p class="text-blue-200/50 text-[11px] leading-relaxed max-w-2xl">
                    PT. BPR NTB PERSERODA berizin dan diawasi oleh Otoritas Jasa Keuangan (OJK) dan merupakan peserta
                    penjaminan Lembaga Penjamin Simpanan (LPS). Simpanan Anda dijamin hingga Rp2 miliar per nasabah.
                </p>
            </div>

            <div class="flex lg:justify-end items-center gap-4">
                <div
                    class="flex items-center gap-4 p-4 bg-white rounded-[2rem] shadow-2xl transition-transform hover:scale-105">
                    <div
                        class="w-12 h-12 rounded-full bg-[#fbbf24] flex items-center justify-center text-[#00326B] shadow-inner">
                        <i class="bi bi-headset text-xl"></i>
                    </div>
                    <div class="pr-4">
                        <span class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Customer
                            Care</span>
                        <span class="text-lg font-black text-[#00326B] italic">988183</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-bold uppercase tracking-[0.4em] text-blue-300/30">
                &copy; 2024 <span class="text-[#fbbf24]">PT. BPR NTB PERSERODA</span>
            </p>
            <div class="flex gap-6">
                <a href="#"
                    class="text-[10px] font-bold uppercase tracking-widest text-blue-300/30 hover:text-[#fbbf24]">Privacy
                    Policy</a>
                <a href="#"
                    class="text-[10px] font-bold uppercase tracking-widest text-blue-300/30 hover:text-[#fbbf24]">Terms
                    of Service</a>
            </div>
        </div>
    </div>
</footer>
