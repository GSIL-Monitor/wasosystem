@extends('member_centers.default')
@section('title','企业信息')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/address.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/binding_authorizations.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/address.js')}}"></script>

@endsection
@section('content')
    @include('member_centers.user_companies.body')
@endsection