@extends('admin.layouts.app')

@section('title', 'Tambah Galeri')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">Tambah Galeri</h1>
        <p class="text-sm text-slate-500 mt-1">Upload dokumentasi foto atau video baru untuk ditampilkan pada publikasi.</p>
    </div>

    @include('admin.galeri.form', ['categories' => $categories ?? collect()])
</div>
@endsection
