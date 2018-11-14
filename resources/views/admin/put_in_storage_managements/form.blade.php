
<div class="JJList">
    <div  id="app">
        @if(Route::is('admin.put_in_storage_managements.create'))
            {!! Form::open(['route'=>'admin.put_in_storage_managements.store','method'=>'post','id'=>'put_in_storage_managements','onsubmit'=>'return false']) !!}
        @include('admin.put_in_storage_managements.form.edit')
        @else
            {!! Form::model($put_in_storage_management,['route'=>['admin.put_in_storage_managements.update',$put_in_storage_management->id],'id'=>'put_in_storage_managements','method'=>'put','onsubmit'=>'return false']) !!}
           @include('admin.put_in_storage_managements.form.edit')
        @endif
        {!! Form::close() !!}
        </ul>
    </div>






