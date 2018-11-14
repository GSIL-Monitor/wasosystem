@extends('member_centers.default')
@section('title','常用配置')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/order.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/orderAll.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.9.2.custom.js')}}"></script>
    <script src="{{asset('js/common_equipments.js')}}"></script>
    <script>
        $(function () {
            $(".PZList li:even").addClass("leftLi");
        });
    </script>

@endsection
@section('content')
    @include('member_centers.common_equipments.body')
@endsection