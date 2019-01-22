
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
            <?php if ($__env->exists('admin.barcode_associateds.table.'.$status)) echo $__env->make('admin.barcode_associateds.table.'.$status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>