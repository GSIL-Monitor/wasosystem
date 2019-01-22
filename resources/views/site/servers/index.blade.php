@extends('site.layouts.default')
@section('title',$complete_machine_framework->name ?? '全部')
@section('css')
    <link href="{{ asset('css/server.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="{{ asset('js/server.js') }}"></script>
    <script>

        function checkSit(){
            var con_sit = $("#con_sit").val();
            var Wwidth =$(window).width() ;
            if(Wwidth>900){
                if(con_sit == '0'){
                    $('.hide_condition').removeClass("opend");
                }else if(con_sit == '1'){
                    $('.hide_condition').addClass("opend");
                }
            }
        }
        /*隐藏筛选*/
        $(".choosed dl .condition_list li span").each(function () {
            var key = $(this).attr('name');
            $("a[name=" + key + "]").parents('dd').parents('dl').parents('.condition_box').hide();
        });
        checkSit();
        var url="{{ route('server.search',$id) }}";

        $(function () {
            $(".type_box li:nth-child(4n)").addClass("lastLi");
           $(document).on('click','.page-item:not(".disabled")',function () {
               var lastPage=$(this).attr('data-total')
               $(this).addClass('active').siblings().removeClass('active')
           })
        });
    </script>
@endsection
@section('content')
     @include('site.servers.body')
@endsection