@extends('admin.layouts.app')

@section('title', 'Lelang')

@section('content')
<div class="space-y-6">
    @include('admin.main.lelang.partials.list')
</div>
@endsection
