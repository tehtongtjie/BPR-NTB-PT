@extends('admin.layouts.app')

@section('title', 'Lowongan Kerja')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Lowongan Kerja
                </h2>
                <p class="text-sm text-slate-500">
                    Kelola publikasi karier BPR NTB secara terpusat.
                </p>
            </div>

            <a href="{{ route('admin.jobs.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-[#00326B] px-4 py-2 text-sm font-semibold text-white hover:bg-[#002855] transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Lowongan
            </a>
        </div>

        {{-- CARD --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- FILTER --}}
            <form method="GET"
                class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-slate-200">

                <input type="text" name="q" value="{{ $search }}" placeholder="Cari posisi atau lokasi..."
                    class="w-full md:w-60 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">

                <select name="type"
                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">
                    <option value="">Semua Jenis</option>
                    @foreach ($typeOptions as $option)
                        <option value="{{ $option }}" @selected($type === $option)>{{ $option }}</option>
                    @endforeach
                </select>

                <select name="status"
                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">
                    <option value="">Semua Status</option>
                    @foreach ($statusOptions as $key => $label)
                        <option value="{{ $key }}" @selected($status === $key)>{{ $label }}</option>
                    @endforeach
                </select>

                <label class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-600 cursor-pointer hover:bg-slate-50 transition">
                    <input type="checkbox" name="featured" value="1" @checked($featured === '1')
                        class="rounded text-[#00326B] focus:ring-[#00326B]">
                    Featured
                </label>

                <button type="submit"
                    class="rounded-lg bg-[#00326B] px-4 py-2 text-sm font-semibold text-white hover:bg-[#002855] transition">
                    Filter
                </button>
            </form>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">No</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Informasi Posisi</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Tipe / Gaji</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Link Lamar</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Deadline</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($jobs as $job)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-0.5">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-800">{{ $job->title }}</span>
                                            @if ($job->is_featured)
                                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-bold bg-amber-50 text-amber-700 uppercase tracking-wider">
                                                    ★ Featured
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-slate-400">{{ $job->location ?? 'Remote / Pusat' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-0.5">
                                        <span class="font-semibold text-slate-800">{{ $job->category }}</span>
                                        <span class="text-xs text-slate-400">{{ $job->salary_range ?? 'Kompetitif' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($job->url_recruits)
                                        <a href="{{ $job->url_recruits }}" target="_blank"
                                            class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-bold bg-blue-50 text-blue-700 hover:bg-blue-100 transition uppercase tracking-wider">
                                            Lihat Link
                                        </a>
                                    @else
                                        <span class="text-slate-400 italic text-xs">Internal Only</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $job->deadline?->translatedFormat('d M Y') ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wider
                                        {{ $job->status === 'active' ? 'bg-emerald-50 text-emerald-700' : ($job->status === 'closed' ? 'bg-red-50 text-red-600' : 'bg-slate-50 text-slate-500') }}">
                                        {{ $statusOptions[$job->status] ?? $job->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                                                    <div class="flex justify-end gap-2">
                                                                        <a href="{{ route('admin.jobs.edit', $job) }}"
                                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-yellow-200 bg-yellow-50 text-yellow-700 hover:bg-yellow-100 transition">
                                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                            </svg>
                                                                        </a>
                                                                        <form id="delete-job-{{ $job->id }}"
                                                                            action="{{ route('admin.jobs.destroy', $job) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button"
                                                                                onclick="confirmDeleteJob('{{ $job->id }}', '{{ addslashes($job->title) }}')"
                                                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-100 transition">
                                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-14 text-center text-slate-500">
                                    Belum ada data lowongan ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if ($jobs->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $jobs->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDeleteJob(id, title) {
            Swal.fire({
                title: 'Hapus Lowongan?',
                html: `Apakah Anda yakin ingin menghapus lowongan <strong>"${title}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-job-' + id).submit();
                }
            });
        }
    </script>
@endpush