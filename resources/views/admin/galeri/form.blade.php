@php
    $galeri = isset($galeri) ? $galeri : null;
    $isEdit = $galeri !== null;
    $actionRoute = $isEdit ? route('admin.galeri.update', $galeri) : route('admin.galeri.store');
    $defaultType = $isEdit ? $galeri->type : 'foto';
    $defaultPublished = $isEdit && optional($galeri)->published_at
        ? $galeri->published_at->format('Y-m-d\TH:i')
        : old('published_at');
    $mediaOptions = [
        'foto' => ['label' => 'Foto', 'icon' => 'bi-images'],
        'video' => ['label' => 'Video', 'icon' => 'bi-camera-reels'],
    ];
    $selectedType = old('type', $defaultType);
    $selectedCategory = old('category', optional($galeri)->category ?? '');
    $categoryList = $categories ?? collect();
@endphp

<form action="{{ $actionRoute }}" method="POST" enctype="multipart/form-data"
    class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Judul Kegiatan</label>
        <input type="text" name="title" value="{{ old('title', optional($galeri)->title ?? '') }}" required
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700
                   focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Kategori</label>
        @if ($categoryList->isNotEmpty())
            <select name="category" required
                class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-700
                       focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="" {{ $selectedCategory === '' ? 'selected' : '' }}>Pilih Kategori</option>
                @foreach ($categoryList as $cat)
                    <option value="{{ $cat }}" {{ $selectedCategory === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        @else
            <input type="text" name="category" value="{{ $selectedCategory }}"
                class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-700
                       focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
        @endif
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Tipe Media</label>
        <div class="flex gap-3">
            @foreach ($mediaOptions as $value => $meta)
                <label
                    class="media-option flex-1 cursor-pointer rounded-2xl border px-4 py-3 text-sm font-semibold uppercase tracking-[0.3em] transition
                    {{ $selectedType === $value ? 'media-option--active' : '' }}">
                    <input type="radio" name="type" value="{{ $value }}" class="sr-only media-option-input" {{ $selectedType === $value ? 'checked' : '' }}>
                    <span class="flex items-center justify-center gap-3">
                        <i class="bi {{ $meta['icon'] }} text-lg"></i>
                        {{ $meta['label'] }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Tanggal Publikasi</label>
        <input type="datetime-local" name="published_at"
            value="{{ old('published_at', $defaultPublished) }}"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700
                   focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Deskripsi Singkat</label>
        <textarea name="description" rows="4"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-3 text-slate-700
                   focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">{{ old('description', optional($galeri)->description ?? '') }}</textarea>
    </div>

    <div class="space-y-1.5 video-field" style="display: {{ $selectedType === 'video' ? 'block' : 'none' }};">
        <label class="text-sm font-medium text-slate-600">Link Video (opsional)</label>
        <input type="url" name="video_url" value="{{ old('video_url', optional($galeri)->video_url ?? '') }}"
            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700
                   focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-slate-600">Thumbnail</label>
        @if ($isEdit && $galeri->thumbnail)
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . optional($galeri)->thumbnail) }}" alt="Thumbnail"
                    class="h-16 w-16 rounded-2xl object-cover border border-slate-200">
                <span class="text-xs text-slate-500">Unggah ulang untuk mengganti gambar.</span>
            </div>
        @endif
        <input type="file" name="thumbnail" {{ $isEdit ? '' : 'required' }}
            accept="image/*"
            class="w-full rounded-xl bg-slate-50 border border-dashed border-slate-300 px-4 py-2 text-sm text-slate-700
                   focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Status</label>
            <select name="is_published"
                class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-700
                       focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="1" {{ old('is_published', optional($galeri)->is_published ?? 1) ? 'selected' : '' }}>Terbit</option>
                <option value="0" {{ !old('is_published', optional($galeri)->is_published ?? 1) ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
    </div>

    <div class="flex items-center gap-3 pt-4">
        <button type="submit"
            class="rounded-xl bg-[#00326B] px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-[#002855]">
            {{ $isEdit ? 'Perbarui Galeri' : 'Simpan Galeri' }}
        </button>

        <a href="{{ route('admin.galeri.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Batal
        </a>
    </div>
</form>

@push('styles')
<style>
    .media-option {
        border-color: #cbd5f5;
        color: #334155;
    }

    .media-option--active {
        border-color: #00326B !important;
        background-color: #00326B !important;
        color: #fff !important;
        box-shadow: 0 10px 30px rgba(0, 50, 107, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.media-option-input');
        const videoField = document.querySelector('.video-field');
        const videoInput = document.querySelector('input[name=\"video_url\"]');

        const refresh = () => {
            inputs.forEach((input) => {
                const label = input.closest('.media-option');
                if (!label) return;
                if (input.checked) {
                    label.classList.add('media-option--active');
                } else {
                    label.classList.remove('media-option--active');
                }
            });
        };

        const updateVideoField = () => {
            const checked = document.querySelector('input[name=\"type\"]:checked');
            if (!videoField || !checked) return;
            const isVideo = checked.value === 'video';
            videoField.style.display = isVideo ? 'block' : 'none';
            if (!videoInput) return;
            if (isVideo) {
                videoInput.removeAttribute('disabled');
            } else {
                videoInput.setAttribute('disabled', 'disabled');
            }
        };

        inputs.forEach((input) => {
            input.addEventListener('change', () => {
                refresh();
                updateVideoField();
            });
        });

        refresh();
        updateVideoField();
    });
</script>
@endpush
