<div id="foot">
    <div class="wrap">
        <div class="f_up">
            <div class="f_left">
                <ul>
                    <li class="f_tit">关于网烁 <i>+</i></li>
                    <li class="f_hideUl"><a href="{{ route('about') }}">公司介绍</a></li>
                    <li class="f_hideUl"><a href="{{ route('honor') }}">荣誉资质</a></li>
                    <li class="f_hideUl"><a href="{{ route('job.index') }}">加入网烁</a></li>
                    <li class="f_hideUl"><a href="{{ route('contact') }}">联系我们</a></li>
                </ul>

                <ul>
                    <li class="f_tit">产品服务 <i>+</i></li>
                    <li class="f_hideUl"><a href="{:U('Products/Server')}">服务器</a></li>
                    <li class="f_hideUl"><a href="{:U('Products/Designer')}">图工及设计师电脑</a></li>
                    <li class="f_hideUl"><a href="{{ route('in_depth_customization') }}">深度定制</a></li>
                    <li class="f_hideUl"><a href="{{ route('solution') }}">解决方案</a></li>
                    <li class="f_hideUl"><a href="{{ route('it_outsourcing') }}">服务外包</a></li>
                </ul>

                <ul>
                    <li class="f_tit">解决方案 <i>+</i></li>
                    @foreach($common_solutions as $item)
                    <li class="f_hideUl"><a href="{{ route('solution.show',$item->id) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
                <ul>
                    <li class="f_tit">服务支持 <i>+</i></li>
                    <li class="f_hideUl"><a href="{{ route('service_support.index') }}">自助服务</a></li>
                    <li class="f_hideUl"><a href="{{ route('service_support.service_clause',43) }}">购买指南</a></li>
                    <li class="f_hideUl P_hide"><a href="{{ route('drive.index') }}">驱动下载</a></li>
                    <li class="f_hideUl"><a href="{{ route('service_support.service_clause',40) }}">服务条款</a></li>
                    <li class="f_hideUl"><a href="{{ route('orders.index') }}">订单信息查询</a></li>
                </ul>
                <ul>
                    <li class="f_tit">新闻资讯 <i>+</i></li>
                    <li class="f_hideUl"><a name="F_news" target="_blank" href="{{ url('news_gongsi.html') }}">网烁动态</a></li>
                    <li class="f_hideUl"><a name="F_news" target="_blank" href="{{ url('news_hangye.html') }}">行业新闻</a></li>
                    <li class="f_hideUl"><a name="F_news" target="_blank" href="{{ url('news_jishu.html') }}">技术知识</a></li>
                </ul>
                <div class="clear"></div>
            </div>

            <div class="f_right">
                <h1>400-028-1968</h1>
                <h1>13980996979</h1>
                <h5>周一至周六 09:00～18:00</h5>
                <a  name="F_news"  class="talkBtn"data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&userId=2178125">在线客服</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="f_down">
            <div class="wrap">
                <div class="f_d_left">
                    <div class="copyrights">
                        <h5>Copyright © <span class="year">{{ today()->format('Y') }}</span> 成都网烁信息科技有限公司 版权所有</h5>
                        <h5><a href="http://www.miitbeian.gov.cn">蜀 ICP(备)10025767号</a></h5>
                        <h5><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=51010702001250" style="display:inline-block;text-decoration:none"><img src="{{ asset('pic/beian.png') }}" style="margin-right:3px; vertical-align:middle;"/>川公网安备 51010702001250号</a></h5>
                        <a href="{{ route('service_support.copyright') }}">版权声明</a>
                        <a href="{{ route('service_support.feedback') }}" target="_blank">问题反馈</a>
                    </div>
                </div>

                <div class="f_d_right">
                    <ul>
                        <li class="sina">
                            <a name="F_news" href="http://weibo.com/wasoinfo?refer_flag=1001030201_" target="_blank">
                                <img title="网烁新浪微博" src="{{ asset('pic/P_sina.png') }}"/>
                            </a>
                        </li>
                        <li class="weixin">
                            <img title="网烁公众号" src="{{ asset('pic/P_weixin.png') }}"/>
                            <img class="hidePic" src="{{ asset('pic/weixin_hover.jpg') }}"/>
                        </li>
                        <div class="clear"></div>
                    </ul>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

@includeIf('site.layouts.top')
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?2483bc8dc2795e527dd78c5387be514c";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
