<div class="type_box">

    <ul>
        @forelse($servers as $server)
            @php $pics=order_complete_machine_pic($server->complete_machine_product_goods,'all');@endphp
            <li>
                @switch($server->marketing)
                    @case('new')
                    <i class="saleIcon newP"></i>
                    @break;
                    @case('hot')
                    <i class="saleIcon hotP"></i>
                    @break;
                    @case('moods')
                    <i class="saleIcon popP"></i>
                    @break;
                    @case('sale')
                    <i class="saleIcon saleP"></i>
                    @break;
                @endswitch
                <a href="@if($server->parent_id ==1 )
                {{ route('server.show',$server->id) }}
                @else
                {{ route('server.designer',$server->id) }}
                @endif">
                    <img  data-original="{{ $pics[0]['url'] ?? '' }}" class="topPic lazy">
                    <img  data-original="{{ $pics[1]['url'] ?? '' }}" class="botPic lazy">
                </a>
                <div class="txt">
                    <h3>网烁{{ explode('-',$server->name)[0] }}<b>基础配置 </b></h3>
                    <p>{{ $server->additional_arguments['product_description'] }}</p>
                    <h5 class="price"></h5>
                </div>

                <div class="proEasy">

                            <span class="colBtn

                                @if(!empty(user()) && $falg=user()->favoriteCompleteMachines->pluck('id','name')->contains($server->id))
                                    colDel
                                @else
                                    colAdd
                                @endif ">
                             {{--<i></i><em>取消收藏</em>--}}
                                @if(!empty(user()) && $falg)
                                    <i></i><em data_add_url="{{ route('server.collect',$server->id) }}"
                                               data_del_url="{{ route('server.collectRemove',$server->id) }}">取消收藏</em>
                                @else
                                    <i></i><em data_add_url="{{ route('server.collect',$server->id) }}"
                                               data_del_url="{{ route('server.collectRemove',$server->id) }}"
                                    >添加收藏</em>
                                @endif
                            </span>
                    <span class="ComBtn    @if(array_has(session()->get('complete_machines'),[$server->id]))
                            comDel
@else
                            comAdd
@endif">
                          @if(array_has(session()->get('complete_machines'),[$server->id]))
                            <em data_url="{{ route('server.comparisonRemove',$server->id) }}">取消对比</em><i></i>
                        @else
                            <em data_url="{{ route('server.comparison',$server->id) }}">加入对比</em><i></i>
                        @endif
                    </span>
                </div>
            </li>
        @empty
            暂时没有产品
        @endforelse
        <div class="clear"></div>
    </ul>
</div>
{{ $servers->appends(Request::except(['_token','page']))->links('vendor.pagination.ajax_page') }}

