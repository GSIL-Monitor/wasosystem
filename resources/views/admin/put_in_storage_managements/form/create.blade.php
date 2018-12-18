<div class="JJList">
    <ul class="halfTwoUl" id="app">
        @if(Route::is('admin.put_in_storage_managements.create'))
            {!! Form::open(['route'=>'admin.put_in_storage_managements.store','method'=>'post','id'=>'put_in_storage_managements','onsubmit'=>'return false']) !!}
            <li>
                <div class="liLeft">预购序列号：</div>
                <div class="liRight">
                    {!!  Form::text('serial_number',old('serial_number',$procurement_plan->serial_number ?? 'RK'.date('YmdHis',time())),['placeholder'=>'procurement_plan',"class"=>'checkNull','readonly']) !!}
                </div>
                <div class="clear"></div>
            </li>
        @else
            {!! Form::model($put_in_storage_management,['route'=>['admin.put_in_storage_managements.update',$put_in_storage_management->id],'id'=>'put_in_storage_managements','method'=>'put','onsubmit'=>'return false']) !!}
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
                {!!  Form::select('product_id',$parameters['product'],old('product_id'),['placeholder'=>'请选择产品类型',"class"=>'checkNull select2 product',':disabled'=>'isDisabled','data_product_name'=>'product_good_id']) !!}
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品规格：</div>
            <div class="liRight product_good" >
                @if(isset($put_in_storage_management))
                    {!!  Form::select('product_good_id',$parameters['product_goods'],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good',':disabled'=>'isDisabled']) !!}
                @else
                    {!!  Form::select('product_good_id',[],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good']) !!}
                @endif
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">已录入数量：</div>
                <div class="liRight">
                    {!!  Form::text('finish_procurement_number',old('finish_procurement_number'),['placeholder'=>'录入条目',"class"=>'checkNull','readonly','v-model'=>'finish_procurement_number_count']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">确认数量：</div>
                <div class="liRight">
                    {!!  Form::text('procurement_number',old('procurement_number'),['placeholder'=>'采购数量',"class"=>'checkNull OneNumber','id'=>'check_number',':readonly'=>'isDisabled',"v-model"=>'procurement_number',"@change"=>'checkNumber']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">条码录入：</div>
                <div class="liRight">
                    {!!  Form::text(null,null,['placeholder'=>'条码录入',"class"=>'finish_procurement_number','v-model'=>'code','v-on:keyup.enter'=>"entering()",':disabled'=>'disabled']) !!}
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
                {!!  Form::hidden('purchase',old('purchase',$put_in_storage_management->purchase ?? auth('admin')->user()->id),['placeholder'=>'采购人员',"class"=>'checkNull']) !!}
                {!!  Form::text(null,$put_in_storage_management->purchases->name ?? auth('admin')->user()->name,['placeholder'=>'采购人员',"class"=>'checkNull','readonly']) !!}
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">操作人员：</div>
                <div class="liRight">
                    {!!  Form::hidden('admin',old('admin',auth('admin')->user()->id),['placeholder'=>'操作人员',"class"=>'checkNull ']) !!}
                    {!!  Form::text(null, auth('admin')->user()->name,['placeholder'=>'操作人员',"class"=>'checkNull','readonly']) !!}
                </div>
                <div class="clear"></div>
            </li>
        <li class="allLi">
            <div class="liLeft">备注信息：</div>
            <div class="liRight">

                {!!  Form::textarea('postscript',old('postscript'),['placeholder'=>'备注信息',"class"=>'',":disabled"=>'finish']) !!}
            </div>
            <div class="clear"></div>
        <li class="allLi">
            <li>
                <div class="liLeft">条码：</div>
                <div class="liRight">
                    <textarea name="code" v-model="codes" readonly></textarea>
                <table class="listTable">
                    <tr>
                        <th>条码</th>
                        <th v-show="show">操作</th>
                    </tr>

                    <tr v-for="(item,index) in codes">
                        <td>@{{ item }}</td>
                        <td v-show="show"><Poptip
                                    confirm
                                    title="你确定删除这个条码吗?"
                                    @on-ok="del(index)"
                                    ok-text="删除"
                                   >
                                <Button class="Btn red">删除</Button>
                            </Poptip></td>
                    </tr>
                </table>
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
        </ul>
    </div>






