<!--[if  IE]>
<div class="IEBlack"></div>

<div class="IE">
    <div class="IEbox">
        <div class="logo_bg"><a class="logo" href="/Index/index.html"><img src="/Public/index/Pic/logo.png"></a></div>
        <div class="tips"><p>您的浏览器版本过低，请升级您的浏览器或使用非IE浏览器</p></div>
        <ul class="IELinks">
            <li><a target="_blank" href="http://www.maxthon.cn/"><span class="one"></span><h3>遨游浏览器</h3></a></li>
            <li><a target="_blank" href="http://ie.sogou.com/"><span class="two"></span><h3>搜狗浏览器</h3></a></li>
            <li><a target="_blank" href="http://www.firefox.com.cn/"><span class="thr"></span><h3>火狐浏览器</h3></a></li>
            <li><a target="_blank" href="http://browser.qq.com/?adtag=SEM1"><span class="four"></span><h3>QQ浏览器</h3></a></li>
            <li><a target="_blank" href="http://www.google.cn/chrome/"><span class="five"></span><h3>谷歌浏览器</h3></a></li>
            <li><a target="_blank" href="http://se.360.cn/index_main.html"><span class="six"></span><h3>360浏览器</h3></a></li>
            <div class="clear"></div>
        </ul>
        <div class="tipW">
            <p> QQ，UC，遨游，360等浏览器请使用“极速模式” 。</p>
            <p>（以上链接为第三方软件下载地址，与本公司无关，请自行选择下载。）</p>
        </div>
        <div class="closeBtn">×</div>
    </div>
</div>


<script>
    $(document).ready(function () {
        var LookHeight = $(window).height();
        var divHeight = $(".IE").height();
        var top = (LookHeight - divHeight) / 2 - 30;
        $(".IE").css("top", top);
    });
    /*IE提示*/
    $(document).on("click", ".IE .closeBtn", function () {
        $(".IE").hide();
        $('.IEBlack').hide();
    });
</script>
<![endif]-->
