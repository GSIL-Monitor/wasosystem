
<div class="condition">
        <div :class="{hide_condition:true,opend:condition_more}" >
             @foreach($server_filters as $key=>$server_filter)
                <div :class="{condition_box:true,'{{ $key }}':true}">
                    @if(count($server_filter) > 1)
                    <dl>
                        <dt>{{ $key }}：</dt>
                        @foreach($server_filter as $key2=>$item)
                            @if(!empty($key2))
                                @switch($key)
                                    @case('类型')
                                    <dd>
                                        <a name="ca2" @click="add_selected_filter('{{ $key }}','{{ $key2 }}')">{{ $key2 }}</a>
                                    </dd>
                                    @break;
                                    @case('价格')
                                    <dd>
                                        <a name="ca2"  @click="add_selected_filter('{{ $key }}','{{ $item }}')">{{ $item }}</a>
                                    </dd>
                                    @break;
                                    @case('内存容量')
                                    <dd>
                                        <a name="ca2"  @click="add_selected_filter('{{ $key }}','{{ $key2 }}')">{{ $key2 }}G</a>
                                    </dd>
                                    @break;
                                    @case('硬盘容量')
                                    <dd>
                                        <a name="ca2"  @click="add_selected_filter('{{ $key }}','{{ $key2 }}')">{{ $key2 }}G</a>
                                    </dd>
                                    @break;
                                    @default
                                    <dd>
                                        <a name="ca2"  @click="add_selected_filter('{{ $key }}','{{ $key2 }}')">{{ $key2 }}</a>
                                    </dd>
                                @endswitch
                            @endif
                        @endforeach

                        <div class="clear"></div>
                    </dl>
                    @endif
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
</div>
