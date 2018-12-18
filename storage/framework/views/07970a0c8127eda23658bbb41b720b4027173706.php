
<?php $__env->startSection('js'); ?>
    <script>
        var vm = new Vue({
            el: "#app",
            data: {
                is_show: false,
                typed: '',
                xilied: '',
                series_name:'',
                framework_name:'',
                series: [],
                <?php if(Route::is('admin.product_goods.create')): ?>
                defaultList: [],
                <?php else: ?>
                defaultList:<?php echo $productGood->pic; ?>,
                <?php endif; ?>
                actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
                imageUrl: "<?php echo env('IMAGES_URL'); ?>",
                deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
                fileCount:5,
            },
            methods: {
                getCanshus: function () {
                    this.framework_name=$('.framework_name option:selected').text();
                    const Notice = this.$Notice;
                    axios.post("<?php echo e(route('admin.product_goods.getseries')); ?>", {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "parent_id": this.typed,
                    }).then(function (response) {
                        vm.series = response.data;
                    })
                        .catch(function (err) {
                            Notice.error({
                                title: err.message
                            });
                        });
                },
                series_names: function () {
                    this.series_name=$('.series_name option:selected').text();
                }
            },
            mounted: function () {
                <?php if(!Route::is('admin.product_goods.create')): ?>
                    this.typed = "<?php echo e($productGood->jiagou_id); ?>",
                    this.xilied = "<?php echo e($productGood->xilie_id); ?>",
                    this.series_name="<?php echo e($productGood->series_name); ?>",
                    this.series = this.getCanshus(),
                    this.framework_name="<?php echo e($productGood->framework_name); ?>"
                <?php endif; ?>

            },
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create product_goods')): ?>
                    <button type="submit" class="Btn common_add" form_id="product_goods"
                            location="top"><?php if(Route::is('admin.product_goods.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product_goods')): ?>
                    <button type="submit" class="Btn common_add" form_id="product_goods"
                            location="top"><?php if(Route::is('admin.product_goods.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.product_goods.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>