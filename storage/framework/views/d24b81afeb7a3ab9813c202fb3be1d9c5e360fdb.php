<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.divisional_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.divisional_managements.store','method'=>'post','id'=>'divisional_managements','onsubmit'=>'return false']); ?>

            <li>
                <div class="liLeft">所属部门：</div>
                <div class="liRight">
                    <?php echo Form::hidden('parent_id',old('parent_id',$parent->id)); ?>

                    <?php echo Form::text(null,$parent->name,['placeholder'=>'名称',"disabled"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <?php else: ?>
            <?php echo Form::model($divisional_management,['route'=>['admin.divisional_managements.update',$divisional_management->id],'id'=>'divisional_managements','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>

            <transition name="fade">
            <li v-if="picked !== 'member'">
                <div class="liLeft">名称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'名称',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            </transition>
            <?php if(Route::is('admin.divisional_managements.create')): ?>
            <transition name="fade">
                <li>
                    <div class="liLeft">部门类型：</div>
                    <div class="liRight" >
                        <label for="one"><input type="radio" class='checkNull' id="one" name="identifying"  value="company" v-model="picked">公司</label>
                        <label for="three"><input type="radio" class='checkNull' id="three" name="identifying" value="department" v-model="picked">部门</label>
                        <label for="four"><input type="radio" class='checkNull' id="four" name="identifying" value="group" v-model="picked">分组</label>
                        <label for="two"><input type="radio" class='checkNull' id="two" name="identifying" value="member"  v-model="picked">成员</label>
                    </div>
                    <div class="clear"></div>
                </li>
            </transition>
            <transition name="fade">
                <li v-if="picked === 'member'">
                    <div class="liLeft">成员：</div>
                    <div class="liRight" >
                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label for="four<?php echo e($key); ?>">
                                <?php echo Form::checkBox('admins[]',$key,old('admins[]'),['id'=>'four'.$key]); ?>

                                <?php echo e($item); ?></label>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="clear"></div>
                </li>
            </transition>
            <?php endif; ?>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<script>
    var vm = new Vue({
        el:"#app",
        data:{
            typed:'',
            <?php if(Route::is('admin.divisional_managements.create')): ?>
            <?php if($parent->identifying =='company'): ?>
                 picked: 'department',
            <?php elseif($parent->identifying =='department'): ?>
                 picked: 'group',
           <?php elseif($parent->identifying =='group'): ?>
                 picked: 'member',
            <?php else: ?>
                picked: 'member',
            <?php endif; ?>
            <?php endif; ?>
        },
        methods: {

        }
    });
</script>


