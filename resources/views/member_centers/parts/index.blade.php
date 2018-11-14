@extends('member_centers.default')
@section('title','配件选购')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/addPei.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/addPeijian.js')}}"></script>
    <script>
        $(function () {
            ConfigurationCodeCreate();
        });
    </script>
    @include('site.common._addProduct',['type'=>'create'])
@endsection
@section('content')
    @include('member_centers.parts.body')
@endsection