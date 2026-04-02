@extends('admin.layouts.app')

@section('title', 'Message Masuk')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Message Masuk
                </h2>
                <p class="text-sm text-slate-500">
                    Kelola pesan yang masuk dari pengguna dan tentukan pesan mana yang akan ditampilkan sebagai story.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <div class="bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm flex flex-col items-end">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 leading-none mb-1">Total Pesan</p>
                    <p class="text-xl font-black text-[#00326B] leading-none">{{ $messages->total() }}</p>
                </div>
            </div>
        </div>

        {{-- BULK FORM (DIPISAH) --}}
        <form id="story-form" action="{{ route('admin.messages.bulkStory') }}" method="POST">
            @csrf
        </form>

        {{-- CARD --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- FILTER & BULK ACTIONS --}}
            <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-4 border-b border-slate-200">
                <form method="GET" action="{{ route('admin.messages.index') }}" class="flex flex-wrap items-center gap-3">
                    <select name="category"
                        class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $key => $label)
                            <option value="{{ $key }}" @selected(request('category') === $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <select name="is_story"
                        class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">
                        <option value="">Semua Status</option>
                        <option value="1" @selected(request('is_story') === '1')>Story</option>
                        <option value="0" @selected(request('is_story') === '0')>Bukan Story</option>
                    </select>

                    <button type="submit"
                        class="rounded-lg bg-[#00326B] px-4 py-2 text-sm font-semibold text-white hover:bg-[#002855] transition">
                        Filter
                    </button>
                </form>

                <div class="flex items-center gap-2">
                    <button type="submit" form="story-form" name="is_story" value="1"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-100 transition border border-blue-100">
                        Mark Story
                    </button>
                    <button type="submit" form="story-form" name="is_story" value="0"
                        class="inline-flex items-center gap-2 rounded-lg bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition border border-slate-200">
                        Remove Story
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 w-12 text-center">
                                <input type="checkbox" id="select-all" class="rounded border-slate-300 text-[#00326B] focus:ring-[#00326B]">
                            </th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Pengirim</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Kategori</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Isi Pesan</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($messages as $message)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $message->id }}" form="story-form"
                                        class="rounded border-slate-300 text-[#00326B] focus:ring-[#00326B]">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800">{{ $message->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $message->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                        {{ $categories[$message->category] ?? $message->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                    {{ Str::limit($message->message, 60) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider {{ $message->is_story ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-50 text-slate-400' }}">
                                        {{ $message->is_story ? 'STORY' : 'REGULAR' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <form id="delete-message-{{ $message->id }}" 
                                              action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="page" value="{{ request('page') }}">
                                            <button type="button"
                                                onclick="confirmDeleteMessage('{{ $message->id }}', '{{ addslashes($message->name) }}')"
                                                class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-red-600 hover:bg-red-100 transition text-xs font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-14 text-center text-slate-500">
                                    Belum ada pesan masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if ($messages->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Select All Checkbox
        document.getElementById('select-all')?.addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="ids[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        // SweetAlert Delete Confirmation
        function confirmDeleteMessage(id, name) {
            Swal.fire({
                title: 'Hapus Pesan?',
                html: `Apakah Anda yakin ingin menghapus pesan dari <strong>"${name}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-message-' + id).submit();
                }
            });
        }
    </script>
@endpush