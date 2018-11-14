@extends('member_centers.default')
@section('title','企业信息')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/binding_authorizations.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/binding_authorizations.js')}}"></script>
    <script>

    </script>
@endsection
@section('content')
    @include('member_centers.binding_authorizations.body')
@endsection