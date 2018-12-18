<div class="body">
    <div class="wrap">
        <div class="search">
            <h5>您想寻找什么内容？</h5>
            {!! Form::open(['route'=>'search','method'=>'get']) !!}
            {!! Form::text('key',old('key',Request::get('key')),['class'=>'search_text']) !!}
            {!! Form::submit('搜索',['class'=>'search_btn','onclick'=>'layer.load(0, {shade: false});']) !!}
            {!! Form::close() !!}
            <div class="clear"></div>
        </div>
    </div>

    <div class="result_div">
        <div class="wrap">

            @if($integrations->isNotEmpty() || $informationManagements->isNotEmpty()  || $completeMachines->isNotEmpty() )
                <div class="searchTypePage">
                    <ul>
                        @if($completeMachines->isNotEmpty())
                            <li>产品<span>({{ $completeMachines->count() }})</span></li>
                        @endif
                        @if($informationManagements->isNotEmpty())
                            <li>资讯<span>({{ $informationManagements->count() }})</span></li>
                        @endif
                        @if($integrations->isNotEmpty())

                            <li>解决方案<span>({{ $integrations->count() }})</span></li>
                        @endif
                        <div class="clear"></div>
                    </ul>
                </div>
            @endif
            <div class="searchResultBox">
                @if($integrations->isNotEmpty() || $informationManagements->isNotEmpty()  || $completeMachines->isNotEmpty() )
                    @if($completeMachines->isNotEmpty())
                        @includeIf('site.searchs.search_machine')
                    @endif
                    @if($informationManagements->isNotEmpty())
                        @includeIf('site.searchs.search_inforation')
                    @endif
                    @if($integrations->isNotEmpty())
                        @includeIf('site.searchs.search_integration')
                    @endif
                @else
                    <div class="error">没有您要查询的内容</div>
                @endif
            </div>

        </div>
    </div>
</div>
