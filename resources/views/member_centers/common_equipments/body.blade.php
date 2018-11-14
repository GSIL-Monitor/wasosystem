<div class="right">
                <div class="info">
                    <div class="tit bigTit">
                        <h5>常用配置</h5>
                    </div>

                    <div class="RefreshBtn">
                        <a class="Refresh common_update" form_id="AllEdit"><i></i>更新价格</a>
                        <form action="{{ route('common_equipments.update_prices') }}" method="post" id="AllEdit" onsubmit="return false">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>

                    <ul class="PZList">
                      @forelse($common_equipments as $common_equipment)
                            <li>
                                <div class="PZTable">
                                    <div class="PZInfo">
                                        <div class="infoT">
                                            <h5 class="PZName"><a href="{{ route('common_equipments.edit',$common_equipment->id) }}">{{ $common_equipment->name }}</a></h5><input class="PZNameInput" type="text" value="{{ $common_equipment->name }}">
                                            <h5 class="PZTime">{{ $common_equipment->updated_at->format('Y-m-d') }}</h5>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="infoL">
                                            <h5 class="PZType">
                                                <span>
                                                 @if($common_equipment->order_type == 'designer_computer' )
                                                     @switch($common_equipment->machine_model)
                                                             @case(starts_with($common_equipment->machine_model,'ND7'))
                                                                ND7000系列
                                                             @break;
                                                            @case(starts_with($common_equipment->machine_model,'ND8'))
                                                            ND8000系列
                                                            @break;
                                                            @case(starts_with($common_equipment->machine_model,'ND9'))
                                                            ND9000系列
                                                            @break;
                                                            @case(starts_with($common_equipment->machine_model,'NP'))
                                                            办公电脑系列
                                                            @break;
                                                            @case(starts_with($common_equipment->machine_model,'NW'))
                                                            图形工作站
                                                            @break;
                                                     @endswitch
                                                     @else
                                                        {{ $parameters['order_type'][$common_equipment->order_type] }}
                                                     @endif

                                                </span>
                                                <span class="PZCode">（{{ $common_equipment->machine_model }} ）</span>
                                            </h5>
                                        </div>

                                        <div class="infoR">

                                            <h5 class="PZPrice">
                                                <em></em>
                                                @if($common_equipment->total_prices > $common_equipment->old_prices)
                                                <img src="{{ asset('pic/upPrice.png') }}">
                                                @elseif($common_equipment->total_prices < $common_equipment->old_prices)
                                                <img src="{{ asset('pic/downPrice.png') }}">
                                                @endif
                                                {{ $common_equipment->total_prices }}.00元</h5>
                                            <h5 class="PZPrice PZOldPrice"><em>更新前：</em>{{ $common_equipment->old_prices }}.00元</h5>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="PZBtn">
                                        <span class="edit" >修改配置名</span>
                                        <a class="Del" data_title="{{ $common_equipment->name }}" data_id="{{ $common_equipment->id }}" data_url="{{ url('common_equipments/destroy') }}">删除</a>
                                        <a class="place_an_order" href="javascript:void(0)" data_url="{{ route('common_equipments.update',$common_equipment->id) }}" data_title="确定将（{{ $common_equipment->name }}）这个配置下单吗?">意向下单</a>
                                        <a class="lookInfo" href="{{ route('common_equipments.edit',$common_equipment->id) }}">配置详情</a>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="PZEditBtn">
                                        <span class="sure" data_url="{{ route('common_equipments.update',$common_equipment->id) }}">确定</span>
                                        <span class="cancel">取消</span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </li>
                       @empty
                          <li>没有常用配置</li>
                     @endforelse
                        <div class="clear"></div>
                    </ul>


                </div>
                <div id="page">
                    {{ $common_equipments->links() }}
                </div>
            </div>
