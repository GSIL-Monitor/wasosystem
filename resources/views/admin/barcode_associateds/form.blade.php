<div class="JJList">
    <ul class="halfTwoUl" id="app">
        {!! Form::open(['route'=>['admin.barcode_associateds.store'],'id'=>'barcode_associateds','method'=>'post','onsubmit'=>'return false']) !!}
        <li>
            <div class="liLeft">产品条码：</div>
            <div class="liRight">
                {!!  Form::text('code',old('code',$barcode_associated['code']),['placeholder'=>'产品条码',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品类型：</div>
            <div class="liRight">
                {!!  Form::text(null, $barcode_associated['product_good']->product->title ?? '' ,
                ['placeholder'=>'产品类型',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品规格：</div>
            <div class="liRight">
                {!!  Form::hidden('product_good_id',
                old('product_good_id',$barcode_associated['product_good']->id ??  ''
                ),['placeholder'=>'产品规格',"class"=>'checkNull product_good_id','readonly']) !!}
                {!!  Form::text(null,
                $barcode_associated['product_good']->name ??  ''
                ,['placeholder'=>'产品规格',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">入库时间：</div>
            <div class="liRight">
                {!!  Form::text(null,
                $barcode_associated['procurement_plan']->updated_at ?? ''
                ,['placeholder'=>'入库时间',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">供货单位：</div>
            <div class="liRight">
                {!!  Form::text(null,
                $barcode_associated['supplier_managements']->name ?? ''
                ,['placeholder'=>'供货单位',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
       @if(!empty($barcode_associated['user']))
        <li>
            <div class="liLeft">关联客户：</div>
            <div class="liRight">
                {!!  Form::hidden('user_id',old('user_id',$barcode_associated['user']->id ?? 0),['placeholder'=>'关联客户',"class"=>'checkNull','readonly']) !!}
                {!!  Form::text(null,$barcode_associated['user']->username . ' ' .$barcode_associated['user']->nickname,['placeholder'=>'关联客户',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
        @endif
        <li>
            <div class="liLeft">当前事件：</div>
            <div class="liRight">
                {!!  Form::text(null,config('status.barcode_associateds_type')[$status],['placeholder'=>'当前事件',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
        @if(!Request::has('search'))
            @php $status=Request::get('status') ?? Request::get('type');@endphp
            <li>
                <div class="liLeft">选择事件：</div>
                <div class="liRight">
                    @if(Request::has('type'))
                        {!!  Form::hidden('current_state',old('current_state',config('status.barcode_associateds_type')[$status]),['placeholder'=>'选择事件',"class"=>'checkNull','v-model'=>'selected']) !!}
                        {!!  Form::text(null,config('status.barcode_associateds_type')[Request::get('type')],['placeholder'=>'选择事件',"class"=>'checkNull','readonly']) !!}
                    @else
                        {!!  Form::select('current_state',config('codeStatus')[$status],old('current_state'),['placeholder'=>'选择事件',"class"=>'checkNull','v-model'=>'selected','@change'=>'changeSelect']) !!}
                    @endif
                </div>
                <div class="clear"></div>
            </li>

            @includeIf('admin.barcode_associateds.fileds.new_two_code')
        @else
            @includeIf('admin.barcode_associateds.fileds.two_code_exist')
        @endif
        <li v-if="showProduct">
            <div class="liLeft">产品新规格：</div>
            <div class="liRight">
                <good-remote-select :url="GoodUrl" ></good-remote-select>
            </div>
            <div class="clear"></div>
        </li>
        @includeIf('admin.barcode_associateds.fileds.admin')
        @includeIf('admin.barcode_associateds.fileds.description')
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>