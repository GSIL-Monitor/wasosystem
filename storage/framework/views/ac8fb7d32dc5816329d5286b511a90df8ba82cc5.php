
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {

            $(document).on('change','.search select',function () {
                var code = "<?php echo e(Request::get('keyword')); ?>";
                var type = $(this).val();
                var status = "<?php echo e(optional($last)->out_type ?? optional($last)->procurement_type ?? optional($last)->current_state ?? ''); ?>";
                if (status){
                var id = "<?php echo e(optional($last)->id ?? ''); ?>";

                var category = "<?php echo e(optional($last)->type ?? ''); ?>";
                var product_good_id = "<?php echo e(optional($product)->product_goods->id  ?? optional($product)->product_good->id ?? ''); ?>";
                var param = '?category='+category+'&status=' + status + '&type=' + type + '&id=' + id + '&code=' + code + '&product_good_id=' + product_good_id+'&searchSelect=""';
                $('.openFrame').attr('data_url', '<?php echo e(route('admin.barcode_associateds.create')); ?>' + param);
                console.log( '<?php echo e(route('admin.barcode_associateds.create')); ?>' + param);
                $('.openFrame').click();
            }
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
        <?php echo $__env->make('admin.common._search',[
        'url'=>route('admin.barcodes.index'),
        'status'=>array_except(Request::all(),['type','keyword','_token']),
        'condition'=>array_prepend($condition,'请选择事件',''),
        'placeholder'=>'请输入要查询的条码'
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="phoneBtnOpen"></div>
            <div class="PageBtnTxt">
               <div><?php echo e(optional($product)->products->title  ?? optional($product)->product_good->product->title ?? ''); ?></div>
               <div><?php echo e(optional($product)->product_goods->name  ?? optional($product)->product_good->name ?? ''); ?></div>
            </div>
        </div>
        <div class="PageBox">
         <?php echo $__env->make('admin.barcodes.table.barcode_associated', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <a class="changeWeb openFrame" data_url=""></a>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>