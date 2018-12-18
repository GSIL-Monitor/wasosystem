<div class="JJList zyw">
    <div class="zyw_left" id="app">
        <ul class="zywUl">
            @if(Route::is('admin.orders.create'))
                {!! Form::open(['route'=>'admin.orders.store','method'=>'post','id'=>'orders','onsubmit'=>'return false']) !!}
            @else
                {!! Form::model($order,['route'=>['admin.orders.update',$order->id],'id'=>'orders','method'=>'put','onsubmit'=>'return false']) !!}
            @endif
            <Tabs>
                <tab-pane label="订单详情" icon="clipboard">
                    <li>
                        <div class="liLeft">订单序列号：</div>
                        <div class="liRight">
                            {!!  Form::hidden('null',$parameters['order_type_code'][$order->order_type],["class"=>'code']) !!}
                            {!!  Form::text('serial_number',old('serial_number'),['placeholder'=>'订单序列号',"class"=>'checkNull','readonly']) !!}
                            {!!  Form::hidden('null',$order->user->tax_rates->identifying,["class"=>'tax_point']) !!}
                            {!!  Form::hidden('price_spread',old('price_spread'),["class"=>'price_spread']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">客户账户：</div>
                        <div class="liRight">
                            <input type="text" value="{{ $order->user->username }}" readonly="">
                        </div>
                        <div class="clear"></div>
                    </li>
                    @if($order->order_type !='parts')
                        <li>
                            <div class="liLeft">整机型号：</div>
                            <div class="liRight">
                                {!!  Form::text('machine_model',old('machine_model'),['placeholder'=>'整机型号',"class"=>'checkNull name','readonly']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                    @endif

                    <li class="allLi">
                        <div class="liLeft">配置代码：</div>
                        <div class="liRight">
                            {!!  Form::text('code',old('code'),['placeholder'=>'配置代码',"class"=>'checkNull codes','readonly']) !!}

                            <Poptip trigger="hover">
                                <span style="cursor:pointer">查看二维码</span>
                                <div id="qrcode" slot="content">
                                </div>
                            </Poptip>

                            @if($order->order_status =='intention_to_order' || auth('admin')->user()->can('super edit'))
                                <a class="alertWeb" data_url="{{ route('admin.orders.show',$order->id) }}">修改配置</a>
                            @endif
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">订单物料：</div>
                        <div class="liRight">
                            <table class="listTable">
                                <tr>
                                    <th class="">类型</th>
                                    <th class="tableInfoDel">名称</th>
                                    <th class="">数量</th>
                                    <th class="">成本</th>
                                    <th class="">金额</th>
                                    @if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods']))
                                        <th class="">条码</th>
                                    @endif
                                </tr>
                                @php $order_product_goods=$order->order_product_goods()->orderBy('product_number','asc')->get();
                                @endphp
                                @forelse($order_product_goods as $product_good)
                                    @if($product_good->product->title == '机箱' && $product_good->details['kun_bang_dian_yuan'])
                                        @php $power=$product_good->whereProductId(21)->where('oldid',$product_good->details['kun_bang_dian_yuan'])->first();@endphp
                                    @endif
                                    <tr>
                                        <td class="">
                                            {{  $product_good->product->title }}
                                        </td>
                                        <td class="tableInfoDel  tablePhoneShow  tableName">
                                            {{  $product_good->name }}
                                        </td>
                                        <td class="num">
                                            <input type="text" readonly="" class="PJnum good_num zyw_w50"
                                                   style="text-align: center;padding: 0"
                                                   value="{{ $product_good->pivot->product_good_num / $order->num  }}"
                                                   product-name="{{ $product_good->product->title }}"
                                                   product-bianhao="{{  $product_good->product->bianhao }}"
                                                   good-id="{{ $product_good->id }}"
                                                   good-framework="{{ $product_good->framework->name }}"
                                                   good-jianma="{{ $product_good->jianma }}">
                                            {{  $product_good->pivot->product_good_raid == '请选择raid' ? '' : $product_good->pivot->product_good_raid }}
                                        </td>
                                        <td data-price="{{ $product_good->pivot->product_good_price }}"
                                            class="product_good_price">{{ $product_good->pivot->product_good_price }}</td>
                                        <td class="total_price">
                                            {{--$product_good->pivot->product_good_num  获取中间表中的字段信息--}}
                                            {{ $product_good->pivot->product_good_price * $product_good->pivot->product_good_num }}
                                        </td>
                                        @if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods']))
                                            <td class="">
                                                <div class="openTM openBtn">查看条码</div>
                                                <div class="TMBox">
                                                    {!!  implode('<br/>',$order->warehouseOut->codes[$loop->index]->code ?? []) !!}
                                                </div>
                                            </td>
                                        @endif
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty">没有数据</div>
                                        </td>
                                    </tr>
                                @endforelse
                                @if(isset($power))
                                    <tr>
                                        <td class="num">
                                            <input type="hidden" class="PJnum good_num"
                                                   product-name="{{ $power->product->title }}"
                                                   product-bianhao="{{  $power->product->bianhao }}" good-id="{{ $power->id }}"
                                                   good-framework="{{ $power->framework->name }}"
                                                   good-jianma="{{ $power->jianma }}">
                                        </td>
                                    </tr>
                                @endif
                                <tfoot>
                                <tr>
                                    <td colspan="6">

                                        @if($order->order_type=='parts')
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=AccessoriesOffer&export_name=配件报价表">【配件报价表】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=AssemblyManufacturing&export_name=组装生产单">【组装生产单】</a>
                                            @if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods']))
                                                <a href="{{ route('admin.orders.export',$order->id) }}?export=MaterialCode&export_name=物料条码表">【物料条码表】</a>
                                            @endif
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=Delivery&export_name=出库表">【出库表】</a>
                                            <a class="contract_alert">【合同模版】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?view=measuring&export=Measuring&export_name=借测模版">【借测模版】</a>
                                            @if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods']))
                                                <a href="{{ route('admin.orders.export',$order->id) }}?view=signature_form&export=SignatureForm&type=parts">【签收单】</a>
                                            @endif
                                        @else
                                            <a class="system_solution_alert">【整机方案书】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=UnitQuotation&export_name=整机报价表">【整机报价表】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=AccessoriesOffer&export_name=配件报价表">【配件报价表】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=AssemblyManufacturing&export_name=组装生产单">【组装生产单】</a>
                                            @if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods']))
                                                <a href="{{ route('admin.orders.export',$order->id) }}?export=MaterialCode&export_name=物料条码表">【物料条码表】</a>
                                            @endif
                                            @php $model=substr($order->machine_model,1,1);
                                         $identifying=$order->order_type != 'designer_computer' ? ['W'=>'bg3','G'=>'bg4','E'=>'bg5','DE'=>'bg2'] : ['W'=>'bg5','DE'=>'bg3'];
                                        $img=$identifying[$model] ?? $identifying['DE'];
                                            @endphp
                                            <a target="_blank"
                                               href="{{ route('admin.orders.export',$order->id) }}?export=Publicity&img={{ $img }}&export_name=宣传单页">【宣传单页】</a>
                                            <a class="contract_alert">【合同模版】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?view=measuring&export=Measuring&export_name=借测模版">【借测模版】</a>
                                            <a href="{{ route('admin.orders.export',$order->id) }}?export=Delivery&export_name=出库表">【出库表】</a>
                                            @if(str_contains($order->order_status,['order_acceptance','in_transportation','arrival_of_goods']))
                                                <a class="signature_form_alert">【签收单】</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">订单金额：</div>
                        <div class="liRight">
                            {!!  Form::text('unit_price',old('unit_price'),['placeholder'=>'订单金额',"class"=>'checkNull unit_price OneNumber','readonly',':disabled'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">订单数量：</div>
                        <div class="liRight">
                            {!!  Form::text('num',old('num'),['placeholder'=>'订单金额',"class"=>'checkNull order_num OneNumber ',':readonly'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">总金额：</div>
                        <div class="liRight">
                            {!!  Form::text('total_prices',old('total_prices'),['placeholder'=>'总金额',"class"=>'checkNull total_prices OneNumber',':disabled'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">开票类型：</div>
                        <div class="liRight">
                            {!!  Form::select('invoice_type',$parameters['invoice'],old('invoice_type'),["class"=>'checkNull invoice_type',':disabled'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="invoice_infos">
                        <div class="liLeft">开票信息：</div>
                        <div class="liRight">
                            {!!  Form::select('invoice_info',array_prepend($order->user->user_company()->pluck('name','id')->toArray(),'请选择开票信息',''),old('invoice_info'),["class"=>'checkNull invoice_info',':disabled'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">订单状态：</div>
                        <div class="liRight">

                            @switch($order->order_status)
                                @case('placing_orders')
                                {!!  Form::select('order_status',array_only($parameters['order_status'],['intention_to_order','placing_orders','order_acceptance']),old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']) !!}
                                @break
                                @case('order_acceptance')
                                {!!  Form::select('order_status',array_only($parameters['order_status'],['intention_to_order','placing_orders','order_acceptance','in_transportation']),old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']) !!}
                                @break
                                @case('in_transportation')
                                {!!  Form::select('order_status',$parameters['order_status'],old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']) !!}
                                @break
                                @case('arrival_of_goods')
                                {!!  Form::select('order_status',$parameters['order_status'],old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']) !!}
                                @break
                                @default
                                {!!  Form::select('order_status',array_only($parameters['order_status'],['intention_to_order','placing_orders']),old('order_status'),['placeholder'=>'订单状态',"class"=>'checkNull','@change'=>'get_order_satus()','v-model'=>'order_status']) !!}
                            @endswitch
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">款项状态：</div>
                        <div class="liRight">
                            @if($order->payment_status == 'account_paid' )

                                {!!  Form::text('payment_status',old('payment_status',$parameters['payment_status'][$order->payment_status]),['placeholder'=>'款项状态',"class"=>'checkNull',':disabled'=>'isDisabled']) !!}
                            @else
                                {!!  Form::select('payment_status',array_except(array_prepend($parameters['payment_status'],'请选择款项状态',''),['account_paid']),old('payment_status'),['placeholder'=>'款项状态',"class"=>'checkNull',':disabled'=>'isDisabled']) !!}
                            @endif
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">服务模式：</div>
                        <div class="liRight">
                            {!!  Form::select('service_status',$parameters['service'],old('service_status'),['placeholder'=>'服务模式',"class"=>'checkNull service_status',':disabled'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">销售人员：</div>
                        <div class="liRight">
                            {!!  Form::text('market',old('market',$parameters['admins'][$order->market] ?? ''),['placeholder'=>'销售人员',"class"=>'checkNull','disabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">受理配货：</div>
                        <div class="liRight">
                            {!!  Form::select('participation_admin[acceptance][]',$parameters['admins'],old('participation_admin[acceptance][]'),["class"=>'checkNull select2','multiple',':disabled'=>'acceptance']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">技术验证：</div>
                        <div class="liRight">
                            {!!  Form::select('participation_admin[skill][]',$parameters['admins'],old('participation_admin[skill][]'),["class"=>'checkNull select2','multiple',':disabled'=>'skill']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">打包物流：</div>
                        <div class="liRight">
                            {!!  Form::select('participation_admin[pack][]',$parameters['admins'],old('participation_admin[pack][]'),["class"=>'checkNull select2','multiple',':disabled'=>'pack']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">物流地址：</div>
                        <div class="liRight">
                            {!!  Form::select('logistics_id',array_prepend($order->user->user_address()->pluck('address','id')->toArray(),'无需物流',0),old('logistics_id'),['placeholder'=>'无需物流',"class"=>'checkNull select2',':disabled'=>'pack']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <div class="clear"></div>
                    <li>
                        <div class="liLeft">物流信息：</div>
                        <div class="liRight">
                            {!!  Form::text('logistics_info',old('logistics_info'),['placeholder'=>'物流信息',"class"=>'checkNull',':disabled'=>'pack']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">包裹件数：</div>
                        <div class="liRight">
                            {!!  Form::text('parcel_count',old('parcel_count'),['placeholder'=>'包裹件数',"class"=>'checkNull OneNumber',':disabled'=>'pack']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li class="Li50">
                        <div class="liLeft">客户要求：</div>
                        <div class="liRight">
                            {!!  Form::textarea('user_remark',old('user_remark'),['placeholder'=>'客户要求',"class"=>'',':readonly'=>'isDisabled','title'=>optional($order)->user_remark ?? '']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="Li50">
                        <div class="liLeft">公司备注：</div>
                        <div class="liRight">
                            {!!  Form::textarea('company_remark',old('company_remark'),['placeholder'=>'公司备注',"class"=>'',':readonly'=>'isDisabled','title'=>optional($order)->company_remark ?? '']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">是否加急：</div>
                        <div class="liRight">
                            {!!  Form::checkbox('urgent',$order->urgent,old('urgent'),['placeholder'=>'是否加急',"class"=>'radio',':disabled'=>'isDisabled']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">装机流程图：</div>
                        <div class="liRight">
                            {!!  Form::checkbox('flow_pic',$order->flow_pic,old('flow_pic'),['placeholder'=>'应用说明',"class"=>'radio']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <div class="clear"></div>
                </tab-pane>
                {{--<tab-pane label="物料列表" icon="navicon-round"></tab-pane>--}}
                <tab-pane label="装机流程图" icon="upload">

                    <li class="allLi">
                        <div class="liLeft">上传流程图：</div>
                        <div class="liRight">
                            <upload-images :file-count="fileCount" :default-list="defaultList"
                                           :action-image-url="actionImageUrl" :image-url="imageUrl"
                                           :delete-image-url="deleteImageUrl"></upload-images>

                        </div>
                        <div class="clear"></div>
                    </li>
                </tab-pane>
            </Tabs>

            {!! Form::close() !!}
        </ul>
    </div>
    {{--<div class="zyw_right"></div>--}}

</div>



