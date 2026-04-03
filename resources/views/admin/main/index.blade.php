@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-10">

    @include('admin.main.banner.partials.list')
    
    @include('admin.main.promo.partials.list')
    @include('admin.main.interest-rate.partials.list')
    @include('admin.main.article.partials.list')
    @include('admin.main.lelang.partials.list')

</div>
@endsection
