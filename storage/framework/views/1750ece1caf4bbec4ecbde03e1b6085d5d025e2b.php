
<?php $DemandFiltrateParamenter = app('App\Presenters\DemandFiltrateParamenter'); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create demand_filtrates')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.demand_filtrates.create')); ?>">添加</button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete demand_filtrates')): ?>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="<?php echo e(url('/waso/demand_filtrates/destory')); ?>">删除
                    </button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="<?php echo e(route('admin.allupdate')); ?>" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="table" value="demand_filtrates">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">修改时间</th>

                    <th  class="">操作</th>

                </tr>
                <?php echo $DemandFiltrateParamenter->tree($demand_filtrates,$prefix='',43); ?>

                
                    
                        
                            
                        
                        
                                                                               
                        
                        
                        
                    
                    
                     
                
            </table>
            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>