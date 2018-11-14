<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.supplier_repair_addresses.create'))
            {!! Form::open(['route'=>'admin.supplier_repair_addresses.store','method'=>'post','id'=>'supplier_repair_addresses','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($supplier_repair_address,['route'=>['admin.supplier_repair_addresses.update',$supplier_repair_address->id],'id'=>'supplier_repair_addresses','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">售后人员：</div>
                <div class="liRight">
                    {!!  Form::hidden('supplier_managements_id',old('supplier_managements_id',$supplier_repair_address->supplier_managements_id ?? Request::get('supplier_managements_id')),['placeholder'=>'售后人员',"class"=>'checkNull']) !!}
                    {!!  Form::text('name',old('name'),['placeholder'=>'售后人员',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">联系电话：</div>
                <div class="liRight">
                    {!!  Form::text('phone',old('phone'),['placeholder'=>'联系电话',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">联系邮箱：</div>
                <div class="liRight">
                    {!!  Form::text('email',old('email'),['placeholder'=>'联系邮箱',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">质保地址：</div>
                <div class="liRight">
                    {!!  Form::text('address',old('address'),['placeholder'=>'质保地址',"class"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">操作人员：</div>
                <div class="liRight">
                    {!!  Form::hidden('admin',old('address',$supplier_repair_address->admins->id ?? auth('admin')->user()->id),['placeholder'=>'联系电话',"class"=>'']) !!}
                    {!!  Form::text(null,$supplier_repair_address->admins->name ?? auth('admin')->user()->name,['readonly']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


