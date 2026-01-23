@extends('admin.layouts.app')

@section('title', 'Tambah Banner')

@section('content')
<div class="dashboard-card">

    {{-- HEADER --}}
    <div class="card-header-admin mb-4">
        <h4>Tambah Banner</h4>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('admin.main.banner.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- GAMBAR --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Gambar Banner <span class="text-danger">*</span>
            </label>

            <input type="file"
                   name="image"
                   class="form-control @error('image') is-invalid @enderror"
                   accept="image/jpeg,image/png, image/webp"
                   required>

            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <small class="text-muted d-block mt-1">
                Format: JPG / PNG • Maksimal 8MB
            </small>
        </div>

        {{-- ACTION --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
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
