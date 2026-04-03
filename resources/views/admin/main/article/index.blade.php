@extends('admin.layouts.app')

@section('title', 'Artikel')

@section('content')
<div class="space-y-6">
    @include('admin.main.article.partials.list')
</div>
@endsection
