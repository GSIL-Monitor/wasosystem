<div class="editBoxWrap">
    <div class="editBox">
        <span class="edit_Cancel">×</span>
    <div class="editInfo">
        <div class="DoneInfo">
            <div class="headPic radius"><img src="{{ order_complete_machine_pic($common_equipment->common_equipment_product_goods) }}"></div>
            <div class="editName">
                <form id="completeMachine">
                {!!  Form::hidden('null',$common_equipment->id,["class"=>'order_id']) !!}
                {!!  Form::hidden('null',1,["class"=>'order_num']) !!}
                {!!  Form::hidden('price_spread', 0,["class"=>'price_spread']) !!}
                <h5 class="xinghao"> {!!  Form::text('machine_model',$common_equipment->machine_model,["class"=>'xh name','readonly']) !!}</h5>
                {!!  Form::hidden('code',$common_equipment->code,["class"=>'codes']) !!}
                <input type="hidden" value="{{ $parameters['order_type_code'][$common_equipment->order_type] }}" class="code" />
                {!!  Form::hidden('order_type',$common_equipment->order_type) !!}
                <input type="hidden"  v-model="total_price" name="total_prices"/>
                </form>
                <h5 class="price"><b>@{{ total_price }}</b>元 <i>(含16%增值税)</i></h5>
               <div class="DoneControl">
                   <Poptip
                           confirm
                           title="你确定保存意向配置吗?"
                           @on-ok="save()"
                           ok-text="保存意向配置"
                           placement="bottom"
                   >
                       <Button class="reset"><span>保存意向配置</span></Button>
                   </Poptip>
                   <Poptip
                           confirm
                           title="你确定重置吗?"
                           @on-ok="reset()"
                           ok-text="重置"
                           placement="bottom"
                   >
                       <Button class="reset"><span>恢复默认</span></Button>
                   </Poptip>
                   {{--<span class="reset" @click="reset">恢复默认</span>--}}
               </div>
                <div id="peizhi"></div>
            </div>
        </div>
        <div class="tableTh">
            <div class="A_caozuo">操作</div>
            <div class="A_type">类别</div>
            <div class="A_easy_name">规格</div>
            <div class="A_num">数量</div>
            <div class="A_radius">&nbsp;</div>
            <div class="A_detail">参数</div>
            <div class="clear"></div>
        </div>

    </div>
        <material_editor
                ref="child"
                :good-lists="goodLists"
                :raid-lists="raids"
                v-bind:total_price="total_price"
                v-on:price="set_price($event)"
        ></material_editor>
  </div>
</div>
