
<div class="editBoxWrap" >
    <div class="editBox">
        <span class="edit_Cancel">×</span>
        <div class="editInfo">
            <div class="DoneInfo">
                <div class="headPic radius"><img src="<?php echo e(order_complete_machine_pic($user_products)); ?>"></div>
                <div class="editName">
                    <form id="completeMachine">
                        <?php echo Form::hidden('null',$order->id,["class"=>'order_id']); ?>

                        <?php echo Form::hidden('null',1,["class"=>'order_num']); ?>

                        <?php echo Form::hidden('price_spread',$order->price_spread ?? 0,["class"=>'price_spread']); ?>

                        <h5 class="xinghao"> <?php echo Form::text('machine_model',$order->machine_model,["class"=>'xh name','readonly']); ?></h5>
                        <?php echo Form::hidden('code',$order->code,["class"=>'codes']); ?>

                        <input type="hidden" value="<?php echo e(config('site.order_type')[$order->order_type]); ?>" class="code" />
                        <?php echo Form::hidden('order_type',$order->order_type); ?>

                        <input type="hidden"  v-model="total_price" name="total_prices"/>
                    </form>
                    <h5 class="price"><b>{{ total_price }}</b>元 <i>(含16%增值税)</i></h5>
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
