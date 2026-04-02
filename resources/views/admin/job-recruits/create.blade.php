@extends('admin.layouts.app')

@section('title', 'Tambah Lowongan')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Tambah Lowongan Kerja</h1>
            <p class="text-sm text-slate-500 mt-1">Isi informasi lengkap agar calon pelamar tahu ekspektasi peran.</p>
        </div>

        @include('admin.job-recruits.form', ['statusOptions' => $statusOptions])
    </div>
@endsection
