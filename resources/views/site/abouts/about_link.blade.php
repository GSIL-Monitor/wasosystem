<div class="fixLinks">
    <h5>关于我们</h5>
    <ul>
        <li class="@if(Route::is('about')) active @endif"><a href="{{ route('about') }}"><i></i>公司介绍</a></li>
        <li class="@if(Route::is('honor')) active @endif"><a href="{{ route('honor') }}"><i></i>荣誉资质</a></li>
        <li><a name="F_news" target="_blank" href="{{ url('/news_gongsi.html') }}"><i></i>网烁新闻</a></li>
        <li ><a target="_blank" href="{{ route('job.index') }}"><i></i>加入网烁</a></li>
        <li class="@if(Route::is('contact')) active @endif"><a href="{{ route('contact') }}"><i></i>联系我们</a></li>
    </ul>
</div>