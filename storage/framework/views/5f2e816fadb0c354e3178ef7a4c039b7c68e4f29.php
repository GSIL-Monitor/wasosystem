
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            $(document).on('click','.setting_del',function () {
              var url=$(this).attr('data_url');
              var key=$(this).attr('key');
                axios.post(url, {
                    "_token": getToken(),
                    "_method": "delete",
                    "key": key
                })
                    .then(function (response) {
                        toastrMessage('success', '删除成功')
                    })
                    .catch(function (err) {
                        toastrMessage('error', '删除失败')
                    });
            });
        });
    </script>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create settings')): ?>
                    <button class="changeWeb Btn" data_url="<?php echo e(route('admin.settings.create')); ?>">添加</button>
                <?php endif; ?>
            </div>
            <?php echo Form::open(['route'=>'admin.settings.store','method'=>'post']); ?>

                <div class="search">
                    key：<?php echo Form::text('key',old('key'),['placeholder'=>'key',"required"]); ?>

                    值：<?php echo Form::text('value',old('value'),['placeholder'=>'值',"required"]); ?>

                    <input type="submit" class="Btn green"  value="搜索">
                </div>
            </form>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <ul class="maxUl" id="app">
                  <li>
                     <div class="liLeft">关键字：</div>
                     <div class="liRight">
                         <?php echo Form::open(['route'=>'admin.settings.create','method'=>'post','id'=>'settings']); ?>

                         <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="valLabel">
                              <div class="valLabelTit"><?php echo e($setting); ?>：</div>
                              <div class="valLabelCont">
                                 <?php echo Form::text($key.'.value',old($key.'.value',$key['value'] ?? ''),['placeholder'=>$setting,"class"=>'checkNull']); ?>

                                 <a data_url="<?php echo e(url('/waso/settings/destory')); ?>" class="setting_del" key=<?php echo e($key); ?>>删除</a>
                              </div>
                            </label>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php echo Form::close(); ?>

                     </div>
                     <div class="clear"></div>
                  </li>
                  <div class="clear"></div>
                </ul>




 <!--                <ul class="maxUl" id="app">
                                    <?php echo Form::open(['route'=>'admin.settings.create','method'=>'post','id'=>'settings']); ?>

                                    <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="liLeft"><?php echo e($setting); ?>：</div>
                                            <div class="liRight">
                                                <?php echo Form::text($key.'.value',old($key.'.value',$key['value'] ?? ''),['placeholder'=>$setting,"class"=>'checkNull']); ?>

                                                <a data_url="<?php echo e(url('/waso/settings/destory')); ?>" class="setting_del" key=<?php echo e($key); ?>>删除</a>
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                        <div class="clear"></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo Form::close(); ?>

                                </ul>   -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>