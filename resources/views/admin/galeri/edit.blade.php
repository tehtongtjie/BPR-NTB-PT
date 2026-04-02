@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">Edit Galeri</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui detail kegiatan jika diperlukan.</p>
    </div>

    @include('admin.galeri.form', ['galeri' => $galeri, 'categories' => $categories ?? collect()])
</div>
@endsection
