@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="dashboard-card">

    {{-- HEADER --}}
    <div class="card-header-admin mb-4">
        <h4>Edit Banner</h4>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.main.banner.update', $banner->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- PREVIEW --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
            <img src="{{ asset('storage/'.$banner->image) }}"
                 style="max-width:300px;border-radius:12px;">
        </div>

        {{-- GANTI GAMBAR --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
            <input type="file"
                   name="image"
                   class="form-control"
                   accept="image/*">
        </div>

        {{-- ACTION --}}
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Update
            </button>

            <a href="{{ route('admin.main.index') }}"
               class="btn btn-outline-secondary">
                Kembali
            </a>
        </div>

    </form>
</div>
@endsection
