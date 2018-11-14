@extends('member_centers.default')
@section('title','我的订单')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/order.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/orderAll.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui-1.9.2.custom.js') }}"></script>
    <script>
        $(function () {
            $(".search_btn").click(function(){
                $('#orders').submit();
            });

        });
    </script>
@endsection
@section('content')
    @include('member_centers.orders.body')
@endsection