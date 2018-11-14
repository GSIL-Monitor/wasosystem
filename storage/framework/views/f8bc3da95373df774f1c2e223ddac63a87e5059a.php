<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.supplier_managements.create')): ?>
            <?php echo Form::open(['route'=>'admin.supplier_managements.store','method'=>'post','id'=>'supplier_managements','onsubmit'=>'return false']); ?>

        <?php else: ?>
            <?php echo Form::model($supplier_management,['route'=>['admin.supplier_managements.update',$supplier_management->id],'id'=>'supplier_managements','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>
            <li>
                <div class="liLeft">简称：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'简称',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">简码：</div>
                <div class="liRight">
                    <?php echo Form::text('code',old('code'),['placeholder'=>'简码',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">联系人：</div>
                <div class="liRight">
                    <?php echo Form::text('linkman',old('linkman'),['placeholder'=>'联系人',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">联系电话：</div>
                <div class="liRight">
                    <?php echo Form::text('phone',old('phone'),['placeholder'=>'联系电话',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">公司地址：</div>
                <div class="liRight">
                    <?php echo Form::text('address',old('address'),['placeholder'=>'联系电话',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">采购人员：</div>
                <div class="liRight">

                    <?php echo Form::hidden('admin',old('address',$supplier_management->admins->id ?? auth('admin')->user()->id),['placeholder'=>'联系电话',"class"=>'']); ?>

                    <?php echo Form::text(null,$supplier_management->admins->name ?? auth('admin')->user()->name,['readonly']); ?>

                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>


