<div class="companyAdvantage">
    <div class="wrap">
        <ul>
            <li><a href="{{ route('honor') }}"><em></em><i style="background-image:url('{{  json_decode(getImages(setting('advantage_members_base')),true)[0]['url'] ?? ''}}');"></i><span class="AdvWord">{!! setting('advantage_members_base_description') !!}</span></a></li>
            <li><a href="{{ route('honor') }}"><em></em><i style="background-image:url('{{ json_decode(getImages(setting('advantage_committeeman')),true)[0]['url'] ?? ''  }}')"></i><span class="AdvWord">{!! setting('advantage_committeeman_description') !!}</span></a></li>
            <li><a href="{{ route('honor') }}"><em></em><i style="background-image:url('{{ json_decode(getImages(setting('advantage_soem')),true)[0]['url'] ?? '' }}');"></i><span class="AdvWord">{!!   setting('advantage_soem_description') !!}</span></a></li>
            <li><a href="{{ route('honor') }}"><i style="background-image:url('{{ json_decode(getImages(setting('advantage_stap')),true)[0]['url'] ?? '' }}');"></i><span class="AdvWord">{!! setting('advantage_stap_description') !!}</span></a></li>
            <div class="clear"></div>
        </ul>
    </div>
</div>
<!--  特色/广告  -->
<div class="indexAD">
    <div class="wrap">
        <ul>
            <li><a href="{{ route('server.index',8) }}"><img src="{{ asset('pic/index/indexPro_6.jpg') }}"><h4>人工智能</h4><p>深度学习，GPU服务器</p></a></li>
            <li><a href="{{ route('server.index','graphic_workstation_designer_computer') }}"><img src="{{ asset('pic/index/indexPro_1.jpg') }}"><h4>设计师电脑</h4><p>为创意赋能，为设计加速</p></a></li>
            <li><a href="{{ route('server_selection') }}"><img src="{{ asset('pic/index/indexPro_2.jpg') }}"><h4>服务器、存储选型</h4><p>根据自身需求快速匹配合适配置</p></a></li>
            <li><a href="{{ route('in_depth_customization') }}"><img src="{{ asset('pic/index/indexPro_3.jpg') }}"><h4>服务外包</h4><p>产品租赁/置换</p></a></li>
            <div class="clear"></div>
        </ul>
    </div>
</div>