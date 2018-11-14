<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.it_services.create'))
            {!! Form::open(['route'=>'admin.it_services.store','method'=>'post','id'=>'it_services']) !!}
        @else
            {!! Form::model($it_service,['route'=>['admin.it_services.update',$it_service->id],'id'=>'it_services','method'=>'put']) !!}
        @endif
        <li>
            <div class="liLeft">架构类型：</div>
            <div class="liRight">
                {!!  Form::hidden('product_id',old('product_id',24)) !!}
                {!!  Form::select('jiagou_id',$product_framework,old('jiagou_id',162),['placeholder'=>'请选择架构类型','class'=>'checkNull select2']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品系列：</div>
            <div class="liRight">
                {!!  Form::select('xilie_id',$product_series,old('xilie_id'),['placeholder'=>'请选择架构类型','class'=>'checkNull select2']) !!}
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
            <div class="liLeft">合作类型：</div>
            <div class="liRight">
                {!!  Form::text('details[cooperation_types]',old('details[cooperation_types]'),['placeholder'=>'请输入合作类型','class'=>'']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品基数：</div>
            <div class="liRight">
                {!!  Form::number('details[product_base]',old('details[product_base]'),['placeholder'=>'产品基数','class'=>'checkNull']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">计数单位：</div>
            <div class="liRight">
                {!!  Form::text('details[tally]',old('details[tally]'),['placeholder'=>'请输入计数单位','class'=>'']) !!}
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">描述：</div>
                <div class="liRight">
                    {!!  Form::textarea('details[description]',old('details[description]'),['placeholder'=>'请输入描述','class'=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
        <li class="sevenLi">
            <div class="liLeft">价格管理：</div>
            <div class="liRight">
                @foreach(config('status.procuctGoodPrices') as $key=>$value)
                    @if($key=='cost_price' || $key=='taobao_price')
                        <label class="priceLabel"><div class="priceTit">{{ $value }}：</div><div class="priceCont">{!!  Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'class'=>'checkNull','id'=>$key,'original_price'=>$it_service->price[$key] ?? 0]) !!}</div></label>
                    @else
                        <label class="priceLabel"><div class="priceTit">{{ $value }}：</div><div class="priceCont">{!!  Form::number('price['.$key.']',old('price['.$key.']'),['placeholder'=>'请输入'.$value,'readonly','class'=>'checkNull','id'=>$key]) !!}</div></label>
                    @endif
                @endforeach
                {!!  Form::hidden('float',old('float',$it_service->float ?? 'smooth'),['id'=>'float']) !!}
            </div>
            <div class="clear"></div>
        </li>

        <li>
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
            <li>
                <div class="liLeft">产品图片：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>

        {!! Form::close() !!}
    </ul>

</div>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
<script src="{{ asset('admin/js/goodPrice.js') }}"></script>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            @if(Route::is('admin.it_services.create'))
            defaultList: [],
            @else
            defaultList:{!! $it_service->pic !!},
            @endif
            actionImageUrl: "{!! env('ActionImageUrl') !!}",
            imageUrl: "{!! env('IMAGES_URL') !!}",
            deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
            fileCount:1,
        },
        methods: {
        },
        mounted: function () {

        },
    });

</script>





