@extends('admin.layout.default')
@section('js')
    <script>
        var vm = new Vue({
            el: "#app",
            data: {
                @if(isset($put_in_storage_management))
                isDisabled: true,
                @else
                isDisabled: false,
                @endif
                disabled: false,
                code: '',
                @if(isset($put_in_storage_management) && !empty(array_filter($put_in_storage_management->two_code ?? [])))
                codes:{!! json_encode($put_in_storage_management->two_code,true) !!},
                @else
                codes: [],
                @endif
                finish: false,
                show: true

            },
            methods: {
                del: function (index) {
                    this.codes.splice(index, 1)
                },
                in_array: function (code) {
                    var codes = ',' + this.codes.join(',') + ',';
                    return codes.indexOf("," + code + ",") != -1;
                },
                entering: function () {
                    if (!this.in_array(this.code)) {
                        this.checkCode(this.code);
                    } else {
                        showError($('.finish_procurement_number'), '录入条码已存在')
                        this.code = '';
                    }
                },
                checkCode: function (code) {
                    axios.post("{{ route('admin.put_in_storage_managements.checkCode') }}", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        if (response.data > 0) {
                            showError($('.finish_procurement_number'), '录入条码已存在')
                            vm.code = '';
                        } else {
                            vm.codes.push(code)
                            vm.code = '';
                            hideError($('.finish_procurement_number'))
                            console.log(vm.codes);
                        }
                    }).catch(function (err) {

                    });
                }
            },
            mounted: function () {
                $('.finish_procurement_number').focus();
            },
        });

    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button type="submit" class="Btn common_add" form_id="put_in_storage_managements"
                        location="top">保存
                </button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <div  id="app">
                    {!! Form::model($put_in_storage_management,['route'=>['admin.put_in_storage_managements.update',$put_in_storage_management->id],'id'=>'put_in_storage_managements','method'=>'put','onsubmit'=>'return false']) !!}
                    <li>
                        <div class="liLeft">预购序列号：</div>
                        <div class="liRight">
                            {!!  Form::text('serial_number',old('serial_number',$procurement_plan->serial_number ?? 'YG'.date('YmdHis',time())),['placeholder'=>'procurement_plan',"class"=>'checkNull','readonly']) !!}
                        </div>
                        <div class="clear"></div>
                    </li>
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
                        <div class="liRight product_good">
                            @if(isset($put_in_storage_management))
                                {!!  Form::select('product_good_id',$parameters['product_goods'],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good',':disabled'=>'isDisabled']) !!}
                            @else
                                {!!  Form::select('product_good_id',[],old('product_good_id'),['placeholder'=>'请选择产品规格',"class"=>'checkNull select2 good']) !!}
                            @endif
                        </div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="liLeft">二级条码录入：</div>
                        <div class="liRight">
                            {!!  Form::text(null,null,['placeholder'=>'二级条码录入',"class"=>'finish_procurement_number','v-model'=>'code','v-on:keyup.enter'=>"entering()",':disabled'=>'disabled']) !!}
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
                    </li>

                   <li class="TiaoMaList">
                        <div class="liLeft">二级条码：</div>
                        <div class="liRight">
                            <textarea name="two_code" v-model="codes" readonly></textarea>
                            <table class="listTable">
                                <tr>
                                    <th>条码</th>
                                    <th v-show="show">操作</th>
                                </tr>

                                <tr v-for="(item,index) in codes">
                                    <td>@{{ item }}</td>
                                    <td v-show="show">
                                        <Poptip
                                                confirm
                                                title="你确定删除这个条码吗?"
                                                @on-ok="del(index)"
                                                ok-text="删除"
                                        >
                                            <Button class="Btn red">删除</Button>
                                        </Poptip>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <div class="clear"></div>
                    {!! Form::close() !!}
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection