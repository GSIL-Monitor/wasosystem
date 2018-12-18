<div id="newsfoot">
    <div class="wrap">
        <div class="webLinks">
            <ul>
                <li><a href="/">网烁官网</a></li>
                <span>|</span>
                <li><a href="{:U('Products/Products')}">产品分类</a></li>
                <span>|</span>
                <li><a href="{{ route('server_selection') }}">服务器定制</a></li>
                <span>|</span>
                <li><a href="{{ route('designer_selection') }}">设计师电脑定制</a></li>
                <span>|</span>
                <li><a href="{{ route('solution') }}">解决方案</a></li>
                <span>|</span>
                <li><a href="{{ route('it_outsourcing') }}">服务外包</a></li>
                <span>|</span>
                <li><a href="{:U('Support/Support')}">服务支持</a></li>
                <span>|</span>
                <li><a href="{{ route('about') }}">关于我们</a></li>
                <div class="clear"></div>
            </ul>
        </div>

        <div class="f_down">
            <div class="wrap">
                <h5>
                    <a href="http://www.miitbeian.gov.cn">{{ setting('system_website_records') }}</a><br/>
                    <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=51010702001250" style="display:inline-block;text-decoration:none">
                        <img src="{{ asset('pic/beian.png') }}" style="margin-right:3px; vertical-align:middle;"/>{{ setting('system_ministry_public_security_records') }}</a><br>
                        Copyright © <span class="year">{{ today()->format('Y') }}</span> {{  setting('system_title') }} 版权所有
                </h5>
            </div>
        </div>
    </div>
</div>


@includeIf('site.layouts.top')