@extends('admin.layouts.app')

@section('title', 'Perusahaan')   

@section('content')

<div class="space-y-10">

    @include('admin.perusahaan.management.index')
    
</div>
@endsection