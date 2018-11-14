<div class="JJList">
    <ul class="maxUl" >
        @if(Route::is('admin.self_build_terraces.create'))
            {!! Form::open(['route'=>'admin.self_build_terraces.store','method'=>'post','id'=>'self_build_terraces','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($self_build_terrace,['route'=>['admin.self_build_terraces.update',$self_build_terrace->id],'id'=>'self_build_terraces','method'=>'put','onsubmit'=>'return false']) !!}
        @endif

            <li class="sevenLi">
                <div class="liLeft">平台明细：</div>
                <div class="liRight">
                    <table class="listTable">
                        <tr>
                            <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                            <th class="">类型</th>
                            <th class="">名称</th>
                            <th class="">数量</th>
                            <th class="">成本</th>
                            <th class="">金额</th>
                        </tr>
                        @if(!Route::is('admin.self_build_terraces.create'))
                            @php $self_build_terrace_product_goods=$self_build_terrace->product_goods_self_build_terrace()->with('product')->orderBy('product_number','asc')->get(); @endphp
                        @else
                            @php $self_build_terrace_product_goods=Auth::user()->temporary_product_goods()->orderBy('product_number','asc')->get();@endphp
                        @endif
                        @forelse($self_build_terrace_product_goods as $product_good)
                            @if($product_good->product->title == '机箱' && $product_good->details['kun_bang_dian_yuan'])
                                @php $power=$product_good->find($product_good->details['kun_bang_dian_yuan']);@endphp
                            @endif

                            <tr>
                                <td class="tableInfoDel">
                                    <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product_good->id }}">
                                </td>
                                <td class="">
                                    {{  $product_good->product->title }}
                                </td>
                                <td class="tableInfoDel  tablePhoneShow  tableName">
                                    {{  $product_good->name }}
                                </td>
                                <td class="num">
                                    <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="{{ $product_good->pivot->product_good_num  }}" >
                                </td>
                                <td>{{ $product_good->price['cost_price'] }}</td>
                                <td class="total_prices">
                                    {{--$product_good->pivot->product_good_num  获取中间表中的字段信息--}}
                                    {{ $product_good->price['cost_price'] * $product_good->pivot->product_good_num }}
                                </td>
                            </tr>
                            @if(isset($power))
                                <tr >
                                    <td class="num">
                                        <input type="hidden"  class="PJnum good_num"  product-name="{{ $power->product->title }}"  product-bianhao="{{  $power->product->bianhao }}" good-id="{{ $power->id }}" good-framework="{{ $power->framework->name }}" good-jianma="{{ $power->jianma }}">
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6"><div class="empty">没有数据</div></td>
                            </tr>
                        @endforelse

                        <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="addPro" id="app">
                                    {!!  Form::select('product',$arguments['product'],old('product'),['placeholder'=>'请选择产品','v-model'=>'product_id','@change'=>'getArguments()']) !!}
                                    <select2 :good-list="goodList" ></select2>
                                    <input type="number"  value="" v-model="good_num">
                                    <input class="Btn" type="button" @click="add_good()" value="添加">
                                    <input class="red AllDel Btn" data_url="{{ url('/waso/self_build_terraces/destory') }}?goodDel={{ $self_build_terrace->id ?? 'admins' }}&self_build_terrace_id={{ $self_build_terrace->id ?? Auth::user()->id }}"  type="button" value="删除">

                                </div>
                            </td>
                        </tr>
                        <tfoot/>

                    </table>
                </div>
                <div class="clear"></div>
            </li>

            <li>
                <div class="liLeft">产品架构：</div>
                <div class="liRight">
                    {!!  Form::hidden('product_id',old('product_id',23)) !!}
                    {!!  Form::select('jiagou_id',$arguments['terrace_framework'],old('jiagou_id'),['class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品系列：</div>
                <div class="liRight">
                    {!!  Form::select('xilie_id',$arguments['terrace_series'],old('xilie_id'),['class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">平台类型：</div>
                <div class="liRight">
                    {!!  Form::select('details[ping_tai_lei_xing]',$arguments['terrace_type'],old('details[ping_tai_lei_xing]'),['placeholder'=>'请选择平台类型','class'=>'checkNull select2']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入名称','class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品简称：</div>
                <div class="liRight">
                    {!!  Form::text('jiancheng',old('jiancheng'),['placeholder'=>'请输入产品简称','class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品简码：</div>
                <div class="liRight">
                    {!!  Form::text('jianma',old('jianma'),['placeholder'=>'请输入产品简码','class'=>'checkNull']) !!}
                    <span class="redWord">{{ $arguments['terrace']->jianma }}</span>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保时间：</div>
                <div class="liRight">
                    {!!  Form::number('quality_time',old('quality_time',3),['placeholder'=>'请输入质保时间','class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li class="sevenLi">
                <div class="liLeft">价格管理：</div>
                <div class="liRight">
                    {{--产品价格统计--}}
                    @php $priceSun=priceSum($self_build_terrace_product_goods->pluck('price')); @endphp
                    @foreach(config('status.procuctGoodPrices') as $key=>$value)
                        @if($key=='cost_price' || $key=='taobao_price')
                            <label class="priceLabel"><div class="priceTit">{{ $value }}：</div><div class="priceCont">{!!  Form::number('price['.$key.']',old('price['.$key.']',$priceSun[$key]),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$productGood->price[$key] ?? 0]) !!}</div></label>
                        @else
                            <label class="priceLabel"><div class="priceTit">{{ $value }}：</div><div class="priceCont">{!!  Form::number('price['.$key.']',old('price['.$key.']',$priceSun[$key]),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]) !!}</div></label>
                        @endif
                    @endforeach
                    {!!  Form::hidden('float',old('float',$productGood->float ?? 'smooth'),['id'=>'float']) !!}
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
<script src="{{ asset('admin/js/goodPrice.js') }}"></script>
@include('admin.common._addProduct',['model'=>'self_build_terraces','id'=>$self_build_terrace->id ?? Auth::user()->id])

