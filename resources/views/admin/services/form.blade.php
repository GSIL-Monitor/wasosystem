<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.services.create'))
            {!! Form::open(['route'=>'admin.services.store','method'=>'post','id'=>'services','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($service,['route'=>['admin.services.update',$service->id],'id'=>'services','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">质保单号：</div>
                <div class="liRight">
                    {!!  Form::text('serial_number',old('serial_number',optional($service)->serial_number ?? 'ZB'.date('YmdHis',time())),['placeholder'=>'质保单号',"class"=>'checkNull','readonly']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">客户信息：</div>
                <div class="liRight">
                    {!!  Form::text('username',old('username',optional($order)->user->username ?? optional($service)->username ?? ''),['placeholder'=>'客户信息',"class"=>'',':disabled'=>'disabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">申报单号：</div>
                <div class="liRight">
                    {!!  Form::text('order_serial_number',old('order_serial_number',optional($order)->serial_number ?? optional($service)->order_serial_number ?? ''),['placeholder'=>'申报单号',"class"=>'',':disabled'=>'disabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保模式：</div>
                <div class="liRight">
                    {!!  Form::select('quality_assurance_model',config('status.service_quality_assurance_model'),old('quality_assurance_model'),['placeholder'=>'申报单号',"class"=>'select2 checkNull quality_assurance_model',':disabled'=>'disabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">故障描述：</div>
                <div class="liRight">
                    {!!  Form::textarea('error_description',old('error_description'),['placeholder'=>'故障描述',"class"=>'checkNull',':disabled'=>'disabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            @if(!empty($order) && !empty($order->warehouseOut->codes))
            <li class="sevenLi">
                <div class="liLeft">订单列表：</div>
                <div class="liRight" >
                    <table class="listTable">
                        <tr>
                            <th class="">类型</th>
                            <th class="tableInfoDel">名称</th>
                            <th class="">数量</th>
                            <th class=""><input type="checkbox" class="selectBox SelectAll"> 条码</th>
                            <th class="">质保时间</th>
                        </tr>
                        @php $order_product_goods=$order->order_product_goods()->orderBy('product_number','asc')->get();
                        @endphp
                        @forelse($order_product_goods as $product_good)
                            <tr>
                                <td class="">
                                    {{  $product_good->product->title }}&nbsp;&nbsp;
                                </td>
                                <td class="tableInfoDel  tablePhoneShow  tableName">
                                    {{  $product_good->name }}
                                </td>
                                <td class="num">
                                    {{ $product_good->pivot->product_good_num / $order->num  }}
                                </td>
                                    <td class="">
                                        @foreach($order->warehouseOut->codes[$loop->index]->code as $item)
                                            @if($service)
                                                @if(!empty($service->product_goods[$product_good->id]))
                                                    @php  $checked=str_contains($item,$service->product_goods[$product_good->id]) ? 'checked' : ''; @endphp
                                                    @else
                                                    @php  $checked=str_contains($item,$service->product_goods) ? 'checked' : ''; @endphp
                                                 @endif
                                            @else
                                                @php $checked='';@endphp
                                            @endif
                                            <label for=""><input :disabled="disabled" class="selectBox selectIds" {{ $checked }} type="checkbox" name="product_goods[{{ $product_good->id }}][]" value="{{ $item }}"> {{ $item }}</label><br/>
                                        @endforeach
                                    </td>
                                <td>
                                    {{ $product_good->quality_time }}/{{ $product_good->getQualityTime($order->created_at)  }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"><div class="empty">没有数据</div></td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <div class="clear"></div>
            </li>
            @endif
            <li>
                <div class="liLeft">上门时间：</div>
                <div class="liRight">
                    <template>
                        <date-picker type="datetime" :value="date"  placeholder="请选择预约上门时间"  name="door_of_time" large transfer></date-picker>
                    </template>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">上门人员：</div>
                <div class="liRight">
                    {!!  Form::select('door_and_service_staff[door][]',$admins,old('door_and_service_staff[door][]'),["class"=>'select2','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">服务人员：</div>
                <div class="liRight">
                    {!!  Form::select('door_and_service_staff[service][]',$admins,old('door_and_service_staff[service][]',array_unique(array_filter(array_flatten(array_merge(optional($order)->participation_admin ?? [],[optional($order)->market]))))),["class"=>'select2 checkNull','multiple']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保状态：</div>
                <div class="liRight">
                    {!!  Form::select('quality_assurance_status',config('status.service_quality_assurance_status'),old('quality_assurance_status'),["class"=>'select2 checkNull','placeholder'=>'请选择质保状态']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">服务事件：</div>
                <div class="liRight">
                    @foreach(config('status.service_quality_assurance_event') as $key=>$item)
                        <label for="event{{ $key }}">
                                {{ Form::radio('service_event',$key,old('service_event'),['id'=>'event'.$key]) }} {{ $item }}
                        </label><br/>
                    @endforeach
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">解决办法：</div>
                <div class="liRight">
                    {!!  Form::textarea('solution',old('solution'),['placeholder'=>'解决办法',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            @if(!Route::is('admin.services.create'))
            <li>
                <div class="liLeft">导出表格：</div>
                <div class="liRight">
                    <a href="{{ route('admin.services.export',$service->id) }}">【质保受理单】</a>
                </div>
                <div class="clear"></div>
            </li>
            @endif
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


