<div class="LeftLinks">
    @php $permissions=admin()->getAllPermissions()->pluck('name','name');@endphp
    @can("website system")
        @foreach($nav['WebMenus'] as $navs)
            @if($permissions->get('show '.$navs['url']))
                <dl sys="{{ $navs->cats }}">
                    <dt><span class=""></span>{{ $navs->name }}<i></i></dt>
                    <div class="linksHide">
                        @php $childMenus=$navs->childMenus;@endphp
                        @if(count($childMenus) >0)
                            @foreach($childMenus as $childMenu)
                                @if($permissions->get('show '.$childMenu->slug))
                                    <dd>
                                        <a sys="web" href="javascript:;" class="{{ $childMenu->slug }}"
                                           name="{{ $childMenu->slug }}"
                                           pagelink="{{ route($childMenu->url) }}">{{ $childMenu->name }}</a>
                                    </dd>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </dl>
            @endif
        @endforeach
    @endcan
    @can("barcode system")
        @foreach($nav['TiaoMenus'] as $navs)
            @if($permissions->get('show '.$navs['url']))
                <dl sys="{{ $navs->cats }}">
                    <dt><span class=""></span>{{ $navs->name }}<i></i></dt>
                    <div class="linksHide">
                        @php $childMenus=$navs->childMenus;@endphp
                        @if(count($childMenus) >0)
                            @foreach($childMenus as $childMenu)
                                @if($permissions->get('show '.$childMenu->slug))
                                    <dd>
                                        <a sys="web" href="javascript:;" class="{{ $childMenu->slug }}"
                                           name="{{ $childMenu->slug }}"
                                           pagelink="{{ route($childMenu->url) }}">{{ $childMenu->name }}</a>
                                    </dd>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </dl>
            @endif
        @endforeach
    @endcan

</div>

<div class="copyright">
    <p>网烁综合管理系统 V2.0.1</p>
    <p>成都网烁信息科技有限公司 版权所有</p>
</div>