@extends('user.layouts.app')

@section('title', 'Karier - BPR NTB')

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. HERO SECTION --}}
        <section class="relative mx-4 lg:mx-8 mb-16">
            <div class="relative rounded-[3rem] bg-[#00326B] overflow-hidden shadow-2xl shadow-blue-900/30">
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-blue-500 rounded-full blur-[140px] opacity-30 animate-pulse">
                </div>

                <div class="max-w-7xl mx-auto px-8 py-16 lg:py-24 relative z-10">
                    <div class="max-w-4xl">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/10 mb-8 backdrop-blur-md text-white font-black text-[10px] uppercase tracking-widest">
                            <i class="bi bi-people-fill text-[#fbbf24]"></i> Join Our Elite Team
                        </div>
                        <h1 class="text-5xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter mb-8">
                            Bangun Masa <br><span class="italic font-light text-[#fbbf24]">Depan Anda.</span>
                        </h1>
                        <p
                            class="text-xl md:text-2xl text-blue-100/70 font-medium italic leading-relaxed max-w-2xl border-l-2 border-[#fbbf24]/30 pl-6">
                            "Menjadi bagian dari transformasi perbankan daerah dan berkontribusi nyata bagi kemajuan UMKM di
                            Nusa Tenggara Barat."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. CORE VALUES (Bento Cards) --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 mb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="p-8 bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-50 group hover:bg-blue-600 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 group-hover:text-white transition-all">
                        <i class="bi bi-rocket-takeoff text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#00326B] mb-4 group-hover:text-white">Pengembangan Diri</h3>
                    <p class="text-slate-500 text-sm italic group-hover:text-blue-100">Program pelatihan berkelanjutan untuk
                        meningkatkan kompetensi profesional Anda.</p>
                </div>
                <div
                    class="p-8 bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-50 group hover:bg-[#fbbf24] transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 group-hover:text-white transition-all">
                        <i class="bi bi-shield-check text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#00326B] mb-4 group-hover:text-[#00326B]">Budaya Kerja Sehat</h3>
                    <p class="text-slate-500 text-sm italic group-hover:text-amber-900/70">Lingkungan kerja kolaboratif yang
                        menjunjung tinggi integritas dan keseimbangan hidup.</p>
                </div>
                <div
                    class="p-8 bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-50 group hover:bg-[#001D3D] transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-slate-100 text-slate-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/10 group-hover:text-white transition-all">
                        <i class="bi bi-gem text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#00326B] mb-4 group-hover:text-white">Remunerasi Kompetitif</h3>
                    <p class="text-slate-500 text-sm italic group-hover:text-slate-400">Penghargaan yang kompetitif
                        berdasarkan kinerja dan dedikasi Anda bagi perusahaan.</p>
                </div>
            </div>
        </section>

        {{-- 3. DAFTAR LOWONGAN --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
                <div>
                    <span class="h-[1px] w-12 bg-[#fbbf24] inline-block mb-4"></span>
                    <h2 class="text-3xl lg:text-4xl font-black text-[#00326B] tracking-tighter uppercase">Lowongan Aktif
                    </h2>
                </div>
                <div class="flex gap-4">
                    <div
                        class="px-4 py-2 bg-white rounded-xl border border-slate-100 text-[10px] font-black uppercase text-[#00326B]">
                        Total: {{ count($jobs) }} Posisi
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                @forelse($jobs as $job)
                    <div
                        class="group relative bg-white rounded-[2.5rem] p-8 lg:p-10 shadow-xl shadow-blue-900/5 border border-slate-50 flex flex-col lg:flex-row lg:items-center justify-between gap-8 hover:shadow-2xl hover:border-blue-100 transition-all">
                        <div class="flex-grow">
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-lg">{{ $job['divisi'] }}</span>
                                <span
                                    class="px-3 py-1 bg-slate-50 text-slate-400 text-[9px] font-black uppercase rounded-lg"><i
                                        class="bi bi-geo-alt me-1"></i>{{ $job['lokasi'] }}</span>
                            </div>
                            <h3
                                class="text-2xl lg:text-3xl font-black text-[#00326B] mb-4 tracking-tight group-hover:text-blue-600 transition-colors">
                                {{ $job['posisi'] }}</h3>
                            <p class="text-slate-500 text-sm italic max-w-xl line-clamp-2">"{{ $job['deskripsi'] }}"</p>
                        </div>
                        <div class="flex flex-col lg:items-end gap-6 min-w-[200px]">
                            <div class="text-right hidden lg:block">
                                <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Batas Waktu
                                </p>
                                <p class="text-sm font-black text-red-500 uppercase">{{ $job['deadline'] }}</p>
                            </div>
                            <a href="#"
                                class="w-full lg:w-auto px-10 py-5 bg-[#00326B] text-white rounded-[1.5rem] font-black text-[10px] uppercase tracking-widest text-center hover:bg-[#fbbf24] hover:text-[#00326B] transition-all shadow-lg active:scale-95">
                                Lamar Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200">
                        <i class="bi bi-briefcase text-5xl text-slate-200 mb-4 block"></i>
                        <p class="text-slate-400 italic">Saat ini belum ada lowongan kerja yang dibuka.</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- 4. RECRUITMENT STEPS --}}

        <section class="max-w-7xl mx-auto px-6 lg:px-8 mt-32">
            <div class="bg-[#00326B] rounded-[3rem] p-10 lg:p-20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-400 rounded-full blur-[100px] opacity-10"></div>

                <h2 class="text-3xl lg:text-5xl font-black text-white text-center mb-20 tracking-tighter uppercase">Tahapan
                    <span class="text-[#fbbf24] italic font-light">Rekrutmen</span></h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-6 border border-white/20 group-hover:bg-[#fbbf24] group-hover:text-[#00326B] transition-all">
                            01</div>
                        <h4 class="text-white font-black text-xs uppercase tracking-widest mb-3">Registrasi</h4>
                        <p class="text-blue-200/50 text-[10px] italic">Unggah dokumen CV dan berkas pendukung Anda.</p>
                    </div>
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-6 border border-white/20 group-hover:bg-[#fbbf24] group-hover:text-[#00326B] transition-all">
                            02</div>
                        <h4 class="text-white font-black text-xs uppercase tracking-widest mb-3">Seleksi</h4>
                        <p class="text-blue-200/50 text-[10px] italic">Proses administrasi dan tes kompetensi dasar.</p>
                    </div>
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-6 border border-white/20 group-hover:bg-[#fbbf24] group-hover:text-[#00326B] transition-all">
                            03</div>
                        <h4 class="text-white font-black text-xs uppercase tracking-widest mb-3">Wawancara</h4>
                        <p class="text-blue-200/50 text-[10px] italic">Pertemuan mendalam dengan tim HR dan User.</p>
                    </div>
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-6 border border-white/20 group-hover:bg-[#fbbf24] group-hover:text-[#00326B] transition-all">
                            04</div>
                        <h4 class="text-white font-black text-xs uppercase tracking-widest mb-3">Onboarding</h4>
                        <p class="text-blue-200/50 text-[10px] italic">Bergabung dan mulai perjalanan karier Anda.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <style>
        .tracking-tighter {
            letter-spacing: -0.05em;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection
