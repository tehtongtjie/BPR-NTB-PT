@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">

    {{-- HEADER --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-3xl font-black text-[#00326B] tracking-tight flex items-center gap-3">
                <i class="bi bi-chat-dots-fill text-blue-600"></i>
                Message Masuk
            </h1>
            <p class="text-slate-500 font-medium flex items-center gap-2 text-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Pesan dari pengunjung website
            </p>
        </div>

        <div
            class="bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-white shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                <i class="bi bi-envelope-fill"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Total Pesan</p>
                <p class="text-lg font-black text-slate-700">{{ $messages->count() }}</p>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div
        class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50/50 border-b border-slate-100 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                        <th class="px-8 py-6">Tanggal</th>
                        <th class="px-8 py-6">Pengirim</th>
                        <th class="px-8 py-6">Pesan</th>
                        <th class="px-8 py-6 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-50">
                    @forelse ($messages as $message)
                        <tr class="bg-white hover:bg-blue-50/30 transition-all duration-300 group">

                            {{-- TANGGAL --}}
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-700">
                                    {{ $message->created_at->translatedFormat('d F Y') }}
                                </span>

                                @if ($message->status === 'baru')
                                    <span
                                        class="inline-flex mt-1 px-3 py-1 rounded-lg
                                        bg-slate-100 text-[10px] font-black text-slate-600 uppercase">
                                        Baru
                                    </span>
                                @endif
                            </td>

                            {{-- PENGIRIM --}}
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="font-bold text-[#00326B]">{{ $message->name }}</span>
                                    <span class="text-[11px] text-slate-400">{{ $message->email }}</span>
                                    @if ($message->phone)
                                        <span class="text-[11px] text-slate-400">
                                            <i class="bi bi-telephone-fill mr-1"></i>{{ $message->phone }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- RINGKAS PESAN --}}
                            <td class="px-8 py-6">
                                <p class="text-sm text-slate-600 line-clamp-2">
                                    {{ $message->message }}
                                </p>
                            </td>

                            {{-- AKSI --}}
                            <td class="px-8 py-6 text-center">
                                <div class="flex items-center justify-center gap-3">

                                    {{-- VIEW (kalau mau pakai modal lagi) --}}
                                    {{-- 
                                    <button type="button"
                                        onclick="openModalMessage('{{ $message->id }}')"
                                        class="p-3 bg-[#00326B] text-white rounded-2xl
                                        hover:bg-blue-700 transition-all duration-300 shadow-lg shadow-blue-900/20">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    --}}

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.messages.destroy', $message->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="p-3 bg-red-500 text-white rounded-2xl
                                            hover:bg-red-600 transition-all duration-300 shadow-lg shadow-red-500/20">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-inbox-fill text-4xl text-slate-200"></i>
                                    </div>
                                    <p class="font-black uppercase tracking-widest text-slate-400 text-xs">
                                        Belum Ada Pesan Masuk
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
@foreach ($messages as $message)
<div id="modal-message-{{ $message->id }}"
    class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4"
    onclick="handleBackdrop(event, '{{ $message->id }}')"
    style="background: rgba(0, 50, 107, 0.4); backdrop-filter: blur(12px);">

    <div
        class="modal-box transform scale-95 opacity-0 transition-all duration-300
        bg-white rounded-[3rem] w-full max-w-2xl shadow-xl overflow-hidden">

        {{-- HEADER --}}
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <div>
                <h3 class="font-black text-[#00326B] text-lg uppercase">Detail Pesan</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase">
                    ID #MSG-{{ $message->id }}
                </p>
            </div>
            <button onclick="closeModalMessage('{{ $message->id }}')"
                class="w-12 h-12 rounded-2xl hover:bg-red-50 text-slate-400">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        {{-- BODY --}}
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-[#F8FAFC] rounded-2xl">
                    <p class="text-[9px] font-black text-slate-400 uppercase">Nama</p>
                    <p class="font-bold">{{ $message->name }}</p>
                </div>
                <div class="p-4 bg-[#F8FAFC] rounded-2xl">
                    <p class="text-[9px] font-black text-slate-400 uppercase">Email</p>
                    <p class="font-bold">{{ $message->email }}</p>
                </div>
            </div>

            <div class="p-6 bg-blue-50/30 rounded-3xl border border-blue-100 text-center">
                <p class="italic text-slate-700 text-lg">
                    "{{ $message->message }}"
                </p>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="p-8 bg-slate-50 border-t border-slate-100">
            <button onclick="closeModalMessage('{{ $message->id }}')"
                class="w-full py-5 bg-[#00326B] text-white rounded-2xl font-black uppercase tracking-widest">
                Tutup
            </button>
        </div>
    </div>
</div>
@endforeach

{{-- SCRIPT --}}
<script>
    function openModalMessage(id) {
        const modal = document.getElementById('modal-message-' + id);
        const box = modal.querySelector('.modal-box');

        modal.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
        }, 50);

        document.body.classList.add('overflow-hidden');
    }

    function closeModalMessage(id) {
        const modal = document.getElementById('modal-message-' + id);
        const box = modal.querySelector('.modal-box');

        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    function handleBackdrop(e, id) {
        if (e.target.id === 'modal-message-' + id) {
            closeModalMessage(id);
        }
    }
</script>
@endsection
