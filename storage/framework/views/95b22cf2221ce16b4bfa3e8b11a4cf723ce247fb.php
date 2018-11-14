
<?php $__env->startSection('css'); ?>
    <style>
        .maxUl li .liRight table tr td label{display: block;}
        .maxUl li .liRight table tr td .openBtn{color:#176b86; margin:0 20px; cursor: pointer;}
        .maxUl li .liRight table tr td .openTM:hover{text-decoration: underline;}
        .maxUl li .liRight table tr td .TMBox{display: none;}
        .maxUl li .liRight table tr td .TMBox label{margin:0; display: block; text-align: center;}
    </style>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php if ($__env->exists('admin.orders.script.script')) echo $__env->make('admin.orders.script.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns" id="main">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create orders')): ?>
                    <button type="submit" class="Btn common_add" form_id="orders"
                            location="top"><?php if(Route::is('admin.orders.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>
                <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit orders')): ?>
                    <button type="submit" class="Btn common_add" form_id="orders"
                            location="top"><?php if(Route::is('admin.orders.create')): ?>添加<?php else: ?>
                            修改<?php endif; ?></button>

                <?php endif; ?>
                <?php if(!Route::is('admin.orders.create')): ?>
                <button class="Btn orders_for_the_transfer" @click="orders_for_the_transfer">订单过户</button>
                <?php endif; ?>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.orders.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>