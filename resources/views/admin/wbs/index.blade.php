@extends('admin.layouts.app')

@section('content')
    <div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">

        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h1 class="text-3xl font-black text-[#00326B] tracking-tight flex items-center gap-3">
                    <i class="bi bi-shield-lock-fill text-blue-600"></i>
                    Whistle Blowing System
                </h1>
                <p class="text-slate-500 font-medium flex items-center gap-2 text-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Monitoring Pelanggaran Kode Etik Internal PT. BPR NTB
                </p>
            </div>

            <div
                class="bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-white shadow-sm flex items-center gap-3 transition-all hover:shadow-md">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1">Total Laporan</p>
                    <p class="text-lg font-black text-slate-700 leading-none">{{ $reports->count() }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 border border-slate-100 overflow-hidden transition-all duration-500">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 border-b border-slate-100 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <th class="px-8 py-6">Insiden</th>
                            <th class="px-8 py-6">Informasi Pelapor</th>
                            <th class="px-8 py-6">Pihak Terlapor</th>
                            <th class="px-8 py-6 text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($reports as $report)
                            <tr class="hover:bg-blue-50/30 transition-all duration-300 group">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-black text-slate-700">{{ $report->created_at->translatedFormat('d F Y') }}</span>
                                        <span
                                            class="inline-flex mt-1.5 px-3 py-1 rounded-lg bg-red-50 text-[10px] font-black text-red-600 border border-red-100 w-fit uppercase">
                                            <i class="bi bi-exclamation-triangle-fill mr-1.5"></i>
                                            {{ $report->kategori }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    @if (auth()->user()?->role == 'super_admin')
                                        <div class="flex items-center gap-3 text-sm font-bold text-[#00326B]">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-[12px] shadow-inner">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                            {{ $report->nama ? Crypt::decryptString($report->nama) : 'Anonim' }}
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center gap-3 px-4 py-2 bg-slate-100 rounded-xl w-fit border border-slate-200">
                                            <i class="bi bi-shield-fill-check text-slate-400"></i>
                                            <span
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic tracking-tight">Terproteksi</span>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-slate-700 leading-tight">{{ $report->nama_terlapor }}</span>
                                        <span class="text-[11px] text-slate-400 font-medium mt-1">
                                            <i class="bi bi-geo-alt-fill mr-1 text-blue-300"></i>
                                            {{ $report->lokasi_kejadian }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <button type="button" onclick="openModalWbs('{{ $report->id }}')"
                                        class="group-hover:scale-110 transition-all duration-300 p-3 bg-[#00326B] text-white rounded-2xl shadow-lg shadow-blue-900/20 hover:bg-yellow-400 hover:text-blue-900 focus:ring-4 focus:ring-blue-100">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-32 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="bi bi-inbox-fill text-4xl text-slate-200"></i>
                                        </div>
                                        <p class="font-black uppercase tracking-widest text-slate-400 text-xs">Belum Ada
                                            Laporan Masuk</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($reports as $report)
        <div id="modal-wbs-{{ $report->id }}"
            class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 transition-all duration-300"
            onclick="handleBackdropClick(event, '{{ $report->id }}')"
            style="background: rgba(0, 50, 107, 0.4); backdrop-filter: blur(12px);">

            <div
                class="modal-content-container transform transition-all duration-300 scale-95 opacity-0 bg-white rounded-[3rem] w-full max-w-2xl shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)] overflow-hidden border border-white/20">

                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                            <i class="bi bi-flag-fill"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-[#00326B] text-lg leading-tight uppercase tracking-tight">Detail
                                Laporan</h3>
                            <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">ID Transaksi
                                #WBS-{{ $report->id }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeModalWbs('{{ $report->id }}')"
                        class="w-12 h-12 flex items-center justify-center rounded-2xl hover:bg-red-50 hover:text-red-500 text-slate-400 transition-all duration-300">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <div class="p-8 space-y-8">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-1 p-5 bg-[#F8FAFC] rounded-3xl border border-slate-100">
                            <span
                                class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 text-center">Tanggal
                                Laporan</span>
                            <span
                                class="text-xs font-bold text-[#00326B] block text-center uppercase">{{ $report->created_at->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="space-y-1 p-5 bg-[#F8FAFC] rounded-3xl border border-slate-100">
                            <span
                                class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-2 text-center">Kategori
                                Insiden</span>
                            <span
                                class="text-xs font-bold text-red-600 block text-center uppercase">{{ $report->kategori }}</span>
                        </div>
                    </div>

                    <div class="relative group">
                        <div
                            class="absolute -top-3 left-6 px-4 py-1 bg-[#00326B] text-white rounded-full text-[9px] font-black uppercase tracking-widest z-10 shadow-lg">
                            Uraian Kejadian
                        </div>
                        <div
                            class="p-10 bg-blue-50/30 rounded-[2.5rem] border border-blue-100 text-center relative overflow-hidden">
                            <i class="bi bi-quote absolute -left-2 -top-2 text-8xl text-blue-100 opacity-50"></i>
                            <p class="text-slate-700 font-bold italic text-lg leading-relaxed relative z-10">
                                "{{ $report->laporan }}"
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-[11px] font-black uppercase tracking-wider">
                        <div class="flex items-center gap-3 p-5 border border-slate-100 rounded-2xl bg-white shadow-sm">
                            <i class="bi bi-geo-alt-fill text-blue-500"></i>
                            <div class="flex flex-col">
                                <span class="text-[8px] text-slate-300">Lokasi</span>
                                <span>{{ $report->lokasi_kejadian }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-5 border border-slate-100 rounded-2xl bg-white shadow-sm">
                            <i class="bi bi-person-badge-fill text-blue-500"></i>
                            <div class="flex flex-col">
                                <span class="text-[8px] text-slate-300">Terlapor</span>
                                <span>{{ $report->nama_terlapor }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-slate-50/80 border-t border-slate-100">
                    <button type="button" onclick="closeModalWbs('{{ $report->id }}')"
                        class="w-full py-5 bg-[#00326B] text-white rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-blue-800 transition-all duration-300 shadow-xl shadow-blue-900/20 active:scale-[0.98]">
                        Selesai Meninjau Laporan
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .modal-show {
            display: flex !important;
        }

        .modal-anim-in {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        /* Smooth transition for body scroll */
        body.modal-open {
            overflow: hidden;
            padding-right: 15px;
        }

        /* Prevent layout shift if scrollbar disappears */
    </style>

    <script>
        /**
         * Membuka Modal
         */
        function openModalWbs(id) {
            const modal = document.getElementById('modal-wbs-' + id);
            const content = modal.querySelector('.modal-content-container');

            modal.classList.add('modal-show');
            setTimeout(() => {
                content.classList.add('modal-anim-in');
            }, 50);

            document.body.classList.add('modal-open');
        }

        /**
         * Menutup Modal
         */
        function closeModalWbs(id) {
            const modal = document.getElementById('modal-wbs-' + id);
            const content = modal.querySelector('.modal-content-container');

            content.classList.remove('modal-anim-in');
            setTimeout(() => {
                modal.classList.remove('modal-show');
                document.body.classList.remove('modal-open');
            }, 300);
        }

        /**
         * Menangani Klik pada Backdrop (Luar Modal)
         */
        function handleBackdropClick(event, id) {
            if (event.target.id === 'modal-wbs-' + id) {
                closeModalWbs(id);
            }
        }

        /**
         * Menutup dengan tombol Escape
         */
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                const openModal = document.querySelector('.modal-show');
                if (openModal) {
                    const id = openModal.id.replace('modal-wbs-', '');
                    closeModalWbs(id);
                }
            }
        });
    </script>
@endsection
