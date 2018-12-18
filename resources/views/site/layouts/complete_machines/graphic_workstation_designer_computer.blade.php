<dl>
    <dd>
        <div class="proBoxes">
            <ul>
                @foreach($graphic_workstation_designer_computer as $key=>$item)
                    @if($key !='0' && $key !='')
                    <li>
                        <div class="pro_pic">
                            <a href="{{ route('server.index',$complete_machine_category[$key]) }}">
                                <h5>{{ $key }}</h5>
                                <img src="{{ order_complete_machine_pic($item->first()->complete_machine_product_goods) ?? '' }}">
                            </a>
                        </div>
                        <div class="proLinks">
                            @foreach($item as $item2)
                                <span>
                                                                      <a href="@if($item2->parent_id ==1 )
                                                                      {{ route('server.show',$item2->id) }}
                                                                      @else
                                                                      {{ route('server.designer',$item2->id) }}
                                                                      @endif">
                                                                          {{ $item2->name }}
                                                                          @switch($item2->marketing)
                                                                              @case('new')
                                                                              <i class="saleIcon newP">新品</i>
                                                                              @break;
                                                                              @case('hot')
                                                                              <i class="saleIcon hotP">热卖</i>
                                                                              @break;
                                                                              @case('moods')
                                                                              <i class="saleIcon popP">人气</i>
                                                                              @break;
                                                                              @case('sale')
                                                                              <i class="saleIcon saleP">折扣</i>
                                                                              @break;
                                                                          @endswitch
                                                                      </a>
                                                                  </span>
                                @break($loop->index == 4)
                            @endforeach
                        </div>
                    </li>
                    @endif
                @endforeach
                <div class="clear"></div>
            </ul>
            <a href="{{ route('server.index','graphic_workstation_designer_computer') }}" class="lookMore"><i></i>查看全部</a>
        </div>
    </dd>
    <div class="clear"></div>
</dl>