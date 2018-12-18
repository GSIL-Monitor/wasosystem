@extends('site.layouts.default')
@section('title', $completeMachine->name.'-驱动下载')
@section('css')
    <link href="{{ asset('css/drive_info.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')

    <script>

    </script>
@endsection
@section('content')
    <div class="body">
        <div class="wrap">
            <div id="crumbs">
                <a href="{{ route('service_support.index') }}">服务支持</a> > <a href="{{ route('drive.index') }}">整机驱动</a>
                > <span>{{ $completeMachine->name.'-驱动下载' }}</span>
            </div>

            <div class="info_box">
                <div class="pro_pic">
                    <img class="lazy" data-original="{{ order_complete_machine_pic($completeMachine->complete_machine_product_goods) ?? '' }}"/>
                    <div class="infos">
                        <h5>{{ $completeMachine->name }}</h5>
                        <a href="{{ route('server.show',$completeMachine->id) }}" target="_blank">查看产品详情</a>
                        <div class="downs">
                            @auth('user')
                                <h6>驱动下载：</h6>
                                <ul>
                                    @forelse(drive($completeMachine->complete_machine_product_goods) as $item)
                                        <li>
                                            <a href="{{ url('/downloadFile') }}?file={{ $item->file['url']  }}&name={{  $item->file['name'] }}">
                                                {{ $item->file['name'] }}<i></i>
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            暂时没有驱动！
                                        </li>
                                    @endforelse
                                    <div class="clear"></div>
                                </ul>
                                @else
                                    <div class="error">请 <a href="{{ route('login') }}" style="color: #0187CE">登录</a>
                                        后下载！
                                    </div>
                                    @endauth
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>


            </div>

        </div>
    </div>
@endsection