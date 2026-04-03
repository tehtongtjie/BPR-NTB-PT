@extends('admin.layouts.app')

@section('title', 'Tambah Promo')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Promo
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Kelola informasi promo, produk, keuntungan, dan syarat dengan rapi
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.main.promo.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @include('admin.components.form-errors')

        {{-- ================= JUDUL PROMO ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Judul Promo
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   placeholder="Contoh: Tabungan SIMBADA"
                   required
                   class="w-full rounded-xl
                          bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          placeholder:text-slate-400
                          focus:bg-white
                          focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10
                          transition-all duration-200 ease-out">
            @error('title')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        {{-- ================= SUBTITLE PROMO ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Subtitle Promo
            </label>
            <input type="text"
                name="subtitle"
                value="{{ old('subtitle') }}"
                placeholder="Contoh: Tabungan SIMBADA BPR NTB"
                class="w-full rounded-xl
                        bg-slate-50 border border-slate-200
                        px-4 py-2.5 text-slate-700
                        placeholder:text-slate-400
                        focus:bg-white
                        focus:border-[#00326B]
                        focus:ring-4 focus:ring-[#00326B]/10
                        transition-all duration-200 ease-out">
        </div>

        {{-- ================= DESKRIPSI SINGKAT ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Deskripsi Singkat
            </label>
            <textarea name="short_desc"
                      rows="3"
                      required
                      placeholder="Ringkasan singkat promo untuk tampilan awal"
                      class="w-full rounded-xl
                             bg-slate-50 border border-slate-200
                             px-4 py-3 text-slate-700
                             placeholder:text-slate-400
                             focus:bg-white
                             focus:border-[#00326B]
                             focus:ring-4 focus:ring-[#00326B]/10
                             transition-all duration-200 resize-none">{{ old('short_desc') }}</textarea>
            @error('short_desc')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- ================= INFORMASI PRODUK ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Informasi Produk
            </label>
            <textarea name="description"
                     rows="5"
                     placeholder="Penjelasan detail mengenai produk promo"
                     class="w-full rounded-xl
                             bg-slate-50 border border-slate-200
                             px-4 py-3 text-slate-700
                             placeholder:text-slate-400
                             focus:bg-white
                             focus:border-[#00326B]
                             focus:ring-4 focus:ring-[#00326B]/10
                             transition-all duration-200 resize-none">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- ================= KEUNTUNGAN & FASILITAS ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Keuntungan & Fasilitas
            </label>

            <div id="benefit-wrapper" class="space-y-3">

                {{-- ITEM --}}
                <div class="flex items-center gap-2">
                    <input type="text"
                        name="benefits[]"
                        placeholder="Contoh: Bebas biaya administrasi"
                        class="flex-1 rounded-xl
                                bg-slate-50 border border-slate-200
                                px-4 py-2.5 text-slate-700
                                focus:bg-white
                                focus:border-[#00326B]
                                focus:ring-4 focus:ring-[#00326B]/10
                                transition">

                    <button type="button"
                            onclick="removeBenefit(this)"
                            class="hidden rounded-xl border border-red-200
                                bg-red-50 px-3 py-2
                                text-red-600 hover:bg-red-100 transition">
                        ✕
                    </button>
                </div>

            </div>

            {{-- ADD BUTTON --}}
            <button type="button"
                    onclick="addBenefit()"
                    class="inline-flex items-center gap-2
                        rounded-xl border border-slate-200
                        bg-slate-50 px-4 py-2
                        text-sm font-medium text-slate-600
                        hover:bg-slate-100 transition">
                + Tambah Keuntungan
            </button>
        </div>

        {{-- ================= SYARAT & KETENTUAN ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Syarat & Ketentuan
            </label>

            <div id="requirement-wrapper" class="space-y-3">

                <div class="flex items-center gap-2">
                    <input type="text"
                        name="requirements[]"
                        placeholder="Contoh: Warga Negara Indonesia (WNI)"
                        class="flex-1 rounded-xl
                                bg-slate-50 border border-slate-200
                                px-4 py-2.5 text-slate-700
                                focus:bg-white
                                focus:border-[#00326B]
                                focus:ring-4 focus:ring-[#00326B]/10
                                transition">

                    <button type="button"
                            onclick="removeRequirement(this)"
                            class="hidden rounded-xl border border-red-200
                                bg-red-50 px-3 py-2
                                text-red-600 hover:bg-red-100 transition">
                        ✕
                    </button>
                </div>

            </div>

            <button type="button"
                    onclick="addRequirement()"
                    class="inline-flex items-center gap-2
                        rounded-xl border border-slate-200
                        bg-slate-50 px-4 py-2
                        text-sm font-medium text-slate-600
                        hover:bg-slate-100 transition">
                + Tambah Syarat
            </button>
        </div>


        {{-- ================= GAMBAR PROMO ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Gambar Promo
            </label>

            <input type="file"
                   name="image"
                   accept="image/*"
                   required
                   class="block w-full text-sm text-slate-600
                          file:mr-4 file:rounded-xl
                          file:border-0
                          file:bg-[#00326B]/10
                          file:px-4 file:py-2
                          file:text-sm file:font-medium
                          file:text-[#00326B]
                          hover:file:bg-[#00326B]/20
                          transition">
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Status Promo
            </label>
            <select name="is_active"
                    class="w-full rounded-xl
                           bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white
                           focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10
                           transition-all duration-200">
                <option value="1" {{ old('is_active', '1') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('is_active')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- ================= ACTION BUTTON ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#00326B] px-6 py-2.5
                           text-sm font-medium text-white
                           hover:bg-[#002855]
                           focus:ring-4 focus:ring-[#00326B]/20
                           transition">
                Simpan Promo
            </button>

            <a href="{{ route('admin.main.promo.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>
        </div>

    </form>

</div>
{{-- ================= JS ================= --}}
    <script>
        function addBenefit() {
            const wrapper = document.getElementById('benefit-wrapper');

            const item = document.createElement('div');
            item.className = 'flex items-center gap-2';

            item.innerHTML = `
                <input type="text"
                    name="benefits[]"
                    placeholder="Contoh: Suku bunga kompetitif"
                    class="flex-1 rounded-xl
                            bg-slate-50 border border-slate-200
                            px-4 py-2.5 text-slate-700
                            focus:bg-white
                            focus:border-[#00326B]
                            focus:ring-4 focus:ring-[#00326B]/10
                            transition">

                <button type="button"
                        onclick="removeBenefit(this)"
                        class="rounded-xl border border-red-200
                            bg-red-50 px-3 py-2
                            text-red-600 hover:bg-red-100 transition">
                    ✕
                </button>
            `;

            wrapper.appendChild(item);
        }

        function removeBenefit(button) {
            button.parentElement.remove();
        }
        function addRequirement() {
            document.getElementById('requirement-wrapper')
                .insertAdjacentHTML('beforeend', `
                <div class="flex items-center gap-2">
                    <input type="text" name="requirements[]"
                        class="flex-1 rounded-xl bg-slate-50 border border-slate-200
                                px-4 py-2.5 focus:ring-4 focus:ring-[#00326B]/10">
                    <button type="button"
                            onclick="removeRequirement(this)"
                            class="rounded-xl bg-red-50 px-3 py-2 text-red-600">
                        ✕
                    </button>
                </div>
            `);
        }

        function removeRequirement(el) {
            el.parentElement.remove();
        }
    </script>

@endsection
