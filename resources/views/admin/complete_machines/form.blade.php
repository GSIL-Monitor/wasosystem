@inject('ProductParamenterPresenter','App\Presenters\ProductParamenterPresenter')
@php $pinyin=$ProductParamenterPresenter->showPinyin();@endphp
@if(!Route::is('admin.complete_machines.create'))
    @php $complete_machine_product_goods=$complete_machine->complete_machine_product_goods()->orderBy('product_number','asc')->get();
    @endphp
@else
    @php $complete_machine_product_goods=Auth::user()->temporary_product_goods()->orderBy('product_number','asc')->get();@endphp

@endif
<div class="JJList zyw">
    <div class="zyw_left">
        <ul class="zywUl" id="app">
            @if(Route::is('admin.complete_machines.create'))
                {!! Form::open(['route'=>'admin.complete_machines.store','method'=>'post','id'=>'complete_machines','onsubmit'=>'return false']) !!}
            @else
                {!! Form::model($complete_machine,['route'=>['admin.complete_machines.update',$complete_machine->id],'id'=>'complete_machines','method'=>'put','onsubmit'=>'return false']) !!}
            @endif

                <Tabs>
                    <tab-pane label="整机基本参数" icon="clipboard">
                        <li>
                            <div class="liLeft">产品型号：</div>
                            <div class="liRight">
                                {!!  Form::text('name',old('name'),['placeholder'=>'产品型号',"class"=>'checkNull name','readonly']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">整机质保：</div>
                            <div class="liRight">
                                {!!  Form::text('quality_time',old('quality_time'),['placeholder'=>'整机质保(年)','class'=>'checkNull OneNumber']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="allLi">
                            <div class="liLeft">配置代码：</div>
                            <div class="liRight">
                                {!!  Form::hidden('null',Request::get('parent_id')==1 ? 3 :4,["class"=>'code']) !!}
                                {!!  Form::hidden('parent_id',old('parent_id')) !!}
                                {!!  Form::text('code',old('code'),['placeholder'=>'配置代码',"class"=>'checkNull codes','readonly']) !!}
                                <Poptip trigger="hover">
                                    <span style="cursor:pointer">查看二维码</span>
                                    <div id="qrcode" slot="content">
                                    </div>
                                </Poptip>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="allLi">
                            <div class="liLeft">配置物料：</div>
                            <div class="liRight">
                                <table class="listTable">
                                    <tr>
                                        <th class="tableInfoDel" ><input type="checkbox" class="selectBox SelectAll"></th>
                                        <th class="">类型</th>
                                        <th class="tableInfoDel">名称</th>
                                        <th class="">数量</th>
                                        <th class="">成本</th>
                                        <th class="">金额</th>
                                    </tr>

                                    @forelse($complete_machine_product_goods as $product_good)
                                        @if($product_good->product->title == '机箱' && $product_good->details['kun_bang_dian_yuan'])
                                            @php $power=$product_good->whereProductId(21)->where('oldid',$product_good->details['kun_bang_dian_yuan'])->first();@endphp
                                        @endif

                                        <tr>
                                            <td class="tableInfoDel" ><input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product_good->id }}"></td>
                                            <td class="">
                                                {{  $product_good->product->title }}
                                            </td>
                                            <td class="tableInfoDel  tablePhoneShow  tableName">
                                                {{  $product_good->name }}
                                            </td>
                                            <td class="num">
                                                <input type="text" readonly="" class="PJnum good_num"
                                                       style="text-align: center;padding: 0"
                                                       value="{{ $product_good->pivot->product_good_num  }}"
                                                       product-name="{{ $product_good->product->title }}"
                                                       product-bianhao="{{  $product_good->product->bianhao }}"
                                                       good-id="{{ $product_good->id }}"
                                                       good-framework="{{ $product_good->framework->name }}"
                                                       good-jianma="{{ $product_good->jianma }}">
                                            </td>
                                            <td>{{ $product_good->price['cost_price'] }}</td>
                                            <td class="total_prices">
                                                {{--$product_good->pivot->product_good_num  获取中间表中的字段信息--}}
                                                {{ $product_good->price['cost_price'] * $product_good->pivot->product_good_num }}
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="empty">没有数据</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    @if(isset($power) && $power)
                                        <tr style="display:none;">
                                            <td class="num">
                                                <input type="text" class="PJnum good_num"
                                                       product-name="{{ $power->product->title }}"
                                                       product-bianhao="{{  $power->product->bianhao }}" good-id="{{ $power->id }}"
                                                       good-framework="{{ $power->framework->name }}"
                                                       good-jianma="{{ $power->jianma }}">
                                            </td>
                                        </tr>
                                    @endif
                                    <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div class="addPro" >
                                                {!!  Form::select('product',$arguments['product'],old('product'),['placeholder'=>'请选择产品','v-model'=>'product_id','@change'=>'getArguments()']) !!}
                                                <select2 :good-list="goodList" ref="Child"></select2>
                                                <input type="number" value="" v-model="good_num">
                                                <input class="Btn" type="button" @click="add_good()" value="添加">
                                                <input class="red AllDel Btn"
                                                       data_url="{{ url('/waso/complete_machines/destory') }}?goodDel={{ $complete_machine->id ?? 'admins' }}&complete_machine_id={{ $complete_machine->id ?? Auth::user()->id }}"
                                                       type="button" value="删除">

                                            </div>
                                        </td>
                                    </tr>
                                    <tfoot/>

                                </table>
                            </div>
                            <div class="clear"></div>
                        </li>


                        <li class="allLi">
                            <div class="liLeft">价格管理：</div>
                            <div class="liRight">

                                {{--产品价格统计--}}
                                @php $priceSun=priceSum($complete_machine_product_goods->pluck('price')) ;@endphp
                                @foreach(config('status.complete_machine_prices') as $key=>$value)
                                    @if($key=='balance')
                                        <label class="priceLabel">
                                            <div class="priceTit">{{ $value }}：</div>
                                            <div class="priceCont">{!!  Form::text('price['.$key.']',old('price['.$key.']',$complete_machine->price[$key] ?? 0),['placeholder'=>'请输入'.$value,'class'=>'checkNull OneNumber zyw_w58','id'=>$key,'original_price'=>$productGood->price[$key] ?? 0]) !!}
                                        </label>
                                    @else
                                        <label class="priceLabel">
                                            <div class="priceTit">{{ $value }}：</div>
                                            <div class="priceCont">{!!  Form::text('price['.$key.']',old('price['.$key.']',$priceSun[$key]),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull OneNumber zyw_w58','id'=>$key]) !!}</div>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="allLi">
                            <div class="liLeft">架构类型：</div>
                            <div class="liRight">
                                @foreach($arguments['framework'] as $key=>$framework)
                                    @php   $frameworkPinYin=strtolower($pinyin->permalink($framework,'_')); @endphp
                                    <label class="checkBoxLabel" for="jiagou{{ $key }}">
                                        {{ Form::checkbox('jiagou['.$frameworkPinYin.']',$framework,old('details['.$frameworkPinYin.']'),['id'=>"jiagou".$key]) }}{{ $framework }}
                                    </label>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="allLi">
                            <div class="liLeft">应用类型：</div>
                            <div class="liRight">
                                @foreach($arguments['application'] as $application)
                                    @php   $applicationPinYin=strtolower($pinyin->permalink($application,'_'));$childrens=$application->children ?? []; @endphp
                                    @if(count($childrens) > 0)
                                        <dl>
                                            <dt>{{ $application->name }}：</dt>
                                            <dd>
                                                @if(count($childrens) > 0)
                                                    @foreach($childrens as $children)
                                                        @php   $applicationPinYin=strtolower($pinyin->permalink($children->name ,'_')); @endphp
                                                        <label class="checkBoxLabel" for="application{{ $applicationPinYin }}">
                                                            {{ Form::checkbox('application['.$applicationPinYin.']',$children->name,old('details['.$applicationPinYin.']'),['id'=>"application".$applicationPinYin]) }}{{ $children->name }}
                                                        </label>
                                                    @endforeach
                                                @endif
                                            </dd>
                                            <div class="clear"></div>
                                        </dl>
                                    @else
                                        <label class="checkBoxLabel" for="application{{ $applicationPinYin }}">
                                            {{ Form::checkbox('application['.$applicationPinYin.']',$application,old('details['.$applicationPinYin.']'),['id'=>"application".$applicationPinYin]) }}{{ $application }}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </li>

                        <li>
                            <div class="liLeft">外形规格：</div>
                            <div class="liRight">
                                {!!  Form::text('additional_arguments[mm]',old('additional_arguments[mm]'),['placeholder'=>'外形规格']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <div class="liLeft">重量(Kg)：</div>
                            <div class="liRight">
                                {!!  Form::text('weight',old('weight'),['placeholder'=>'重量(Kg)','class'=>'OneNumber']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="Li50">
                            <div class="liLeft">宣传单页描述：</div>
                            <div class="liRight">
                                {!!  Form::text('additional_arguments[page_description]',old('additional_arguments[page_description]'),['placeholder'=>'宣传单页描述']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="Li50">
                            <div class="liLeft">产品描述：</div>
                            <div class="liRight">
                                {!!  Form::text('additional_arguments[product_description]',old('additional_arguments[product_description]'),['placeholder'=>'产品描述']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="Li50">
                            <div class="liLeft">支持系统：</div>
                            <div class="liRight">
                                {!!  Form::text('additional_arguments[system]',old('additional_arguments[system]','Windows®  2008/2012/win7/win10; Linux;Unix'),['placeholder'=>'支持系统']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="Li50">
                            <div class="liLeft">温度湿度：</div>
                            <div class="liRight">
                                {!!  Form::text('additional_arguments[humidity]',old('additional_arguments[humidity]','工作温度及相对湿度：5°C - 35°C，8% - 90%（非凝结）；储存温度及相对湿度：-40°C - 70°C，5% - 95%（非凝结）'),['placeholder'=>'温度湿度']) !!}
                            </div>
                            <div class="clear"></div>
                        </li>

                        <div class="clear"></div>
                    </tab-pane>
                    <tab-pane label="整机介绍" icon="document-text">
                        <script id="container" name="details" type="text/plain">
                            @if(!Route::is('admin.complete_machines.create'))
                                {!! $complete_machine->details !!}
                            @endif
                        </script>
                    </tab-pane>
                </Tabs>
            {!! Form::close() !!}
        </ul>
    </div>


</div>

@include('admin.common._addProduct',['model'=>'complete_machines','id'=>$complete_machine->id ?? Auth::user()->id])

