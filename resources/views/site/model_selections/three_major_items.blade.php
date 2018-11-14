@extends('site.layouts.default')
@section('title','服务器三大件性价比指数表')
@section('css')

    <link href="{{ asset('css/three_major_items.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/three_easy.js')}}"></script>
    <script>
        var order_url="{{ route('three_major_items.order') }}";
    </script>
@endsection
@section('content')
     @include('site.model_selections.body.three_major_items_body')
@endsection