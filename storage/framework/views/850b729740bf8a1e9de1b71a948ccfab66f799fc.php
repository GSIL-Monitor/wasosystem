<div class="JJList">
    <?php $DemandManagementParamenter = app('App\Presenters\DemandManagementParamenter'); ?>
    <ul class="maxUl editInfo" id="app">
        <?php if(Route::is('admin.demand_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.demand_managements.store','method'=>'post','id'=>'demand_managements','onsubmit'=>'return false']); ?>

            <?php echo $__env->make('admin.demand_managements.form.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo Form::model($demand_management,['route'=>['admin.demand_managements.update',$demand_management->id],'id'=>'demand_managements','method'=>'put','onsubmit'=>'return false']); ?>

         <?php echo $__env->make('admin.demand_managements.form.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

            <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>
<?php if(Route::is('admin.demand_managements.create')): ?>
<script>
    var vm = new Vue({
        el:"#app",
        data:{
            <?php if(isset($user)): ?>
            user_disabled:true,
            <?php if($user->visitor_details): ?>
            visitor_details_disabled:true,
            <?php endif; ?>
            <?php endif; ?>
        },
        methods: {

        }
    });
</script>
<?php endif; ?>


