<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.task_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.task_managements.store','method'=>'post','id'=>'task_managements','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($task_management,['route'=>['admin.task_managements.update',$task_management->id],'id'=>'task_managements','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">对象：</div>
                <div class="liRight">
                    <?php echo Form::hidden('divisional_id',old('divisional_id',$task_management->divisional->id ?? $divisional->id),['placeholder'=>'task_management',"class"=>'checkNull']); ?>

                    <?php echo Form::text(null,old('',$task_management->divisional->name ?? $divisional->name),['placeholder'=>'对象',"class"=>'checkNull','readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">模式：</div>
                <div class="liRight">
                    <label for="single"><?php echo e(Form::radio('task_mode','single',null,['v-model'=>'task_mode','id'=>'single'])); ?> 单项模式</label>
                    <label for="multiterm"><?php echo e(Form::radio('task_mode','multiterm',null,['v-model'=>'task_mode','id'=>'multiterm'])); ?> 阶梯模式</label>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">目标任务：</div>
                <div class="liRight" >
                    <?php echo Form::number('goal',old('goal'),['placeholder'=>'目标任务（万）',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">保底任务：</div>
                <div class="liRight" >
                    <?php echo Form::number('guaranteed_task',old('guaranteed_task'),['placeholder'=>'保底任务（万）',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">奖励系数：</div>
                <div class="liRight" >
                    <?php echo Form::number('award_coefficient',old('award_coefficient'),['placeholder'=>'奖励系数（%）',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <div v-if="task_mode == 'multiterm'">
                <li>
                    <div class="liLeft">目标任务二：</div>
                    <div class="liRight" >
                        <?php echo Form::number('goal_two',old('goal_two'),['placeholder'=>'目标任务二（万）']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
                <li>
                    <div class="liLeft">奖励系数二：</div>
                    <div class="liRight" >
                        <?php echo Form::number('award_coefficient_two',old('award_coefficient_two'),['placeholder'=>'奖励系数二（%）']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
                <li>
                    <div class="liLeft">目标任务三：</div>
                    <div class="liRight" >
                        <?php echo Form::number('goal_three',old('goal_three'),['placeholder'=>'目标任务三（万）']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
                <li>
                    <div class="liLeft">奖励系数三：</div>
                    <div class="liRight" >
                        <?php echo Form::number('award_coefficient_three',old('award_coefficient_three'),['placeholder'=>'奖励系数三（%）']); ?>

                    </div>
                    <div class="clear"></div>
                </li>
            </div>
            <li>
                <div class="liLeft">单位指标：</div>
                <div class="liRight" >
                    <?php echo Form::number('units_index',old('units_index'),['placeholder'=>'单位指标（万）']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">奖励指标：</div>
                <div class="liRight" >
                    <?php echo Form::number('award_index',old('award_index'),['placeholder'=>'奖励指标（元）']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">处罚指标：</div>
                <div class="liRight" >
                    <?php echo Form::number('punish_index',old('punish_index'),['placeholder'=>'处罚指标（元）']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<script>
    var vm=new Vue({
        el:"#app",
        data:{
            task_mode:'<?php echo e($task_management->task_mode ?? 'single'); ?>'
        }
    });
</script>

