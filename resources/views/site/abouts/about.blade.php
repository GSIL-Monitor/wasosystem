@extends('site.layouts.default')
@section('title','关于我们')
@section('css')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{asset('js/about.js')}}"></script>
@endsection
@section('content')
    <div class="body">
        <div id="crumbs"><div class="wrap"><a href="/">首页</a> > 关于我们 > 公司介绍</div></div>
        <div class="wrap">
            <div class="aboutBox">
                @includeIf('site.abouts.about_link')
                <div class="tab_box">
                    <div class="aboutPic"><img src="{{ asset('pic/about1.jpg') }}"></div>
                    <div class="about_box">
                        <div class="us">{!! optional($about)->field['content'] ?? '' !!}</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>


        </div>
    </div>
@endsection