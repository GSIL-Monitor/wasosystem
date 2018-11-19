<div class="JJList">
    <ul class="halfTwoUl" id="app">
        <?php echo Form::open(['route'=>['admin.barcode_associateds.store'],'id'=>'barcode_associateds','method'=>'post','onsubmit'=>'return false']); ?>

        <li>
            <div class="liLeft">产品条码：</div>
            <div class="liRight">
                <?php echo Form::text('code',old('code',$barcode_associated['code']),['placeholder'=>'产品条码',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品类型：</div>
            <div class="liRight">
                <?php echo Form::text(null, $barcode_associated['product_good']->product->title ?? '' ,
                ['placeholder'=>'产品类型',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">产品规格：</div>
            <div class="liRight">
                <?php echo Form::hidden('product_good_id',
                old('product_good_id',$barcode_associated['product_good']->id ??  ''
                ),['placeholder'=>'产品规格',"class"=>'checkNull product_good_id','readonly']); ?>

                <?php echo Form::text(null,
                $barcode_associated['product_good']->name ??  ''
                ,['placeholder'=>'产品规格',"class"=>'checkNull','readonly']); ?>

                <?php echo Form::hidden('product_colour',
              $barcode_associated['barcode_associated']->product_colour ??  $barcode_associated['procurement_plan']->product_colour
              ,['placeholder'=>'产品成色',"class"=>'checkNull','readonly']); ?>


            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">入库时间：</div>
            <div class="liRight">
                <?php echo Form::text(null,
                $barcode_associated['procurement_plan']->updated_at ?? ''
                ,['placeholder'=>'入库时间',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">供货单位：</div>
            <div class="liRight">
                <?php echo Form::text(null,
                $barcode_associated['supplier_managements']->name ?? ''
                ,['placeholder'=>'供货单位',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
       <?php if(!empty($barcode_associated['user'])): ?>
        <li>
            <div class="liLeft">关联客户：</div>
            <div class="liRight">
                <?php echo Form::hidden('user_id',old('user_id',$barcode_associated['user']->id ?? 0),['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

                <?php echo Form::text(null,$barcode_associated['user']->username . ' ' .$barcode_associated['user']->nickname,['placeholder'=>'关联客户',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <?php endif; ?>
        <li>
            <div class="liLeft">当前事件：</div>
            <div class="liRight">
                <?php echo Form::text(null,config('status.barcode_associateds_type')[$status],['placeholder'=>'当前事件',"class"=>'checkNull','readonly']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <?php if(!Request::has('search')): ?>
            <?php $status=Request::get('status') ?? Request::get('type');?>
            <li>
                <div class="liLeft">选择事件：</div>
                <div class="liRight">
                    <?php if(Request::has('type')): ?>
                        <?php echo Form::hidden('current_state',old('current_state',config('status.barcode_associateds_type')[$status]),['placeholder'=>'选择事件',"class"=>'checkNull','v-model'=>'selected']); ?>

                        <?php echo Form::text(null,config('status.barcode_associateds_type')[Request::get('type')],['placeholder'=>'选择事件',"class"=>'checkNull','readonly']); ?>

                    <?php else: ?>
                        <?php echo Form::select('current_state',config('codeStatus')[$status],old('current_state'),['placeholder'=>'选择事件',"class"=>'checkNull','v-model'=>'selected','@change'=>'changeSelect']); ?>

                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </li>

            <?php if ($__env->exists('admin.barcode_associateds.fileds.new_two_code')) echo $__env->make('admin.barcode_associateds.fileds.new_two_code', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php if ($__env->exists('admin.barcode_associateds.fileds.two_code_exist')) echo $__env->make('admin.barcode_associateds.fileds.two_code_exist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <li v-if="showProduct">
            <div class="liLeft">产品新规格：</div>
            <div class="liRight">
                <good-remote-select :url="GoodUrl" ></good-remote-select>
            </div>
            <div class="clear"></div>
        </li>
        <?php if ($__env->exists('admin.barcode_associateds.fileds.admin')) echo $__env->make('admin.barcode_associateds.fileds.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if ($__env->exists('admin.barcode_associateds.fileds.description')) echo $__env->make('admin.barcode_associateds.fileds.description', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>