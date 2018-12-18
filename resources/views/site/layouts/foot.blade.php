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
                    <li class="f_hideUl"><a href="{{ route('server.index','complete_machine') }}">服务器</a></li>
                    <li class="f_hideUl"><a href="{{ route('server.index','graphic_workstation_designer_computer') }}">图工及设计师电脑</a></li>
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
                <h1>{{  setting('contact_telephone') }}</h1>
                <h5>{{ setting('contact_working_time') }}</h5>
                <a  name="F_news"  class="talkBtn"data-src="http://p.qiao.baidu.com/cps/chat?siteId=1281749&userId=2178125">在线客服</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="f_down">
            <div class="wrap">
                <div class="f_d_left">
                    <div class="copyrights">
                        <h5>Copyright © <span class="year">{{ today()->format('Y') }}</span> {{  setting('system_title') }} 版权所有</h5>
                        <h5><a href="http://www.miitbeian.gov.cn">{{ setting('system_website_records') }}</a></h5>
                        <h5><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=51010702001250" style="display:inline-block;text-decoration:none"><img src="{{ asset('pic/beian.png') }}" style="margin-right:3px; vertical-align:middle;"/>{{ setting('system_ministry_public_security_records') }}</a></h5>
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
                            <img class="hidePic" src="{{ json_decode(getImages(setting('contact_wechat')),true)[0]['url'] ?? '' }}"/>
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
