@extends('site.layouts.default')
@section('title','个人中心')
@section('css')
    <link href="{{ asset('css/person.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/index.js')}}"></script>
@endsection
@section('content')
    @include('member_centers.body')
@endsection