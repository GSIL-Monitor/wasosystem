<div class="JJList">
    @inject('DemandManagementParamenter','App\Presenters\DemandManagementParamenter')
    <ul class="maxUl editInfo" id="app">
        @if(Route::is('admin.demand_managements.create'))
            {!! Form::open(['route'=>'admin.demand_managements.store','method'=>'post','id'=>'demand_managements','onsubmit'=>'return false']) !!}
            @include('admin.demand_managements.form.create')
        @else
            {!! Form::model($demand_management,['route'=>['admin.demand_managements.update',$demand_management->id],'id'=>'demand_managements','method'=>'put','onsubmit'=>'return false']) !!}
         @include('admin.demand_managements.form.edit')
        @endif

            <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
@if(Route::is('admin.demand_managements.create'))
<script>
    var vm = new Vue({
        el:"#app",
        data:{
            @if(isset($user))
            user_disabled:true,
            @if($user->visitor_details)
            visitor_details_disabled:true,
            @endif
            @endif
        },
        methods: {

        }
    });
</script>
@endif


