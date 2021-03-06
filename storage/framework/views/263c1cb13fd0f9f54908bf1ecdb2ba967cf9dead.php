
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/js/code.js')); ?>"></script>
    <script>
        $(function () {
            $(document).on('change','.product',function () {
                filtrate($(this),"<?php echo e(route('admin.procurement_plans.get_goods')); ?>")
            })
        });
        var vm = new Vue({
            el: "#app",
            data: {
                finish_procurement_number:false,
                isDisabled: false,
                <?php if(isset($put_in_storage_management)): ?>
                isDisabled: true,
                <?php elseif(Route::is('admin.put_in_storage_managements.create')): ?>
                finish_procurement_number: true,
                <?php else: ?>
                isDisabled: false,
                <?php endif; ?>
                disabled: false,
                procurement_number:'',
                two_code:'',
                code: '',
                finish_procurement_number_count:<?php echo $put_in_storage_management->finish_procurement_number ?? 0; ?>,
                <?php if(isset($put_in_storage_management) && !empty(array_filter($put_in_storage_management->code ?? []))): ?>
                codes:<?php echo json_encode($put_in_storage_management->code,true); ?>,
                <?php else: ?>
                codes: [],
                <?php endif; ?>
                finish: false,
                show: true

            },
            methods: {
                del: function (index) {
                    this.codes.splice(index, 1)
                    this.finish_procurement_number_count--;
                    this.disabled = false;
                },
                in_array: function (code) {
                    var codes = ',' + this.codes.join(',') + ',';
                    return codes.indexOf("," + code + ",") != -1;
                },
                entering: function () {
                    if (!this.in_array(this.code)) {
                        this.checkCode(this.code);
                    } else {
                        showError($('.finish_procurement_number'), '录入条码已存在')
                        this.code = '';
                    }
                },
                checkCode: function (code) {
                    axios.post("<?php echo e(route('admin.put_in_storage_managements.checkCode')); ?>", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        if (response.data > 0) {
                            showError($('.finish_procurement_number'), '录入条码已存在')
                            vm.code = '';
                        } else {
                            vm.codes.push(code)
                            vm.code = '';
                            hideError($('.finish_procurement_number'))
                            vm.finish_procurement_number_count++;
                            if (vm.finish_procurement_number_count == vm.procurement_number) {
                                vm.disabled = true;
                            }
                            console.log(vm.codes);
                        }
                    }).catch(function (err) {

                    });
                },
                checkNumber:function () {
                 if(this.procurement_number < this.finish_procurement_number_count){
                     showError($('.finish_procurement_number'), '确认数量不能小于已录入数量')
                 }else{
                     hideError($('.finish_procurement_number'))
                     this.disabled = false;
                 }
                }
            },
            mounted: function () {
                $('.finish_procurement_number').focus();
            },
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create put_in_storage_managements')): ?>
                    <button type="submit" class="Btn procurement_plans_add blue" procurement_status="finish" form_id="put_in_storage_managements"
                            location="top">保存
                    </button>
                    <button type="submit" class="Btn procurement_plans_add blue" procurement_status="unfinished" form_id="put_in_storage_managements"
                            location="top">临时保存
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.put_in_storage_managements.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>