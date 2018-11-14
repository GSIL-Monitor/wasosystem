<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.inventory_managements.create'))
            {!! Form::open(['route'=>'admin.inventory_managements.store','method'=>'post','id'=>'inventory_managements','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($inventory_management,['route'=>['admin.inventory_managements.update',$inventory_management->id],'id'=>'inventory_managements','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            <li>
                <div class="liLeft">inventory_management：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'inventory_management',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>


