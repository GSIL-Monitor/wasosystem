@extends('site.layouts.default')
@section('title','解决方案')
@section('css')
    <link href="{{ asset('css/solution.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/solution.js')}}"></script>
    <script>
        $(".solutionType li:nth-child(3n)").addClass("lastLi");
    </script>
@endsection
@section('content')
     @include('site.solutions.body')
@endsection