
<?php $__env->startSection('js'); ?>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                date:'',
                <?php if(Route::is('admin.services.create')): ?>
                'disabled': false,
                <?php else: ?>
                 date:"<?php echo $service->door_of_time; ?>",
                'disabled': true
                <?php endif; ?>
            }
        });
        $(function () {
            $(document).on('change', '.quality_assurance_model', function () {
                if ($(this).val() == 'complete_machine') {
                    $('.SelectAll').click()
                    $('.sevenLi').find('.error').remove();
                } else {
                    if ($('.SelectAll').is(':checked')) {
                        $('.SelectAll').click()
                    }
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if(Route::is('admin.services.create')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create services')): ?>
                        <button type="submit" class="Btn common_add" form_id="services"
                                location="top">添加
                        </button>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit services')): ?>
                        <button type="submit" class="Btn common_add" form_id="services"
                                location="top">修改
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <?php if(Route::is('admin.services.create')): ?>
                <?php echo $__env->make('admin.common._search',[
                  'url'=>route('admin.services.create'),
                  'status'=>array_except(Request::all(),['type','keyword','_token']),
                  'condition'=>[
                      'serial_number'=>'订单序列号',
                      'code'=>'条码',
                  ]
                  ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.services.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>