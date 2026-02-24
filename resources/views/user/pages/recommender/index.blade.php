@extends('user.layouts.app')

@section('title', 'Smart Advisor AI - BPR NTB')

@section('content')
    {{-- Container Utama dengan Background yang lebih Deep --}}
    <main class="relative bg-[#F4F7FA] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased overflow-hidden">

        {{-- High-End Background Decor --}}
        <div
            class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-200/30 rounded-full blur-[120px] pointer-events-none animate-pulse">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-100/40 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-5xl mx-auto px-6 lg:px-8 relative z-10">

            {{-- Header AI Section --}}
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-slate-100 mb-6">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">AI Financial
                        Assistant</span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-black text-[#00326B] tracking-tighter uppercase mb-4">Smart <span
                        class="text-indigo-600">Advisor</span></h1>
                <p class="text-slate-400 text-sm font-medium italic max-w-md mx-auto">Asisten cerdas yang membantu Anda
                    memilih produk perbankan paling tepat berdasarkan profil finansial Anda.</p>
            </div>

            {{-- Progress Indicator Modern --}}
            <div class="mb-12 max-w-lg mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <span id="step-label" class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600">Tujuan
                        Keuangan</span>
                    <span id="step-counter"
                        class="px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-400">01 / 04</span>
                </div>
                <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden shadow-inner">
                    <div id="progress-bar"
                        class="h-full bg-gradient-to-r from-indigo-600 to-blue-500 rounded-full transition-all duration-1000 ease-[cubic-bezier(0.23,1,0.32,1)]"
                        style="width: 25%"></div>
                </div>
            </div>

            {{-- Main Recommender Card - Glassmorphism --}}
            <div id="recommender-card"
                class="bg-white/70 backdrop-blur-3xl rounded-[4rem] p-10 lg:p-20 shadow-[0_50px_100px_-20px_rgba(0,50,107,0.12)] border border-white/60 relative min-h-[600px] flex flex-col justify-center transition-all duration-700">

                {{-- STEP 1: TUJUAN --}}
                <div id="step-1" class="step-content space-y-12 animate-step-in">
                    <div class="text-center space-y-2">
                        <h2 class="text-3xl lg:text-4xl font-black text-[#00326B] uppercase tracking-tighter leading-none">
                            Apa impian <br>finansial Anda?</h2>
                        <p class="text-slate-400 text-sm italic font-medium">Pilih fokus utama Anda untuk kami analisis.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ([['id' => 'tabungan', 'icon' => 'piggy-bank', 'title' => 'Menabung', 'desc' => 'Simpanan aman & likuid'], ['id' => 'investasi', 'icon' => 'graph-up-arrow', 'title' => 'Investasi', 'desc' => 'Kembangkan aset optimal'], ['id' => 'pinjaman', 'icon' => 'lightning-charge', 'title' => 'Modal', 'desc' => 'Dukungan dana cepat']] as $item)
                            <button onclick="nextStep(2, {tujuan: '{{ $item['id']}}'})"
                                class="group relative p-10 rounded-[3.5rem] bg-white border border-slate-100 hover:border-indigo-600 hover:shadow-2xl hover:shadow-indigo-900/10 transition-all duration-500 text-center">
                                <div
                                    class="w-20 h-20 bg-indigo-50 rounded-[2.2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-6 transition-all duration-500">
                                    <i class="bi bi-{{ $item['icon'] }} text-3xl"></i>
                                </div>
                                <h4 class="font-black text-[#00326B] uppercase text-xs tracking-widest mb-2">
                                    {{ $item['title'] }}</h4>
                                <p class="text-[10px] text-slate-400 italic leading-tight">{{ $item['desc'] }}</p>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- STEP 2 & 3: Dinamis --}}
                <div id="step-2" class="step-content hidden space-y-12 animate-step-in text-center">
                    <h2 id="question-step-2"
                        class="text-3xl font-black text-[#00326B] uppercase tracking-tight leading-none">...</h2>
                    <div id="options-step-2" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto"></div>
                </div>

                <div id="step-3" class="step-content hidden space-y-12 animate-step-in text-center">
                    <h2 id="question-step-3"
                        class="text-3xl font-black text-[#00326B] uppercase tracking-tight leading-none">...</h2>
                    <div id="options-step-3" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto"></div>
                </div>

                {{-- STEP 4: REVEAL RESULT --}}
                <div id="step-4" class="step-content hidden animate-reveal">
                    <div class="text-center mb-12">
                        <div class="inline-block p-6 bg-[#00326B] rounded-[2.5rem] shadow-2xl rotate-3 mb-6">
                            <i class="bi bi-magic text-white text-4xl"></i>
                        </div>
                        <h2 class="text-3xl font-black text-[#00326B] uppercase tracking-tighter">Hasil Rekomendasi</h2>
                    </div>

                    <div
                        class="max-w-3xl mx-auto bg-gradient-to-br from-[#00326B] to-indigo-900 rounded-[4rem] p-1 shadow-2xl mb-12 overflow-hidden">
                        <div class="bg-white rounded-[3.8rem] p-10 lg:p-16">
                            <div class="flex flex-col lg:flex-row justify-between items-start gap-12 mb-12">
                                <div class="flex-1 text-left space-y-4">
                                    <span id="product-badge"
                                        class="px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest">Ideal
                                        Untuk Anda</span>
                                    <h3 id="product-name"
                                        class="text-5xl font-black text-[#00326B] leading-[0.9] tracking-tighter uppercase italic">
                                        ...</h3>
                                    <p id="product-desc"
                                        class="text-slate-500 font-medium text-base leading-relaxed italic pr-6">...</p>
                                </div>
                                <div id="calc-display"
                                    class="w-full lg:w-56 bg-slate-50 p-8 rounded-[3rem] border border-slate-100 flex flex-col items-center justify-center">
                                    <span
                                        class="text-[9px] font-black uppercase text-slate-400 tracking-widest mb-4">Estimasi
                                        / bln</span>
                                    <span id="calc-value" class="text-2xl font-black text-indigo-600 leading-none">Rp
                                        0</span>
                                </div>
                            </div>

                            <div id="product-features"
                                class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-10 border-t border-slate-100"></div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <a id="action-link" href="#"
                            class="flex-1 bg-[#00326B] text-white font-black py-6 rounded-[2.2rem] uppercase tracking-[0.2em] text-[10px] shadow-xl hover:bg-indigo-600 transition-all flex items-center justify-center gap-3">
                            Ambil Produk Ini <i class="bi bi-arrow-right-short text-xl"></i>
                        </a>
                        <button onclick="location.reload()"
                            class="px-8 py-6 bg-slate-100 text-slate-500 font-black rounded-[2.2rem] uppercase tracking-widest text-[10px] hover:bg-slate-200 transition-all">Ulangi</button>
                    </div>
                </div>

            </div>
        </div>
        </section>
    @endsection
