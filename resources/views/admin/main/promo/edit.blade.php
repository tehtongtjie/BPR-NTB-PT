@extends('admin.layouts.app')

@section('title', 'Edit Promo')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Edit Promo</h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi promo, keuntungan, dan syarat
            </p>
        </div>

        <a href="{{ route('admin.main.index') }}"
           class="text-sm text-slate-500 hover:text-slate-700 transition">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.main.promo.update', $promo->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= GAMBAR ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">Gambar Saat Ini</label>
            <img src="{{ asset('storage/'.$promo->image) }}"
                 class="h-32 rounded-xl border object-cover">

            <input type="file" name="image" accept="image/*"
                class="block w-full text-sm text-slate-600
                       file:mr-4 file:rounded-xl file:border-0
                       file:bg-[#00326B]/10 file:px-4 file:py-2
                       file:text-sm file:font-medium file:text-[#00326B]
                       hover:file:bg-[#00326B]/20 transition">
        </div>

        {{-- ================= JUDUL ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Judul Promo</label>
            <input type="text" name="title"
                   value="{{ old('title', $promo->title) }}"
                   class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
        </div>
        {{-- ================= SUBTITLE ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Subtitle Promo
            </label>
            <input type="text"
                name="subtitle"
                value="{{ old('subtitle', $promo->subtitle) }}"
                placeholder="Contoh: Tabungan SIMBADA BPR NTB"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                        focus:bg-white
                        focus:border-[#00326B]
                        focus:ring-4 focus:ring-[#00326B]/10
                        transition-all">
        </div>


        {{-- ================= DESKRIPSI PENDEK ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Deskripsi Singkat</label>
            <textarea name="short_desc" rows="3"
                class="w-full rounded-xl bg-slate-50 border px-4 py-3
                       focus:ring-4 focus:ring-[#00326B]/10">{{ old('short_desc', $promo->short_desc) }}</textarea>
        </div>

        {{-- ================= DESKRIPSI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Informasi Produk</label>
            <textarea name="description" rows="5"
                class="w-full rounded-xl bg-slate-50 border px-4 py-3
                       focus:ring-4 focus:ring-[#00326B]/10">{{ old('description', $promo->description) }}</textarea>
        </div>

        {{-- ================= KEUNTUNGAN ================= --}}
        @php
            $benefits = old(
                'benefits',
                $promo->benefits->pluck('title')->toArray()
            );

            if (count($benefits) === 0) {
                $benefits = [''];
            }
        @endphp

        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Keuntungan & Fasilitas
            </label>

            <div id="benefit-wrapper" class="space-y-3">
                @foreach($benefits as $benefit)
                    <div class="flex gap-2">
                        <input type="text" name="benefits[]" value="{{ $benefit }}"
                            class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5
                                   focus:ring-4 focus:ring-[#00326B]/10">
                        <button type="button" onclick="removeRow(this)"
                            class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addBenefit()"
                class="text-sm font-medium text-[#00326B] hover:underline">
                + Tambah Keuntungan
            </button>
        </div>

        {{-- ================= SYARAT ================= --}}
        @php
            $requirements = old(
                'requirements',
                $promo->requirements->pluck('title')->toArray()
            );

            if (count($requirements) === 0) {
                $requirements = [''];
            }
        @endphp

        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Syarat & Ketentuan
            </label>

            <div id="requirement-wrapper" class="space-y-3">
                @foreach($requirements as $req)
                    <div class="flex gap-2">
                        <input type="text" name="requirements[]" value="{{ $req }}"
                            class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5
                                   focus:ring-4 focus:ring-[#00326B]/10">
                        <button type="button" onclick="removeRow(this)"
                            class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addRequirement()"
                class="text-sm font-medium text-[#00326B] hover:underline">
                + Tambah Syarat
            </button>
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Status</label>
            <select name="is_active"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
                <option value="1" {{ $promo->is_active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$promo->is_active ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.main.index') }}" class="text-sm text-slate-500">Batal</a>
            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white">
                Update Promo
            </button>
        </div>
    </form>
</div>

{{-- ================= JS ================= --}}
<script>
function addRow(wrapperId, inputName, placeholder = '') {
    document.getElementById(wrapperId).insertAdjacentHTML('beforeend', `
        <div class="flex items-center gap-2">
            <input type="text"
                   name="${inputName}"
                   placeholder="${placeholder}"
                   class="flex-1 rounded-xl
                          bg-slate-50 border border-slate-200
                          px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">

            <button type="button"
                    onclick="removeRow(this)"
                    class="rounded-xl bg-red-50 px-3 py-2 text-red-600">
                ✕
            </button>
        </div>
    `);
}

function removeRow(el) {
    el.parentElement.remove();
}

// ===== SHORTCUT =====
function addBenefit() {
    addRow('benefit-wrapper', 'benefits[]', 'Contoh: Bebas biaya administrasi');
}

function addRequirement() {
    addRow('requirement-wrapper', 'requirements[]', 'Contoh: WNI');
}
</script>
@endsection
