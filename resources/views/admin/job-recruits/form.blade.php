@php
    $job = $jobRecruit ?? null;
    $isEdit = $job !== null;
    $actionRoute = $isEdit ? route('admin.jobs.update', $job) : route('admin.jobs.store');
    $selectedStatus = old('status', $job?->status ?? 'draft');
    $deadlineValue = old('deadline', $job?->deadline?->format('Y-m-d'));
    $featuredChecked = old('is_featured', $job?->is_featured ?? false);
    $statusOptions = $statusOptions ?? [
        'active' => 'Aktif',
        'closed' => 'Ditutup',
        'draft' => 'Draft',
    ];
    $typeOptions = $typeOptions ?? ['Full-time', 'Part-time', 'Contract', 'Internship'];
@endphp

<form action="{{ $actionRoute }}" method="POST" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-5">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Judul Lowongan</label>
        <input type="text" name="title" value="{{ old('title', $job?->title ?? '') }}" required
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Jenis</label>
        <select name="category"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
            @foreach ($typeOptions as $option)
                <option value="{{ $option }}" {{ old('category', $job?->category ?? 'Full-time') === $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Lokasi</label>
        <input type="text" name="location" value="{{ old('location', $job?->location ?? '') }}"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
    </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Range Gaji</label>
            <input type="text" name="salary_range" value="{{ old('salary_range', $job?->salary_range ?? '') }}"
                class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Deadline</label>
            <input type="date" name="deadline" value="{{ $deadlineValue }}"
                class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Link Lamar Sekarang</label>
        <input type="url" name="url_recruits" value="{{ old('url_recruits', $job?->url_recruits ?? '') }}"
            placeholder="https://"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
        <p class="text-[11px] text-slate-400">Biarkan kosong jika ingin menggunakan tautan default HR.</p>
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Deskripsi</label>
        <textarea name="description" rows="4"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-3 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition" required>{{ old('description', $job?->description ?? '') }}</textarea>
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Persyaratan (HTML boleh)</label>
        <textarea name="requirements" rows="4"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-3 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">{{ old('requirements', $job?->requirements ?? '') }}</textarea>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Status</label>
            <select name="status"
                class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
                @foreach ($statusOptions as $key => $label)
                    <option value="{{ $key }}" {{ $selectedStatus === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="space-y-1.5 flex items-end">
            <label class="flex items-center gap-3 text-sm font-semibold text-slate-600">
                <input type="checkbox" name="is_featured" value="1" {{ $featuredChecked ? 'checked' : '' }}>
                Tandai sebagai Featured
            </label>
        </div>
    </div>

    <div class="flex items-center gap-3 pt-4">
        <button type="submit"
            class="rounded-xl bg-[#00326B] px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-[#002855]">
            {{ $isEdit ? 'Perbarui Lowongan' : 'Simpan Lowongan' }}
        </button>

        <a href="{{ route('admin.jobs.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Batal
        </a>
    </div>
</form>
