@extends('site.layouts.default')
@section('title','版权声明')
@section('css')
    <link href="{{ asset('css/copyright.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
@endsection
@section('content')

    <div class="body">
        <div class="crumb"><div class="wrap"><a href="/">首页</a> > <span>版权说明</span></div></div>

        <div class="wrap">
            <div class="info_box">
                <h5>版权声明</h5>

                <div class="words">
                    {!! $copyright->field['content'] !!}
                </div>

            </div>

        </div>
    </div>
@endsection