@inject('DemandManagementParamenter','App\Presenters\DemandManagementParamenter')
<div class="JJList">

    <ul class="maxUl editInfo" >
        @if(Route::is('admin.demand_managements.create'))
            {!! Form::open(['route'=>'admin.demand_managements.store','method'=>'post','id'=>'demand_managements','onsubmit'=>'return false']) !!}
            @if(is_mobile())
                @include('admin.demand_managements.form.mobile_create')
            @else
                @include('admin.demand_managements.form.create')
            @endif

        @else
            {!! Form::model($demand_management,['route'=>['admin.demand_managements.update',$demand_management->id],'id'=>'demand_managements','method'=>'put','onsubmit'=>'return false']) !!}
            @if(is_mobile())
                @include('admin.demand_managements.form.mobile_edit')
            @else
                @include('admin.demand_managements.form.edit')
            @endif
        @endif

            <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>



