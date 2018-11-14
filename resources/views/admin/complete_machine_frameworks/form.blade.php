<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.complete_machine_frameworks.create'))
            {!! Form::open(['route'=>'admin.complete_machine_frameworks.store','method'=>'post','id'=>'complete_machine_frameworks']) !!}
        @else
            {!! Form::model($completeMachineFrameworks,['route'=>['admin.complete_machine_frameworks.update',$completeMachineFrameworks->id],'id'=>'complete_machine_frameworks','method'=>'put']) !!}
        @endif
        <li>
            <div class="liLeft">所属父级：</div>
            <div class="liRight">
                {{ $parent->name }}
                {!!  Form::hidden('parent_id',old('parent_id',$parent->id )) !!}
                {!!  Form::hidden('category',old('category',$category)) !!}
            </div>
            <div class="clear"></div>
        </li>
        @if(!Request::has('parent'))
            <li>
                <div class="liLeft">名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('complete_machine_framework_radio_type'),['placeholder'=>'请输入名称','class'=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <div v-if="is_filtrate == 'filtrate'">
                @if(!Request::has('select'))
                    <li>
                        <div class="liLeft">筛选类型：</div>
                        <div class="liRight">
                            {!!  Form::select('select_type',config('status.complete_machine_framework_select_type'),old('select_type'),['placeholder'=>'请选择筛选类型','class'=>'select2 checkNull']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <div class="liLeft">描述：</div>
                        <div class="liRight">
                            {!!  Form::textarea('description',old('description'),['placeholder'=>'请输描述']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
                @endif
            </div>
            <li>
                <div class="liLeft">图片：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList"
                                   :action-image-url="actionImageUrl"
                                   :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>
        @else
            @if(Request::get('parent') != 252)
                <li>
                    <div class="liLeft">分类：</div>
                    <div class="liRight">
                        {!!  Form::select('child_category',config('status.complete_machine_framework_radio_type'),old('child_category'),['placeholder'=>'请选择一个分类','class'=>'checkNull','v-model'=>'category']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li v-if="category == 'filtrate'">
                    <div class="liLeft">问题：</div>
                    <div class="liRight ">
                        <div class="checkboxs">

                            @foreach($listArr['filtrate'] as $filtrate)
                                <label for="answer{{  $filtrate->id }}">
                                    {!!  Form::checkbox('name['.$filtrate->id.']',$filtrate->name,old('name['.$filtrate->id.']'),['id'=>'answer'.$filtrate->id,'class'=>'checkNull']) !!}
                                    {{ $filtrate->name }}
                                </label>
                            @endforeach
                        </div>

                    </div>
                    <div class="clear"></div>
                </li>
                <li v-if="category == 'answer'">
                    <div class="liLeft">答案：</div>
                    <div class="liRight">
                        <div class="checkboxs">
                            @foreach($listArr['answer'] as $answer)
                                <label for="answer{{ $answer->id }}">
                                    {!!  Form::checkbox('name['.$answer->id.']',$answer->name,old('name['.$answer->id.']'),['id'=>'answer'.$answer->id,'class'=>'checkNull']) !!}
                                    {{ $answer->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
                <li v-if="category == 'product'">
                    <div class="liLeft">答案：</div>
                    <div class="liRight">
                        <div class="checkboxs">
                            @foreach($listArr['product'] as $product)
                                <label for="product{{ $product->id }}">
                                    {!!  Form::checkbox('name['.$product->id.']',$product->name,old('name['.$product->id.']'),['id'=>'product'.$product->id,'class'=>'checkNull']) !!}
                                    {{ $product->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
            @else
                <li>
                    <div class="liLeft"></div>
                    <div class="liRight">
                        <div class="checkboxs">
                            @foreach($listArr['it_service'] as $answer)
                                <label for="answer{{ $answer->id }}">
                                    {!!  Form::checkbox('name['.$answer->id.']',$answer->name.'/'.$answer->details['cooperation_types'],old('name['.$answer->id.']'),['id'=>'answer'.$answer->id,'class'=>'checkNull']) !!}
                                    {{ $answer->name }} / {{ $answer->details['cooperation_types'] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
            @endif
        @endif


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
            is_filtrate: '{{ $category }}',
            category: '',
            @if(Route::is('admin.complete_machine_frameworks.create'))
            defaultList: [],
            @else
            defaultList:{!! $completeMachineFrameworks->pic !!},
            @endif
            actionImageUrl: "{!! env('ActionImageUrl') !!}",
            imageUrl: "{!! env('IMAGES_URL') !!}",
            deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
            fileCount: 1,
        },
        methods: {},
        mounted: function () {
        },
    });

</script>


