@extends('site.layouts.default')
@section('title','在线客服')
@section('css')
    <link href="{{ asset('css/online.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
@endsection
@section('content')
    <div class="body">
        <div id="crumbs">
            <div class="wrap">
                <a href="/">首页</a> > <a href="{{  route('service_support.index') }}">服务支持</a> > 在线客服
            </div>
        </div>

        <div class="wrap">
            <div class="big_pic"></div>

            <div class="online_box">
                <div class="in_wrap">
                    @php $contact_telephone=array_values(array_filter(explode(' ',setting('contact_telephone'))));@endphp
                    <dl>
                        <dd>
                            <h5>在线销售</h5>
                            <p><a href="tel:{{ $contact_telephone[1] }}">联系电话：{{ $contact_telephone[1] }}（周一至周六 09:00～12:00 13:00～18:00）</a></p>
                            <ul>
                                <li><a target="_blank" href="tencent://message/?uin=100654803&Site=Senlon.Net&Menu=yes">网烁803<img border="0"  src="http://wpa.qq.com/pa?p=2:100654803:41 &amp;r=0.20370674575679004" /></a></li>
                                <li><a target="_blank" href="tencent://message/?uin=100654807&Site=Senlon.Net&Menu=yes">网烁807<img border="0"  src="http://wpa.qq.com/pa?p=2:100654807:41 &amp;r=0.20370674575679004" /></a></li>
                                <li><a target="_blank" href="tencent://message/?uin=100654812&Site=Senlon.Net&Menu=yes">网烁812<img border="0"  src="http://wpa.qq.com/pa?p=2:100654812:41 &amp;r=0.20370674575679004" /></a></li>
                                <div class="clear"></div>
                            </ul>
                        </dd>

                        <dd>
                            <h5>全国技术服务</h5>
                            <p><a href="tel:{{ $contact_telephone[1] }}">联系电话：{{ $contact_telephone[1] }}（周一至周六 09:00～12:00 13:00～18:00）</a></p>
                            <ul>
                                <li><a target="_blank" href="tencent://message/?uin=100654804&Site=Senlon.Net&Menu=yes">网烁804<img border="0" src="http://wpa.qq.com/pa?p=2:100654804:41 &amp;r=0.20370674575679004" /></a></li>
                                <li><a target="_blank" href="tencent://message/?uin=100654819&Site=Senlon.Net&Menu=yes">网烁819<img border="0" src="http://wpa.qq.com/pa?p=2:100654819:41 &amp;r=0.20370674575679004" /></a></li>
                                <div class="clear"></div>
                            </ul>
                        </dd>
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=100654818&site=CSDN&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1611969865:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>


                        <dd class="lastDl">
                            <h5>投诉建议</h5>
                            <p><a href="tel:{{ $contact_telephone[2] }}">{{ $contact_telephone[2] }}</a></p>
                        </dd>

                        <div class="clear"></div>
                    </dl>


                    <div class="clear"></div>
                    </dl>
                </div>

            </div>
        </div>

@endsection