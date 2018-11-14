<div class="JJList">
    <ul class="maxUl" >
        @if(Route::is('admin.admins.create'))
            {!! Form::open(['route'=>'admin.admins.store','method'=>'post','id'=>'admins']) !!}
        @else
            {!! Form::model($admin,['route'=>['admin.admins.update',$admin->id],'id'=>'admins','method'=>'put']) !!}
        @endif

            <li class="sixLi">
                <div class="liLeft">分配角色：</div>
                <div class="liRight">
                    @php $admin_role=isset($admin)?$admin->roles:false; @endphp
                    @foreach ($roles as $role)
                        <label class="checkBoxLabel" for="{{  $role->id }}">
                        {{ Form::checkbox('roles[]',  $role->id,old('roles[]',$admin_role),['id'=> $role->id]) }}{{ $role->title }}
                        </label>
                    @endforeach
                </div>
                <div class="clear"></div>
            </li>
        <li>
            <div class="liLeft">工号：</div>
            <div class="liRight">
                {!!  Form::text('account',old('account'),['placeholder'=>'请输入工号',"class"=>'checkNull']) !!}
            </div>
            <div class="clear"></div>
        </li>
            <li>
                <div class="liLeft">工号密码：</div>
                <div class="liRight">
                    {!!  Form::password('password',old('password'),['placeholder'=>'请输入工号密码,为空保持原密码',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号姓名：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入工号姓名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号电话：</div>
                <div class="liRight">
                    {!!  Form::text('phone',old('phone'),['placeholder'=>'请输入工号电话',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号邮箱：</div>
                <div class="liRight">
                    {!!  Form::text('email',old('email'),['placeholder'=>'请输入工号邮箱',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">工号QQ：</div>
                <div class="liRight">
                    {!!  Form::text('qq',old('qq'),['placeholder'=>'请输入工号QQ',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


