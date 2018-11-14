<div class="server">
    <div class="wrap">
        <div class="indexTit">服务</div>
        <ul class="borderFour">
            <li><a href="{{ route('member_center') }}"><img src="{{ asset('pic/support_count.png') }}"><h5>我的账户</h5></a></li>
            <li class="ph"><a href="{{ route('orders.index') }}"><img src="{{ asset('pic/support_check.png') }}"><h5>产品查询</h5></a></li>
            <li class="ph"><a href="{{ route('drive.index') }}"><img src="{{ asset('pic/support_down1.png') }}"><h5>驱动下载</h5></a></li>
            <li><a href="{{ route('service_support.service_clause',40) }}"><img src="{{ asset('pic/support_servier.png') }}"><h5>服务条款</h5></a></li>
            <li><a href="{{ url('/news_gongsi.html') }}" target="_blank"><img src="{{ asset('pic/support_news.png') }}"><h5>新闻资讯</h5></a></li>
            <li class="last"><a href="{{ route('service_support.service_clause',43) }}"><img src="{{ asset('pic/support_ques.png') }}"><h5>购买指南</h5></a></li>
            <li class="moreLi"><a href=""><img src="{{ asset('pic/support_more1.png') }}"><h5>更多</h5></a></li>
            <div class="clear"></div>
        </ul>
    </div>
</div>