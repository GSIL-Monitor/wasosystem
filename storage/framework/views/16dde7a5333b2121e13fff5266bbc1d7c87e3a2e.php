<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.settings.create')): ?>
            <?php echo Form::open(['route'=>'admin.settings.store','method'=>'post','id'=>'settings','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($settings,['route'=>['admin.settings.update',$settings->id],'id'=>'settings','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">settings：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'settings',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


