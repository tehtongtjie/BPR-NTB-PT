@extends('admin.layouts.app')

@section('title', 'Tambah Suku Bunga')

@section('content')
<div class="dashboard-card">

    <form method="POST"
        action="{{ route('admin.main.interest-rate.store') }}">
        @csrf

        {{-- Judul --}}
        <input name="title" class="form-control mb-3" required>

        {{-- Rate utama --}}
        <input name="rate" class="form-control mb-3" required>

        {{-- Deskripsi --}}
        <textarea name="description" class="form-control mb-3"></textarea>

        {{-- Status --}}
        <label>
            <input type="checkbox" name="is_active" value="1" checked>
            Aktif
        </label>

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
