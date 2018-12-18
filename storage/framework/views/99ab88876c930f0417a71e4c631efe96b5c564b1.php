<div class="JJList">
    <ul class="halfTwoUl" id="app">
        <?php echo Form::open(['route'=>['admin.barcode_associateds.store'],'id'=>'barcode_associateds','method'=>'post','onsubmit'=>'return false']); ?>

        <?php if(Request::has('search')): ?>
            <?php if ($__env->exists('admin.barcode_associateds.forms.info')) echo $__env->make('admin.barcode_associateds.forms.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php if(Request::has('searchSelect')): ?>
                <?php $types=config('codeStatus.barcode_associateds_type')[Request::get('type')];?>
                <?php if($types == '借出还回' || $types == '借转销售'): ?>
                    <?php if ($__env->exists('admin.barcode_associateds.forms.loan_out')) echo $__env->make('admin.barcode_associateds.forms.loan_out', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if($types == '进货退货' || $types == '返厂在途' || $types == '报损' || $types == '坏货' || $types == '型号更换'): ?>
                    <?php if ($__env->exists('admin.barcode_associateds.forms.bad')) echo $__env->make('admin.barcode_associateds.forms.bad', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if($types == '质保返回' || $types == '返厂返回'): ?>
                <?php if ($__env->exists('admin.barcode_associateds.forms.returned_to_the_factory')) echo $__env->make('admin.barcode_associateds.forms.returned_to_the_factory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if($types == '质保受理' || $types == '销售退货' || $types == '借转更换' || $types == '质保更换'): ?>
                    <?php if ($__env->exists('admin.barcode_associateds.forms.sell')) echo $__env->make('admin.barcode_associateds.forms.sell', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if($types == '质保取走' || $types == '质保返厂' || $types == '代管转入库' ): ?>
                    <?php if ($__env->exists('admin.barcode_associateds.forms.quality_return')) echo $__env->make('admin.barcode_associateds.forms.quality_return', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if($types == '测试品归还' || $types == '测试品转采购'): ?>
                    <?php if ($__env->exists('admin.barcode_associateds.forms.test')) echo $__env->make('admin.barcode_associateds.forms.test', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($__env->exists('admin.barcode_associateds.forms.'.$status)) echo $__env->make('admin.barcode_associateds.forms.'.$status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endif; ?>
        <?php endif; ?>

        <?php echo Form::close(); ?>

    </ul>
</div>