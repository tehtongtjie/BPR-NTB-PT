@extends('layouts.app')

@section('title', $title . ' - BPR NTB')

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- 1. HEADER --}}
            <div class="mb-12">
                <h1 class="text-4xl lg:text-6xl font-black text-[#00326B] tracking-tighter uppercase mb-4">
                    {{ $title }}</h1>
                <p class="text-slate-400 italic font-medium">Transparansi informasi perusahaan melalui laporan publikasi
                    resmi.</p>
            </div>

            {{-- 2. FILTER BOX (Bento Style) --}}
            <div class="bg-white rounded-[2.5rem] p-8 lg:p-10 shadow-xl shadow-blue-900/5 border border-slate-100 mb-12">
                <form action="{{ url()->current() }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">

                    {{-- Filter Jenis (Hanya muncul di Laporan Keuangan) --}}
                    @if ($tipe == 'keuangan')
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-2">Jenis
                                Laporan</label>
                            <select name="jenis"
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-[#00326B] focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                                <option value="semua">Semua Jenis</option>
                                <option value="triwulan" {{ request('jenis') == 'triwulan' ? 'selected' : '' }}>Triwulan
                                </option>
                                <option value="semester" {{ request('jenis') == 'semester' ? 'selected' : '' }}>Semester
                                </option>
                                <option value="tahunan" {{ request('jenis') == 'tahunan' ? 'selected' : '' }}>Tahunan
                                </option>
                            </select>
                        </div>
                    @endif

                    {{-- Filter Tahun --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-2">Tahun
                            Laporan</label>
                        <select name="tahun"
                            class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-[#00326B] focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                            <option value="semua">Semua Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Tampilkan --}}
                    <div>
                        <button type="submit"
                            class="w-full bg-[#00326B] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-blue-600 transition-all flex items-center justify-center gap-2 uppercase text-[10px] tracking-widest">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>
                    </div>

                    {{-- Reset --}}
                    <div>
                        <a href="{{ url()->current() }}"
                            class="block w-full text-center py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-500 transition-all">Reset
                            Filter</a>
                    </div>
                </form>
            </div>

            {{-- 3. DAFTAR FILE (List Bento) --}}
            <div class="grid grid-cols-1 gap-4">
                @forelse($laporans as $item)
                    <div
                        class="group bg-white rounded-[2rem] p-6 lg:p-8 flex flex-col md:flex-row items-center justify-between border border-slate-100 hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500">
                        <div class="flex items-center gap-6 mb-6 md:mb-0">
                            <div
                                class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center text-3xl group-hover:bg-red-500 group-hover:text-white transition-all">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[9px] font-black text-blue-600 bg-blue-50 px-3 py-1 rounded-lg uppercase tracking-widest mb-2 inline-block">FY
                                    {{ $item['tahun'] }}</span>
                                <h3 class="text-xl font-black text-[#00326B]">{{ $item['judul'] }}</h3>
                            </div>
                        </div>
                        <a href="{{ asset('storage/laporan/' . $item['file']) }}" target="_blank"
                            class="w-full md:w-auto px-8 py-4 bg-slate-50 text-[#00326B] rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#fbbf24] transition-all flex items-center justify-center gap-3">
                            Download PDF <i class="bi bi-download"></i>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                        <i class="bi bi-folder-x text-5xl text-slate-200 mb-4 block"></i>
                        <p class="text-slate-400 italic font-medium">Tidak ada laporan ditemukan untuk filter ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </main>
@endsection
