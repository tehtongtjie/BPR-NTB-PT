@extends('layouts.app')

@section('title', 'Jaringan Kantor - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            z-index: 1;
        }

        .leaflet-container {
            border-radius: 1.5rem;
        }
    </style>
@endpush

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-44 pb-24 font-sans antialiased relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-[#00326B]/5 to-transparent -z-10"></div>
        <div class="absolute top-[10%] -right-24 w-[500px] h-[500px] bg-[#fbbf24]/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            {{-- ================= HEADER ================= --}}
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-blue-50 text-[#00326B] text-[10px] font-black uppercase tracking-[0.4em] mb-6 border border-blue-100 shadow-sm">
                    <i class="bi bi-geo-alt-fill text-[#fbbf24]"></i> Presence
                </div>
                <h1 class="text-4xl lg:text-6xl font-black text-[#00326B] leading-tight tracking-tight mb-4">
                    Jaringan Kantor
                </h1>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto italic">
                    Temukan layanan perbankan terdekat kami di seluruh wilayah Nusa Tenggara Barat melalui jaringan kantor
                    pusat, cabang, hingga kantor kas.
                </p>
            </div>

            {{-- ================= FILTER & SEARCH ================= --}}
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                {{-- Search Bar --}}
                <div class="relative w-full lg:w-1/3 group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="bi bi-search text-slate-400 group-focus-within:text-[#00326B] transition-colors"></i>
                    </div>
                    <input type="text" id="searchKantor"
                        class="block w-full pl-12 pr-5 py-4 bg-white border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-[#00326B] focus:border-[#00326B] transition-all font-medium text-slate-700"
                        placeholder="Cari nama kantor atau alamat...">
                </div>

                {{-- Filter Buttons --}}
                <div
                    class="flex bg-white p-1.5 rounded-2xl shadow-sm border border-slate-100 self-start lg:self-center overflow-x-auto max-w-full">
                    <button data-filter="all"
                        class="filter-btn active px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">Semua</button>
                    <button data-filter="pusat"
                        class="filter-btn px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">Pusat</button>
                    <button data-filter="cabang"
                        class="filter-btn px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">Cabang</button>
                    <button data-filter="kas"
                        class="filter-btn px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">Kas</button>
                </div>
            </div>

            {{-- ================= TABLE AREA ================= --}}
            <div
                class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 border border-slate-100 overflow-hidden relative">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">No
                                </th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Tipe
                                </th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nama
                                    Kantor</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                    Alamat & Lokasi</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">
                                    Hubungi</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kantorTableBody" class="divide-y divide-slate-50">
                            @forelse ($kantor as $item)
                                <tr class="kantor-row group hover:bg-slate-50/80 transition-colors"
                                    data-type="{{ strtolower($item['tipe'] ?? 'cabang') }}">

                                    <td class="px-8 py-6 font-black text-[#00326B]">
                                        {{ ($kantor->currentPage() - 1) * $kantor->perPage() + $loop->iteration }}
                                    </td>

                                    <td class="px-8 py-6">
                                        <span
                                            class="inline-flex px-3 py-1 rounded-lg bg-blue-50 text-blue-700 text-[9px] font-black uppercase tracking-widest border border-blue-100">
                                            {{ $item['tipe'] ?? 'Cabang' }}
                                        </span>
                                    </td>

                                    <td class="px-8 py-6">
                                        <div class="font-black text-[#00326B] leading-tight">{{ $item['nama'] }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                            {{ $item['kode'] ?? '' }}</div>
                                    </td>

                                    <td class="px-8 py-6 max-w-xs lg:max-w-md">
                                        <div class="flex gap-2">
                                            <i class="bi bi-geo-alt-fill text-[#fbbf24] mt-1"></i>
                                            <div>
                                                <p class="text-sm font-bold text-slate-600 leading-snug">
                                                    {{ $item['alamat'] ?? '-' }}</p>
                                                <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider">
                                                    {{ $item['kota'] ?? 'NTB' }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-6 text-center">
                                        @if (!empty($item['telepon']))
                                            <a href="tel:{{ $item['telepon'] }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-xs hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                                <i class="bi bi-telephone-fill"></i>
                                                <span>{{ $item['telepon'] }}</span>
                                            </a>
                                        @else
                                            <span class="text-slate-300 italic text-xs">N/A</span>
                                        @endif
                                    </td>

                                    <td class="px-8 py-6 text-center">
                                        <button
                                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#00326B] text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-blue-900/20 hover:scale-105 active:scale-95 transition-all"
                                            onclick='openMapModal(@json($item))'>
                                            <i class="bi bi-map-fill"></i> Lihat Peta
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div
                                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-3xl">
                                            <i class="bi bi-building-x"></i>
                                        </div>
                                        <p class="font-bold text-slate-400">Data kantor tidak ditemukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ================= PAGINATION ================= --}}
                @if ($kantor->hasPages())
                    <div
                        class="px-8 py-6 bg-slate-50/50 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                            Showing {{ $kantor->firstItem() }} - {{ $kantor->lastItem() }} of {{ $kantor->total() }}
                            Offices
                        </p>
                        <div class="pagination-wrapper">
                            {{ $kantor->links('pagination::tailwind') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    {{-- ================= MAP MODAL ================= --}}
    <div id="mapModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

            {{-- Modal Content --}}
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-white">

                <div class="bg-[#00326B] px-8 py-6 flex justify-between items-center">
                    <h3 class="text-white font-black uppercase tracking-widest text-sm flex items-center gap-3">
                        <i class="bi bi-geo-alt-fill text-[#fbbf24]"></i>
                        <span id="modalKantorName">Lokasi Kantor</span>
                    </h3>
                    <button onclick="closeModal()" class="text-white/50 hover:text-white transition-colors">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <div class="p-0 relative">
                    <div id="map" class="h-[400px]"></div>

                    {{-- Info Overlay --}}
                    <div class="bg-white px-8 py-8">
                        <div class="flex flex-col md:flex-row justify-between gap-6">
                            <div class="flex-1">
                                <h6 class="text-xl font-black text-[#00326B] mb-2" id="modalKantorFullName">Nama Kantor</h6>
                                <p class="text-slate-500 font-medium leading-relaxed" id="modalKantorAlamat"></p>
                            </div>
                            <div class="flex flex-col gap-3 min-w-[200px]">
                                <div class="flex items-center gap-3 text-xs font-bold text-slate-600">
                                    <i class="bi bi-clock-fill text-blue-600"></i>
                                    <span id="modalKantorJam">08:00 - 15:30 WITA</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs font-bold text-slate-600">
                                    <i class="bi bi-telephone-fill text-emerald-600"></i>
                                    <span id="modalKantorTelepon"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-100 flex justify-end gap-4">
                            <button onclick="shareLocation()"
                                class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all">
                                <i class="bi bi-share me-2"></i> Share
                            </button>
                            <button onclick="getDirections()"
                                class="px-8 py-3 rounded-xl bg-[#fbbf24] text-[#00326B] font-black text-[10px] uppercase tracking-widest shadow-lg shadow-yellow-500/20 hover:scale-105 active:scale-95 transition-all">
                                <i class="bi bi-compass-fill me-2"></i> Dapatkan Rute
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .filter-btn {
            color: #64748B;
            font-family: inherit;
        }

        .filter-btn.active {
            background-color: #00326B;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 50, 107, 0.2);
        }

        .filter-btn:not(.active):hover {
            background-color: #F1F5F9;
            color: #00326B;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Pastikan fungsi modal dan peta sudah ada di JS Anda.
        // Contoh sederhana toggle modal Tailwind:
        function openMapModal(data) {
            const modal = document.getElementById('mapModal');
            modal.classList.remove('hidden');
            document.getElementById('modalKantorName').innerText = data.tipe || 'Kantor';
            document.getElementById('modalKantorFullName').innerText = data.nama;
            document.getElementById('modalKantorAlamat').innerText = data.alamat;
            document.getElementById('modalKantorTelepon').innerText = data.telepon || '-';
            // Inisialisasi Peta Leaflet Anda di sini...
        }

        function closeModal() {
            document.getElementById('mapModal').classList.add('hidden');
        }
    </script>
@endpush
