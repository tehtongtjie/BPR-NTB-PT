@extends('layouts.app')

@section('title', 'Riplay - BPR NTB')

@section('content')
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-[#FDFDFD] overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-blue-50 rounded-full blur-[120px] opacity-60">
            </div>
            <div
                class="absolute bottom-[-10%] left-[-5%] w-[400px] h-[400px] bg-amber-50 rounded-full blur-[100px] opacity-40">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            {{-- Header Section --}}
            <div class="max-w-3xl mb-16">
                <div class="inline-flex items-center gap-4 mb-6">
                    <span class="h-[2px] w-8 bg-[#fbbf24] rounded-full"></span>
                    <span class="text-[12px] font-black uppercase tracking-[0.5em] text-[#00326B]">Transparansi Produk</span>
                </div>
                <h2 class="text-4xl lg:text-6xl font-black text-[#00326B] leading-[1.1] mb-6 tracking-tighter">
                    Riplay <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">Umum</span>
                </h2>
                <p class="text-slate-500 text-lg leading-relaxed font-medium opacity-80 italic">
                    "Ringkasan Informasi Produk dan Layanan (RIPLAY) merupakan dokumen yang memuat rangkuman informasi
                    secara menyeluruh mengenai produk dan layanan jasa keuangan bagi nasabah dan calon nasabah, yang
                    disajikan dalam bentuk cetak maupun elektronik."
                </p>

            </div>

            {{-- Grid Riplay --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($documents as $doc)
                    <div
                        class="group relative bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-xl shadow-blue-900/5 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 overflow-hidden">

                        {{-- Decorative Icon Background --}}
                        <div
                            class="absolute -right-4 -top-4 w-32 h-32 bg-slate-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700">
                        </div>

                        <div class="relative z-10 space-y-6">
                            <div
                                class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-[#00326B] text-3xl group-hover:bg-[#00326B] group-hover:text-white transition-all duration-500">
                                <i class="bi {{ $doc['icon'] }}"></i>
                            </div>

                            <div>
                                <span
                                    class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 block">{{ $doc['kategori'] }}</span>
                                <h4 class="text-xl font-black text-[#00326B] leading-tight mb-3">{{ $doc['judul'] }}</h4>
                                <p class="text-slate-500 text-sm leading-relaxed italic line-clamp-2">
                                    "{{ $doc['deskripsi'] }}"</p>
                            </div>

                            <div class="pt-6 border-t border-slate-50">
                                <a href="{{ asset($doc['file_path']) }}" target="_blank"
                                    class="inline-flex items-center gap-3 px-6 py-3 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#fbbf24] hover:text-[#00326B] transition-all">
                                    <i class="bi bi-download text-sm"></i> Unduh Dokumen
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                        <i class="bi bi-file-earmark-x text-5xl text-slate-300 mb-4 block"></i>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada dokumen Riplay
                            tersedia.</p>
                    </div>
                @endforelse
            </div>

            {{-- Help Card --}}
            <div
                class="mt-20 p-10 bg-[#00326B] rounded-[3rem] shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="relative z-10 text-center md:text-left">
                    <h4 class="text-white text-2xl font-black mb-2 uppercase tracking-tight">Butuh Penjelasan Lebih Lanjut?
                    </h4>
                    <p class="text-blue-200/70 text-sm font-medium italic">Tim kami siap membantu Anda memahami setiap
                        detail produk kami.</p>
                </div>
                <a href="/kontak"
                    class="relative z-10 px-10 py-4 bg-[#fbbf24] text-[#00326B] rounded-full font-black text-xs uppercase tracking-widest hover:bg-white transition-all shadow-lg active:scale-95">
                    Hubungi Customer Service
                </a>
                {{-- Decoration --}}
                <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
            </div>
        </div>
    </section>
@endsection
