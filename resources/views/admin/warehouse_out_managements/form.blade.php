<div class="JJList">
    <ul class="halfTwoUl" >
        @if(Route::is('admin.warehouse_out_managements.create'))
            {!! Form::open(['route'=>'admin.warehouse_out_managements.store','method'=>'post','id'=>'warehouse_out_managements','onsubmit'=>'return false']) !!}
            @include('admin.warehouse_out_managements.form.create')
        @else
            {!! Form::model($warehouse_out_management,['route'=>['admin.warehouse_out_managements.update',$warehouse_out_management->id],'id'=>'warehouse_out_managements','method'=>'put','onsubmit'=>'return false']) !!}
            @include('admin.warehouse_out_managements.form.edit')
        @endif
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>



