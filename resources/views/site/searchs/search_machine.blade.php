<div class="searchResultPage searchPro">
    <div class="s_product">
        <dl>
            @foreach($completeMachines->take(8) as $search)
                <dd>
                    <a href="@if($search->parent_id ==1 )
                            {{ route('server.show',$search->id) }}
                            @else
                             {{ route('server.designer',$search->id) }}
                            @endif
                            ">
                        <div class="pic"><img class="lazy" data-original="{{ order_complete_machine_pic($search->complete_machine_product_goods) ?? '' }}"></div>
                        <div class="infos">
                            <b>
                                {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->name) !!}
                            </b>
                            <p>
                                {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->additional_arguments['product_description']) !!}
                            </p>

                        </div>
                        <div class="clear"></div>
                    </a>
                </dd>
           @endforeach

            <div class="clear"></div>

                @if($completeMachines->count() > 8)
                <div class="more_hide">
                    @foreach($completeMachines as $search)
                        @if($loop->index > 7)
                        <dd>
                            <a href="">
                                <div class="pic"><img class="lazy" data-original="{{ order_complete_machine_pic($search->complete_machine_product_goods) ?? '' }}">
                                </div>
                                <div class="infos">
                                    <b>
                                        {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->name) !!}
                                    </b>
                                    <p>
                                        {!! str_ireplace(Request::get('key'), "<font style='color:#f00;font-size:16px;font_weight:bold'>".Request::get('key')."</font>",$search->additional_arguments['product_description']) !!}
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </a>
                        </dd>
                        @endif
                    @endforeach
                    <div class="clear"></div>
                    <i class="noMore">没有更多的结果了</i>
                </div>
                <span class="lookAll">显示更多</span>
            @endif
            <div class="clear"></div>
        </dl>
    </div>
</div>
