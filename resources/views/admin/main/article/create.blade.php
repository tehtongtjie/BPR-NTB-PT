@extends('admin.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="dashboard-card">

    <div class="card-header-admin mb-4">
        <h4>Tambah Artikel</h4>
    </div>

    <form action="{{ route('admin.main.article.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- JUDUL --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        {{-- GAMBAR --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        {{-- KONTEN --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Konten Artikel</label>
            <textarea name="content" rows="6"
                      class="form-control" required></textarea>
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        {{-- ACTION --}}
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.main.index') }}"
               class="btn btn-outline-secondary">
                Kembali
            </a>
        </div>

    </form>
</div>
@endsection
