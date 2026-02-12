<footer class="bg-[#00326B] pt-20 pb-10 text-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-12 border-b border-white/10 pb-16">
        <div class="space-y-6">
            <img src="{{ asset('images/logobpr.png') }}" class="h-12 brightness-0 invert" alt="Logo">
            <p class="text-blue-100/60 text-sm italic">"Pemberdayaan UMKM lokal untuk ekonomi NTB yang lebih hebat."</p>
        </div>
        <div class="space-y-4">
            <h4 class="text-amber-500 font-black uppercase text-xs tracking-widest">Tautan</h4>
            <ul class="space-y-2 text-sm text-blue-100/60 font-bold">
                <li><a href="{{ route('home') }}">Beranda Utama</a></li>
                <li><a href="{{ route('umkm.mitra') }}">Katalog UMKM</a></li>
            </ul>
        </div>
        <div class="space-y-4">
            <h4 class="text-amber-500 font-black uppercase text-xs tracking-widest">Kontak</h4>
            <p class="text-sm text-blue-100/60 font-bold"><i class="bi bi-geo-alt mr-2"></i> Mataram, Nusa Tenggara
                Barat</p>
            <p class="text-sm text-blue-100/60 font-bold"><i class="bi bi-telephone mr-2"></i> (0370) 621111</p>
        </div>
    </div>
    <div class="text-center pt-8 text-[10px] font-black text-white/20 uppercase tracking-widest">
        &copy; 2026 PT. BPR NTB (Perseroda). Licensed by OJK & LPS.
    </div>
</footer>
