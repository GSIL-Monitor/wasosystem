
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            $(document).on('change','.search select',function () {
                $('#search').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>

            </div>
            <?php if($status == 'barcode_associated'): ?>
            <form action="<?php echo e(route('admin.barcode_associateds.index')); ?>" method="get" id="search">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="status" value="<?php echo e($status); ?>">
                <div class="search">
                    <?php echo e(Form::select('type',array_except(config('status.barcode_associateds_type'),['procurement','test','sell'
                    ,'loan_out','new','good','bad'
                    ]),old('type',Request::input('type')),['class'=>'select2','placeholder'=>'请选择筛选条件'])); ?>

                </div>
            </form>
            <?php endif; ?>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.barcode_associateds_menu'),'duiBiCanShu'=>$status,'url'=>route('admin.barcode_associateds.index'),'canshu'=>'status'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php switch($status):
                    case ('loan_out'): ?>
                    <?php echo $__env->make('admin.barcode_associateds.table.loan_out', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php break; ?>;
                <?php case ('quality_acceptance'): ?>
                <?php echo $__env->make('admin.barcode_associateds.table.quality_acceptance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>;
                <?php case ('bad'): ?>
                <?php echo $__env->make('admin.barcode_associateds.table.bad', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>;
                <?php case ('returned_to_the_factory_and_warranty_returned_to_the_factory'): ?>
                <?php echo $__env->make('admin.barcode_associateds.table.returned_to_the_factory_and_warranty_returned_to_the_factory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>;
                <?php case ('quality_return'): ?>
                <?php echo $__env->make('admin.barcode_associateds.table.quality_return', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>;
                <?php case ('test'): ?>
                <?php echo $__env->make('admin.barcode_associateds.table.test', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>;
                <?php case ('barcode_associated'): ?>
                <?php echo $__env->make('admin.barcode_associateds.table.barcode_associated', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php break; ?>;
                <?php endswitch; ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>