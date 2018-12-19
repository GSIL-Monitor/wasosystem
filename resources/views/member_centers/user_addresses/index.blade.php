@extends('member_centers.default')
@section('title','收货地址')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/address.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/binding_authorizations.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/address.js')}}"></script>
    <script>

    </script>
@endsection
@section('content')
    @include('member_centers.user_addresses.body')
@endsection