@extends('site.layouts.default')
@section('title','深度定制')
@section('css')
    <link href="{{ asset('css/product_list.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/in_depth_customizations.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/designer.js')}}"></script>
    <script src="{{asset('js/deep.js')}}"></script>
    <script>
        $(function(){
            $("#header .wrap").addClass("noBg");
        });
    </script>
@endsection
@section('content')
     @include('site.in_depth_customizations.body')
@endsection