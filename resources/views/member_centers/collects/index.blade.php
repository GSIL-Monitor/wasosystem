@extends('member_centers.default')
@section('title','我的收藏')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/collects.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script>
        $(function () {
            $(".mycollection ul li:nth-child(2n)").addClass("rightLi");
            $(document).on('click','.delcoll',function () {
                var url=$(this).attr('data_url');
                axios.get(url)
                    .then(function (response) {
                        location.reload();
                    })
                    .catch(function (error) {

                });
            });
        });
    </script>
@endsection
@section('content')
    @include('member_centers.collects.body')
@endsection