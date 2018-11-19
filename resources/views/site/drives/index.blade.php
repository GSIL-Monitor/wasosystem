@extends('site.layouts.default')
@section('title', '驱动下载')
@section('css')
    <link href="{{ asset('css/drive.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')

    <script>

    </script>
@endsection
@section('content')
    <div class="body">

        <div id="crumbs">
            <div class="wrap"><a href="{:U('Support/support')}">服务支持</a> > <span>整机驱动</span></div>
        </div>

        <div class="wrap">
            <div class="info_box">
                @forelse($complete_machines as $key=>$complete_machine)
                    @if($key != '0' && $key != '')
                        <div class="down_list">
                            <h2><i></i>{{ $key }}</h2>
                            <ul>
                                @forelse($complete_machine as $key2=>$item)
                                    @if(drive($item->complete_machine_product_goods)->isNotEmpty())
                                        <li><a class="radius" href="{{ route('drive.show',$item->id) }}"><img
                                                        class="lazy" data-original="{{ order_complete_machine_pic($item->complete_machine_product_goods) }}"/>
                                                <h5>{{ $item->name }}</h5></a></li>
                                    @endif
                                @empty
                                    <div class="error">
                                        暂时没有驱动
                                    </div>
                                @endforelse
                                <div class="clear"></div>
                            </ul>
                        </div>
                    @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection