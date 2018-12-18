<div class="zyw">
    <div class="zyw_left " id="app">
        <ul class="zywUl">

            <?php if(Route::is('admin.information_managements.create')): ?>
                <?php echo Form::open(['route'=>'admin.information_managements.store','method'=>'post','id'=>'information_managements','onsubmit'=>'return false']); ?>

            <?php else: ?>
                <?php echo Form::model($information_management,['route'=>['admin.information_managements.update',$information_management->id],'id'=>'information_managements','method'=>'put','onsubmit'=>'return false']); ?>

            <?php endif; ?>
            <li class="allLi">
                <div class="liLeft">标题：</div>
                <div class="liRight">
                    <?php echo Form::hidden('type',old('type',Request::get('type')),['placeholder'=>'请填写资讯标题',"class"=>'checkNull']); ?>

                    <?php echo Form::text('name',old('name'),['placeholder'=>'请填写资讯标题',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li class="allLi">
                <div class="liLeft">标题图：</div>
                <div class="liRight">
                    <upload-images :file-count="fileCount" :default-list="defaultList" :action-image-url="actionImageUrl" :image-url="imageUrl" :delete-image-url="deleteImageUrl"></upload-images>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">发布：</div>
                <div class="liRight">
                    <label for="show"><?php echo e(Form::checkbox('marketing[show]',0,old('marketing[show]'),['id'=>'show','class'=>'radio'])); ?>发布</label>
                </div>
                <div class="clear"></div>
            </li>
            <li class="allLi">
                <div class="liLeft">标签：</div>
                <div class="liRight">
                    <?php $__currentLoopData = config('status.information_management_marketing'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label for="marketing<?php echo e($key); ?>">
                            <?php echo e(Form::checkbox('marketing['.$key.']',0,null,['id'=>'marketing'.$key,'class'=>'radio'])); ?>

                            <?php echo e($status); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="clear"></div>
            </li>

            <li class="allLi">
                <div class="liLeft">描述：</div>
                <div class="liRight">
                    <?php echo Form::textarea('description',old('description'),['placeholder'=>'资讯描述',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li class="allLi">
                <div class="liLeft">相关整机：</div>
                <div class="liRight">
                    <?php echo Form::select('complete_machines[]',$complete_machines,old('complete_machines[]',$complete_machine),['相关整机'=>'所属分类',"class"=>' select2','multiple']); ?>

                </div>
                <div class="clear"></div>
            </li>
                <li class="allLi">
                    <div class="liLeft">文章内容：</div>
                    <div class="liRight">
                        <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <script id="container" name="content"   type="text/plain">
                            <?php if(!Route::is('admin.information_managements.create')): ?>
                                <?php echo optional($information_management)->content; ?>

                            <?php endif; ?>
                        </script>
                    </div>
                    <div class="clear"></div>
                </li>
            <?php echo Form::close(); ?>


        </ul>
    </div>



</div>




