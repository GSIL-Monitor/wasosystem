@extends('site.layouts.default')
@section('title','服务器、存储选型')
@section('css')
    <link href="{{ asset('css/product_list.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/server_easy.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/designer.js')}}"></script>
    <script>
        $(function () {
            $(document).on('click',".wrap .trans ul li",function () {
                var Dl=$(this).parents("dl");
                var id=$(this).attr("name");
                axios.post("{{ route('server_selection.filter') }}",{
                    "_token":getToken(),
                    "type":'server_selection',
                    "id":id
                }).then(function (response) {
                    if(response.data.type=='filtrate' ){
                        if(Dl.not(":last")){
                            console.log(1);
                            Dl.nextAll('dl').remove();
                            Dl.after(response.data.html);
                            $(".checkDiy .disignDiyBtn").hide();

                        }else{
                            console.log(2);
                            Dl.after(response.data.html);
                            $(".checkDiy .disignDiyBtn").hide();
                        }
                    }else{
                        Dl.nextAll('dl').remove();
                        $('#server').html(response.data.html);
                        Dl.addClass("lastdl").siblings("dl").removeClass("lastdl");
                        $(".checkDiy .disignDiyBtn").show();
                    }
                }).catch(function (err) {
                    Dl.nextAll('dl').remove();
                    $('#server').html(err.response.data.html);
                    Dl.addClass("lastdl").siblings("dl").removeClass("lastdl");
                    $(".checkDiy .disignDiyBtn").show();
                    if(err.response.data.message !=undefined){
                        swal(err.response.data.message,'请根据提示操作！','error');
                    }

                })
            });
            /* 提交选项*/
            $(document).on("click",".gotoNEXT",function(){
                if(check()=="ok"){
                    $(".designAD").hide();
                    $('html,body').animate({scrollTop:0},1000);
                    $(".body .checkDiy").hide().siblings(".proShowList").show();

                    time();
                }
            });

        });
    </script>
@endsection
@section('content')
    @include('site.model_selections.body.server_selection_body')
@endsection