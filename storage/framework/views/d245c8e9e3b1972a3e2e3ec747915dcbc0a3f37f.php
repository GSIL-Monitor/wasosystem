<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.demand_filtrates.create')): ?>
            <?php echo Form::open(['route'=>'admin.demand_filtrates.store','method'=>'post','id'=>'demand_filtrates','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($demand_filtrate,['route'=>['admin.demand_filtrates.update',$demand_filtrate->id],'id'=>'demand_filtrates','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">名称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'demand_filtrate',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


