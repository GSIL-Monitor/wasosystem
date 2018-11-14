@extends('member_centers.default')
@section('title','我的消息('.user()->notification_count.')')
@section('css')
    <link href="{{ asset('css/person_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/notifications.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui-1.9.2.custom.js') }}"></script>
    <script>
        $(function () {
                $(document).on("click",".check_read",function(){
                    var url=$(this).attr('data_url');
                    var txt = $(this).find("p");
                    if(txt.is(":visible")){
                        txt.slideUp();
                    }else{
                        if($(this).hasClass('noread')){
                            axios.get(url);
                            $(this).find('.notRead').removeClass('notRead').addClass('readed').text('[已读]');
                        }
                        txt.slideDown();
                    }
                });
        });
    </script>

@endsection
@section('content')
    @include('member_centers.notifications.body')
@endsection