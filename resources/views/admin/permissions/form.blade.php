<div class="JJList">
    <ul class="maxUl" >
        @if(Route::is('admin.permissions.create'))
            {!! Form::open(['route'=>'admin.permissions.store','method'=>'post','id'=>'permissions']) !!}
        @else
            {!! Form::model($permission,['route'=>['admin.permissions.update',$permission->id],'id'=>'permissions','method'=>'put']) !!}
        @endif
            <li>
                <div class="liLeft">权限：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入权限,必须是字母',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">权限名：</div>
                <div class="liRight">
                    {!!  Form::text('title',old('title'),['placeholder'=>'请输入权限名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            @if(!$roles->isEmpty())
            <li class="sixLi">
                <div class="liLeft">分配角色：</div>
                <div class="liRight">
                    @php $permission_roles=isset($permission)?$permission->roles:false;@endphp
                    @if(isset($permission))
                        {{ implode(',',$permission_roles->pluck('title')->toArray()) }}
                        @else
                        @foreach ($roles as $role)
                            @if($role->id !==1)
                            <label class="checkBoxLabel" for="{{ $role->id }}">
                                {{ Form::checkbox('roles[]',  $role->id,old('roles[]',$permission_roles),['id'=>$role->id]) }}{{ $role->title }}
                            </label>
                            @endif
                        @endforeach
                        @endif
                </div>
                <div class="clear"></div>
            </li>
            @endif


        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


