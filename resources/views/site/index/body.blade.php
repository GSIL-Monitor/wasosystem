<div class="body">
    @includeIf('site.index.components.p_header')
    <!--    手机端   菜单  -->
    @includeIf('site.index.components.banner')
    <!--  banner  结束  -->
    <!--  公司优势  结束  -->
    @includeIf('site.index.components.advantage_AD')

    <!--  服务器分类  -->
    @includeIf('site.index.components.application')

    <!--  首页推荐机型  -->
    @includeIf('site.index.components.machine')
    <!--  解决方案 -->
    <div class="solutions bgDiv">
        <div class="wrap">
            <h1>网烁行业解决方案</h1>
            <p>从实际需求出发，为您定制专属解决方案</p>
            <a href="" class="btn">查看更多</a>
        </div>
    </div>
    <!--  快捷服务  -->
    @includeIf('site.index.components.service')


    <!-- 其他  -->
        @includeIf('site.index.components.news')
</div>
<!-- 页身 -->