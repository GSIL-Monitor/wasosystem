
    <li>
        <div class="liLeft">出库类型：</div>
        <div class="liRight">
            {!!  Form::select('out_type',config('status.warehouse_out_managements_type'),old('out_type','sell'),['placeholder'=>'出库类型',"class"=>'checkNull select2']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">序列号：</div>
        <div class="liRight">
            {!!  Form::text('serial_number',old('serial_number'),['placeholder'=>'序列号',"class"=>'checkNull','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">出库时间：</div>
        <div class="liRight">
            {!!  Form::text(null,\Carbon\Carbon::createFromDate(),['placeholder'=>'出库时间',"class"=>'checkNull','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">收货单位：</div>
        <div class="liRight">
            {!!  Form::hidden('user_id',old('user_id'),['placeholder'=>'收货单位',"class"=>'checkNull']) !!}
            {!!  Form::text(null,old('user_id',$warehouse_out_management->user->username .' - '.$warehouse_out_management->user->nickname),['placeholder'=>'收货单位',"class"=>'checkNull','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>

    <li>
        <div class="liLeft">已出库数：</div>
        <div class="liRight">
            {!!  Form::text('finish_out_number',old('finish_out_number',0),['placeholder'=>'已出库数',"class"=>'checkNull','readonly','v-model'=>'out_storage_count',"@change"=>'checkNumber']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">确认数目：</div>
        <div class="liRight">
            {!!  Form::text('out_number',old('out_number'),['placeholder'=>'确认数目',"class"=>'checkNull','v-model'=>'out_storage_storage_counts']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">条码录入：</div>
        <div class="liRight">
            {!!  Form::text(null,null,['placeholder'=>'条码录入',"class"=>'out_storage','v-model'=>'code','v-on:keyup.enter'=>"entering()",':disabled'=>'disabled']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">经办人：</div>
        <div class="liRight">
            {!!  Form::text(null,auth('admin')->user()->name,['placeholder'=>'经办人',"class"=>'checkNull','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li>
        <div class="liLeft">操作人：</div>
        <div class="liRight">
            {!!  Form::hidden('admin',auth('admin')->user()->id,['placeholder'=>'经办人',"class"=>'checkNull','readonly']) !!}
            {!!  Form::text(null,auth('admin')->user()->name,['placeholder'=>'经办人',"class"=>'checkNull','readonly']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li class="allLi">
        <div class="liLeft">备注信息：</div>
        <div class="liRight">
            {!!  Form::textarea('postscript',old('postscript'),['placeholder'=>'备注信息',"class"=>'']) !!}
        </div>
        <div class="clear"></div>
    </li>
    <li class="TiaoMaList">
        <div class="liLeft">条码：</div>
        <div class="liRight">
            {!!  Form::textarea('code',old('code'),['placeholder'=>'备注信息',"class"=>'codes','readonly']) !!}
                <table class="listTable"  ref="good">
                    <tr>
                        <th>产品条码</th>
                        <th>产品类型</th>
                        <th>产品名</th>
                        <th>清除条码</th>
                    </tr>
                    @verbatim
                        <template  v-for="(item,index) in code_arrs">
                        <tr  v-for="(item2,index2) in item">
                        <td><input type="text"  readonly v-model="item2.var"   v-bind:class="[item2.var]" v-bind:data-number="item2.bianhao"   v-bind:data-id="item2.id"  v-bind:data-num="item2.num"></td>
                        <td>{{ item2.type }}</td>
                        <td>{{ item2.name }}</td>
                        <td  ><Poptip
                                    confirm
                                    title="你确定删除这个条码吗?"
                                    @on-ok="del(index,item2.var)"
                                    ok-text="删除"
                            >
                            <Button   class="Btn red">删除</Button>
                            </Poptip></td>
                    </tr>
                        </template>
                    @endverbatim

                   </table>
        </div>
        <div class="clear"></div>
    </li>

