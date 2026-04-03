@extends('admin.layouts.app')

@section('title', 'Suku Bunga')

@section('content')
<div class="space-y-6">
    @include('admin.main.interest-rate.partials.list')
</div>
@endsection
