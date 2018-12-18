@extends('site.layouts.default')
@section('title','IT服务外包')
@section('css')
    <link href="{{ asset('css/product_list.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/it_outsourcings.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/designer.js')}}"></script>
    <script src="{{asset('js/it_outsourcings.js')}}"></script>

@endsection
@section('content')
     @include('site.it_outsourcings.body')
@endsection