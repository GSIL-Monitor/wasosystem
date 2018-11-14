<div class="JJList">
    <ul class="maxUl"  id="app">
        @if(Route::is('admin.roles.create'))
            {!! Form::open(['route'=>'admin.roles.store','method'=>'post','id'=>'roles']) !!}
        @else
            {!! Form::model($role,['route'=>['admin.roles.update',$role->id],'id'=>'roles','method'=>'put']) !!}
        @endif
            <li>
                <div class="liLeft">角色：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'请输入角色,必须是字母',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="liLeft">角色名：</div>
                <div class="liRight">
                    {!!  Form::text('title',old('title'),['placeholder'=>'请输入角色名',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            <li class="sixLi">
                <div class="liLeft">权限 <input type="checkbox" class="checkBoxAll">：</div>
                <div class="liRight">
                    @php $permiss=isset($role)?$role->permissions:false; @endphp
                    @foreach ($permissions  as $permission)
                        <label class="checkBoxLabel" for="{{ $permission->id }}">
                        {{ Form::checkbox('permissions[]',$permission->id,$permiss,['id'=>$permission->id,'class'=>'checkBox']) }}{{ $permission->title }}
                        </label>
                    @endforeach
                </div>
                <div class="clear"></div>
            </li>
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
<script>
  $(function () {
        checkBox();
    });
</script>


