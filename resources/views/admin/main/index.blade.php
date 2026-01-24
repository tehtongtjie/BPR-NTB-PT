@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-10">

    @include('admin.main.banner.index')

    @include('admin.main.promo.index')
    
    @include('admin.main.interest-rate.index')
    
    @include('admin.main.article.index')


</div>
@endsection
