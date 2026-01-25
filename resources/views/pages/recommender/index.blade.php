@extends('layouts.app')

@section('title', 'Smart Advisor AI - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <main class="relative bg-[#F4F7FA] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased overflow-hidden">

        {{-- Background Glow Decor --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-200/40 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-200/30 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 relative z-10">

            {{-- Progress Indicator --}}
            <div class="mb-12 max-w-md mx-auto">
                <div class="flex justify-between mb-3 text-[10px] font-black uppercase tracking-[0.2em]">
                    <span class="text-indigo-600">Analisis Sahabat</span>
                    <span id="step-counter" class="text-slate-400">Step 1 of 4</span>
                </div>
                <div class="h-1.5 w-full bg-slate-200 rounded-full p-0.5 overflow-hidden">
                    <div id="progress-bar" class="h-full bg-indigo-600 rounded-full transition-all duration-700 ease-in-out"
                        style="width: 25%"></div>
                </div>
            </div>

            {{-- Main Recommender Card --}}
            <div id="recommender-card"
                class="bg-white/80 backdrop-blur-2xl rounded-[3.5rem] p-8 lg:p-14 shadow-[0_32px_64px_-16px_rgba(0,50,107,0.1)] border border-white relative min-h-[550px] flex flex-col justify-center transition-all duration-500">

                {{-- STEP 1: TUJUAN --}}
                <div id="step-1" class="step-content space-y-10 animate-step-in">
                    <div class="text-center">
                        <h2 class="text-3xl lg:text-4xl font-black text-[#00326B] uppercase tracking-tighter">Apa fokus
                            keuangan <br>Anda saat ini?</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <button onclick="nextStep(2, {tujuan: 'tabungan'})"
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 hover:border-indigo-600 hover:shadow-2xl transition-all text-center">
                            <div
                                class="w-20 h-20 bg-indigo-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i class="bi bi-piggy-bank text-3xl"></i>
                            </div>
                            <span class="font-black text-[#00326B] uppercase text-[11px] tracking-widest">Menabung</span>
                        </button>
                        <button onclick="nextStep(2, {tujuan: 'investasi'})"
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 hover:border-indigo-600 hover:shadow-2xl transition-all text-center">
                            <div
                                class="w-20 h-20 bg-indigo-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i class="bi bi-graph-up-arrow text-3xl"></i>
                            </div>
                            <span class="font-black text-[#00326B] uppercase text-[11px] tracking-widest">Investasi</span>
                        </button>
                        <button onclick="nextStep(2, {tujuan: 'pinjaman'})"
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 hover:border-indigo-600 hover:shadow-2xl transition-all text-center">
                            <div
                                class="w-20 h-20 bg-indigo-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i class="bi bi-lightning-charge text-3xl"></i>
                            </div>
                            <span class="font-black text-[#00326B] uppercase text-[11px] tracking-widest">Pinjaman</span>
                        </button>
                    </div>
                </div>

                {{-- STEP 2: PROFIL --}}
                <div id="step-2" class="step-content hidden space-y-10 animate-step-in text-center">
                    <h2 id="question-step-2" class="text-2xl font-black text-[#00326B] uppercase tracking-tight">...</h2>
                    <div id="options-step-2" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto"></div>
                </div>

                {{-- STEP 3: PREFERENSI --}}
                <div id="step-3" class="step-content hidden space-y-10 animate-step-in text-center">
                    <h2 id="question-step-3" class="text-2xl font-black text-[#00326B] uppercase tracking-tight">...</h2>
                    <div id="options-step-3" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto"></div>
                </div>

                {{-- STEP 4: REVEAL --}}
                <div id="step-4" class="step-content hidden animate-reveal text-center">
                    <div class="relative inline-block mb-10">
                        <div
                            class="w-24 h-24 bg-indigo-900 text-white rounded-[2.5rem] flex items-center justify-center mx-auto rotate-6 shadow-2xl">
                            <i class="bi bi-magic text-4xl"></i>
                        </div>
                    </div>

                    <div
                        class="max-w-2xl mx-auto bg-[#00326B] rounded-[3.5rem] p-1 shadow-2xl overflow-hidden mb-10 group text-left">
                        <div class="bg-white rounded-[3.4rem] p-10 lg:p-14">
                            <div class="flex flex-col lg:flex-row justify-between items-start gap-8 mb-10">
                                <div class="flex-1">
                                    <span id="product-badge"
                                        class="px-4 py-1.5 rounded-full bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase tracking-[0.2em] mb-4 inline-block">Analisis
                                        Selesai</span>
                                    <h3 id="product-name"
                                        class="text-4xl font-black text-[#00326B] mb-3 leading-none uppercase tracking-tighter">
                                        ...</h3>
                                    <p id="product-desc" class="text-slate-500 font-medium text-sm leading-relaxed italic">
                                        ...</p>
                                </div>
                                <div id="calc-display"
                                    class="w-full lg:w-48 bg-slate-50 border border-slate-100 p-6 rounded-[2rem] text-center">
                                    <span class="block text-[8px] font-black uppercase text-slate-400 mb-2">Estimasi
                                        Perolehan</span>
                                    <span id="calc-value" class="block text-xl font-black text-indigo-600 leading-none">Rp
                                        0</span>
                                </div>
                            </div>
                            <div id="product-features" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 max-w-xs mx-auto">
                        <a id="action-link" href="#"
                            class="bg-[#00326B] text-white font-black py-5 rounded-[2rem] uppercase tracking-[0.3em] text-[10px] shadow-2xl hover:scale-105 transition-all flex items-center justify-center gap-2">
                            Pelajari Detail <i class="bi bi-arrow-right"></i>
                        </a>
                        <button onclick="location.reload()"
                            class="text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-[#00326B] transition-colors">Analisis
                            Ulang</button>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

{{-- Memasukkan Script menggunakan Vite agar terkompilasi --}}
@push('scripts')
    @vite('resources/js/pages/simulasi/rekomendasi.js')
@endpush

<style>
    .animate-step-in {
        animation: stepIn 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    }

    .animate-reveal {
        animation: reveal 0.8s cubic-bezier(0.17, 0.67, 0.83, 0.67) forwards;
    }

    @keyframes stepIn {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes reveal {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
