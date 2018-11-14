@extends('site.layouts.default')
@section('title','我的搜索')
@section('css')

    <link href="{{ asset('css/search.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/search.js')}}"></script>
@endsection
@section('content')
     @include('site.searchs.body')
@endsection