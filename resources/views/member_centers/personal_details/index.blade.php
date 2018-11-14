@extends('member_centers.default')
@section('title','个人信息')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/selfs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/timer.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script>
        $(function () {
            $(document).on("click","label",function(){
                $(this).addClass("check").children("input").attr("checked","checked");
                $(this).siblings("label").removeClass("check").children("input").attr("checked",false);
            });

        });
    </script>
@endsection
@section('content')
    @include('member_centers.personal_details.body')
@endsection