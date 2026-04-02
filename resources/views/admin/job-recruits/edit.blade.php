@extends('admin.layouts.app')

@section('title', 'Edit Lowongan')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Edit Lowongan</h1>
            <p class="text-sm text-slate-500 mt-1">Perbarui data lowongan sesuai kebutuhan bisnis.</p>
        </div>

        @include('admin.job-recruits.form', ['jobRecruit' => $jobRecruit, 'statusOptions' => $statusOptions])
    </div>
@endsection
