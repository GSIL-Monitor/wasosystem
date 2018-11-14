<div class="p_header">
    <div class="p_logo"><img src="{{ asset('pic/logo.png') }}"></div>
    <div class="P_menu_btn">
        <span class="line1"></span>
        <span class="line2"></span>
        <span class="line3"></span>
    </div>
    <div class="p_person"><a href="   @guest('user')
        {{ route('login') }}

        @else
        {{ route('member_center') }}
        @endguest"><img src="{{ asset('pic/P_IndexPerson.png') }}"></a></div>
    <div class="clear"></div>
</div>
<div class="P_menu">
    <ul>
        <li>产品分类 <i class="Lii">+</i></li>
        <dl>
            <dt>服务器<i>+</i></dt>
            <dd>
                <a href="">111</a>
            </dd>

            <dt>图形工作站及设计师电脑<i>+</i></dt>
            <dd>

                <a href="">1111</a>
                <a href="">111</a>
            </dd>

            <dt>整柜<i>+</i></dt>
            <dd><a href="javascript:void(0)">正在更新中...</a></dd>
        </dl>

        <li>快速选型<i class="Lii">+</i></li>
        <dl>
            <dd style="display: block;">
                <a style="padding-left:20px;" href="">服务器选型</a>
                <a style="padding-left:20px;" href="">设计师电脑选型</a>
            </dd>
        </dl>

        <li><a class="more_pro" href="">深度定制</a></li>

        <li>解决方案<i class="Lii">+</i></li>
        <dl>
            <dt>11<i>+</i></dt>
            <dd><a href="">111</a></dd>
            </volist>
        </dl>
        <li><a class="more_pro" href="">服务外包</a></li>
        <li><a class="more_pro" href="">服务支持</a></li>
        <li><a class="more_pro" href="">搜索</a></li>
    </ul>
</div>