<div class="zyw">
    @if(Route::is('admin.product_goods.create'))
        {!! Form::open(['route'=>'admin.product_goods.store','method'=>'post','id'=>'product_goods']) !!}
    @else
        {!! Form::model($productGood,['route'=>['admin.product_goods.update',$productGood->id],'id'=>'product_goods','method'=>'put']) !!}
    @endif
    <div class="zyw_left " id="app">
        <ul class="zywUl">

            <Tabs>
                <tab-pane label="产品基本信息" icon="clipboard">
                    <li>
                        <div class="liLeft">架构类型：</div>
                        <div class="liRight">
                            {!!  Form::hidden('product_id',old('product_id',$product->id)) !!}
                            {!!  Form::hidden('series_name',old('series_name'),['v-model'=>'series_name']) !!}
                            {!!  Form::hidden('framework_name',old('framework_name'),['v-model'=>'framework_name']) !!}
                            @php $frameworks=$product->framework()->whereParentId(0)->order('name','asc')->pluck('name', 'id');@endphp
                            {!!  Form::select('jiagou_id',$frameworks,old('jiagou_id'),['placeholder'=>'请选择架构类型','class'=>'checkNull framework_name','v-model'=>'typed','@change'=>'getCanshus()']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">产品系列：</div>
                        <div class="liRight">
                            <select v-model="xilied" name="xilie_id" class='checkNull series_name' @change="series_names()">
                                <option value="">请先择产品系列</option>
                                <option v-for="(item,index) in series" :value="item.id">@{{ item.name }}</option>
                            </select>
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
                        <div class="liLeft">原厂代码：</div>
                        <div class="liRight">
                            {!!  Form::text('daima',old('daima'),['placeholder'=>'请输入原厂代码','class'=>'']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">质保时间：</div>
                        <div class="liRight">
                            {!!  Form::text('quality_time',old('quality_time'),['placeholder'=>'请输入质保时间','class'=>'checkNull OneNumber']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">产品简码：</div>
                        <div class="liRight">
                            {!!  Form::text('jianma',old('jianma'),['placeholder'=>'请输入产品简码','class'=>'checkNull']) !!}
                            <span class="redWord">{{ $product->jianma }}</span>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li class="allLi">
                        <div class="liLeft">价格管理：</div>
                        <div class="liRight">
                            @foreach(config('status.procuctGoodPrices') as $key=>$value)
                                @if($key=='cost_price' || $key=='taobao_price')
                                    <label class="priceLabel">
                                        <div class="priceTit">{{ $value }}：</div>
                                        <div class="priceCont">{!!  Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$productGood->price[$key] ?? 0]) !!}</div>
                                    </label>
                                @else
                                    <label class="priceLabel">
                                        <div class="priceTit">{{ $value }}：</div>
                                        <div class="priceCont">{!!  Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]) !!}</div>
                                    </label>
                                @endif
                            @endforeach
                            {!!  Form::hidden('float',old('float',$productGood->float ?? 'smooth'),['id'=>'float']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li class="allLi">
                        <div class="liLeft">产品状态：</div>
                        <div class="liRight">
                            @foreach(config('status.procuctGoodStatus') as $key=>$status)
                                <label class="checkBoxLabel" for="{{ $key }}">
                                    @if($key=='show')
                                        {{ Form::checkbox('status['.$key.']',1,old('status['.$key.']',true),['onclick'=>'this.value=(this.value==0)?1:0','id'=>$key]) }}
                                    @else
                                        {{ Form::checkbox('status['.$key.']',0,old('status['.$key.']'),['onclick'=>'this.value=(this.value==0)?1:0','id'=>$key]) }}
                                    @endif
                                    {{ $status }}
                                </label>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                    </li>
                    @if($product->id==20 || $product->id==23)
                        <li class="allLi">
                            <div class="liLeft">产品图片：</div>
                            <div class="liRight">
                                <upload-images :file-count="fileCount" :default-list="defaultList"
                                               :action-image-url="actionImageUrl" :image-url="imageUrl"
                                               :delete-image-url="deleteImageUrl"></upload-images>
                            </div>
                            <div class="clear"></div>
                        </li>
                    @endif
                </tab-pane>
                <tab-pane label="产品参数" icon="ios-settings">
                    @if(count($product->Childrens) > 0)
                        @include('admin.product_goods.details',$product)
                    @endif
                </tab-pane>
            </Tabs>

        </ul>
    </div>

    {{--<div class="zyw_right"></div>--}}

    {!! Form::close() !!}
</div>

<script src="{{ asset('admin/js/goodPrice.js') }}"></script>



