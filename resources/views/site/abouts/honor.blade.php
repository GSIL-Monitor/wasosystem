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
        <div id="crumbs"><div class="wrap"><a href="/">首页</a> > 关于我们 > 荣誉资质</div></div>
        <div class="wrap">
            <div class="aboutBox">
                @includeIf('site.abouts.about_link')
                <div class="tab_box">
                    <div class="qualified">
                        <i class="tips">* 如需大图，请联系 <a href="{:U('Online/online')}">在线客服</a></i>
                        <!--  置顶资质  -->
                        <ul class="scroll_pic">
                            @foreach($honor_tops as $honor_top)
                                <li class="main_pic">
                                    <div>
                                        <img class="lazy" data-original="{{ pic($honor_top->pic)[0]['url'] ?? ''  }}" title="如需大图资料，请联系客服人员！"><h5>{{ $honor_top->field['name'] }}</h5>
                                    </div>
                                </li>
                            @endforeach
                            <div class="clear"></div>
                        </ul>

                        <!--  本年资质  -->
                        @foreach($honors->groupBy('field.year') as $key=>$honor)
                            <h5 class="quaTit now">{{ $key }}</h5>
                            <ul class="scroll_pic">
                                @foreach($honor as $item)
                                    <li class="main_pic">
                                        <div>
                                            <img class="lazy" data-original="{{ pic($item->pic)[0]['url'] ?? ''  }}" title="如需大图资料，请联系客服人员！"><h5>{{ $item->field['name'] }}</h5>
                                        </div>
                                    </li>
                                @endforeach
                                <div class="clear"></div>
                            </ul>
                            @break($loop->index == 2);
                    @endforeach

                        <!--  去年资质  -->


                        <!--  以往资质  -->
                        <h5 class="quaTit pastYear">更多</h5>
                        <ul class="scroll_pic">
                            @foreach($honors->groupBy('field.year') as $honor)
                                @if($loop->index >=3)
                                        @foreach($honor as $item)
                                            <li class="main_pic">
                                                <div>
                                                    <img class="lazy" data-original="{{ pic($item->pic)[0]['url'] ?? ''  }}" title="如需大图资料，请联系客服人员！"><h5>{{ $item->field['name'] }}</h5>
                                                </div>
                                            </li>
                                        @endforeach
                                @endif
                            @endforeach
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <!-- 资质结束 -->
                </div>
                <!--联系结束 -->
                <div class="clear"></div>
            </div>


        </div>
    </div>
@endsection