<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{  csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>网烁信息综合管理系统</title>
    <link href="{{ asset('admin/css/public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/update.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin/js/jquery-2.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/public.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/jquery.rotate.min.js') }}" type="text/javascript"></script>
    @include('admin.index.IE')
</head>
<body id="SysBody">
<div id="bigBlack"></div>
<div id="content" style="width: 100%; max-width: 100%">
    <div id="C_left">
        <div class="C_leftContainer">
            @include('admin.index.myinfo') {{--个人信息--}}
            @include('admin.index.i_leftsider') {{--菜单--}}
        </div>
        <div id="LeftBtn" class="LeftShou"></div>
    </div>

    <div id="C_right">
        @include('admin.index.i_top')  {{-- 顶部Tab--}}
        @include('admin.index.i_body')  {{-- 内容--}}
        @include('admin.index.i_foot')  {{-- 底部统计信息--}}
    </div>
    <div class="clear"></div>
</div>


</body>
</html>
