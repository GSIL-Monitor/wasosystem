<div class="JJList">
    <ul class="halfTwoUl" id="app">
        @if(Route::is('admin.procurement_plans.create'))
            {!! Form::open(['route'=>'admin.procurement_plans.store','method'=>'post','id'=>'procurement_plans','onsubmit'=>'return false']) !!}

        @else
            {!! Form::model($procurement_plan,['route'=>['admin.procurement_plans.update',$procurement_plan->id],'id'=>'procurement_plans','method'=>'put','onsubmit'=>'return false']) !!}
            <li>
                <div class="liLeft">预购序列号：</div>
                <div class="liRight">
                    {!!  Form::text('serial_number',old('serial_number',$procurement_plan->serial_number ?? 'YG'.date('YmdHis',time())),['placeholder'=>'procurement_plan',"class"=>'checkNull','readonly']) !!}
                </div>
                <div class="clear"></div>
            </li>
        @endif

            <li>
                <div class="liLeft">采购类型：</div>
                <div class="liRight">
                    {!!  Form::select('procurement_type',config('status.procurement_plans_type'),old('procurement_type'),['placeholder'=>'procurement_plan',"class"=>'checkNull select2',':disabled'=>'isDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">供货单位：</div>
                <div class="liRight">
                    {!!  Form::select('supplier_managements_id',$parameters['supplier_managements'],old('supplier_managements_id'),['placeholder'=>'procurement_plan',"class"=>'checkNull select2',':disabled'=>'isDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品类型：</div>
                <div class="liRight">
                    {!!  Form::select('product_id',$parameters['product'],old('product_id'),['placeholder'=>'请选择产品类型',"class"=>'checkNull select2 product',':disabled'=>'isDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品规格：</div>
                <div class="liRight product_good" >
                    @if(isset($procurement_plan))
                        {!!  Form::select('product_good_id',$parameters['product_goods'],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good',':disabled'=>'isDisabled']) !!}
                        @else
                        {!!  Form::select('product_good_id',[],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good']) !!}
                        @endif
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">采购数量：</div>
                <div class="liRight">
                    {!!  Form::text('procurement_number',old('procurement_number'),['placeholder'=>'采购数量',"class"=>'checkNull OneNumber',':disabled'=>'isFinishDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">产品成色：</div>
                <div class="liRight">
                    @php $arr=config('status.procurement_plans_colour'); array_pull($arr,'bad')@endphp
                    {!!  Form::select('product_colour',$arr,old('product_colour'),['placeholder'=>'procurement_plan',"class"=>'checkNull select2',':disabled'=>'isDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保时间：</div>
                <div class="liRight">
                    {!!  Form::text('quality_time',old('quality_time'),['placeholder'=>'质保时间',"class"=>' OneNumber',':disabled'=>'isDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">采购人员：</div>
                <div class="liRight">
                    {!!  Form::hidden('purchase',old('purchase',$procurement_plan->purchase ?? auth('admin')->user()->id),['placeholder'=>'采购人员',"class"=>'checkNull']) !!}
                    {!!  Form::text(null,$procurement_plan->purchases->name ?? auth('admin')->user()->name,['placeholder'=>'采购人员',"class"=>'checkNull','readonly']) !!}
                    {!!  Form::hidden('admin',old('admin',auth('admin')->user()->id),['placeholder'=>'操作人员',"class"=>'checkNull ']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <div v-if="isShow">
            <li>
                <div class="liLeft">物流公司：</div>
                <div class="liRight">
                    {!!  Form::text('logistics_company',old('logistics_company'),['placeholder'=>'物流公司',"class"=>'',':disabled'=>'isFinishDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">物流单号：</div>
                <div class="liRight">
                    {!!  Form::text('logistics_number',old('logistics_number'),['placeholder'=>'物流单号',"class"=>'',':disabled'=>'isFinishDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
             </div>
            <li class="allLi">
                <div class="liLeft">备注信息：</div>
                <div class="liRight">
                    {!!  Form::textarea('postscript',old('postscript'),['placeholder'=>'备注信息',"class"=>'',':disabled'=>'isFinishDisabled']) !!}
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
<script>
    var vm=new Vue({
        el:"#app",
        data:{
            @if(isset($procurement_plan) && $procurement_plan->procurement_status == 'procurement')
            isDisabled:true,
            isShow:true,
            @elseif(isset($procurement_plan) && $procurement_plan->procurement_status == 'finish')
            isDisabled:true,
            isShow:true,
            isFinishDisabled:true,
            @else
            isShow:false,
            isDisabled:false,
            isFinishDisabled:false,
            @endif
        }
    });
</script>


