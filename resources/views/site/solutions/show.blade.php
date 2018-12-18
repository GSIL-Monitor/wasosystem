@extends('site.layouts.default')
@section('title',$integration->name)
@section('css')
    <link href="{{ asset('css/solution_info.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
@endsection
@section('content')
    <div class="body">
        <div class="solPic">
            <div class="wrap"><h5>{{ $integration->parent->name }}解决方案</h5></div>
        </div>
        <div class="sol_box">
            <div class="wrap">
                <div class="typeLinks">
                    <ul>
                        <h5>{{ $integration->parent->name }} 解决方案</h5>
                        @foreach($integration->parent->child as $child)
                            <li class="@if($integration->id == $child->id) active @endif"><a href="{{ route('solution.show',$child->id) }}">{{ $child->name }}</a></li>
                       @endforeach
                    </ul>
                </div>

                <div class="news_info">
                    <h5 class="news_tit"><b>{{ $integration->name }}</b></h5>
                    <div class="infoTxt">
                        {!! str_replace('src="https','class="lazy" data-original="https',$integration->details) !!}</div>
                    <div class="go_back"><a href="{{ route('solution') }}">返回上页</a></div>
                </div>

                <div class="clear"></div>
            </div>
        </div>

        @if($integration->Integration_complete_machines->isNotEmpty())
            <div class="hotSolutions">
                <div class="wrap">
                    <h5 class="tit">产品解决方案</h5>
                    <ul class="proSolution">
                            @foreach($integration->Integration_complete_machines as $complete_machine)
                            <li>
                                <a href="@if($complete_machine->parent_id ==1 ){{ route('server.show',$complete_machine->id) }}@else{{ route('server.designer',$complete_machine->id) }}@endif" >
                                    <img src="{{ order_complete_machine_pic($complete_machine->complete_machine_product_goods) ?? '' }}"/>
                                    <h3>{{ $complete_machine->name }}</h3><p>{{ $complete_machine->additional_arguments['product_description'] }}</p><h6>查看更多</h6>
                                </a>
                            </li>
                            @endforeach
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection