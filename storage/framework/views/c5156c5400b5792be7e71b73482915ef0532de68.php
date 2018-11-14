<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.user_addresses.create')): ?>
            <?php echo Form::open(['route'=>'admin.user_addresses.store','method'=>'post','id'=>'user_addresses','onsubmit'=>'return false']); ?>

            <?php echo Form::hidden('user_id',old('user_id',request()->input('user_id'))); ?>

        <?php else: ?>
            <?php echo Form::model($user_address,['route'=>['admin.user_addresses.update',$user_address->id],'id'=>'user_addresses','method'=>'put','onsubmit'=>'return false']); ?>

        <?php endif; ?>

            <li>
                <div class="liLeft">序号：</div>
                <div class="liRight">
                    <?php echo Form::select('number',letter(),old('number'),['placeholder'=>'序号',"class"=>'checkNull select2']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">收货人：</div>
                <div class="liRight">
                    <?php echo Form::text('name',old('name'),['placeholder'=>'收货人',"class"=>'checkNull']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">收货人电话：</div>
                <div class="liRight">
                    <?php echo Form::text('phone',old('phone'),['placeholder'=>'收货人电话',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">收货地址：</div>
                <div class="liRight">
                    <?php echo Form::text('address',old('address'),['placeholder'=>'收货地址',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">备用电话：</div>
                <div class="liRight">
                    <?php echo Form::text('alternative_phone',old('alternative_phone'),['placeholder'=>'备用电话',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">指定物流：</div>
                <div class="liRight">
                    <?php echo Form::text('logistics',old('logistics'),['placeholder'=>'指定物流',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">邮编号码：</div>
                <div class="liRight">
                    <?php echo Form::text('zip',old('zip'),['placeholder'=>'邮编号码',"class"=>'']); ?>

                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>
</div>



