<div class="JJList">
    <ul class="maxUl" id="app">
        @if(Route::is('admin.divisional_managements.create'))
            {!! Form::open(['route'=>'admin.divisional_managements.store','method'=>'post','id'=>'divisional_managements','onsubmit'=>'return false']) !!}
            <li>
                <div class="liLeft">所属部门：</div>
                <div class="liRight">
                    {!!  Form::hidden('parent_id',old('parent_id',$parent->id)) !!}
                    {!!  Form::text(null,$parent->name,['placeholder'=>'名称',"disabled"=>'']) !!}
                </div>
                <div class="clear"></div>
            </li>
        @else
            {!! Form::model($divisional_management,['route'=>['admin.divisional_managements.update',$divisional_management->id],'id'=>'divisional_managements','method'=>'put','onsubmit'=>'return false']) !!}
        @endif

            <transition name="fade">
            <li v-if="picked !== 'member'">
                <div class="liLeft">名称：</div>
                <div class="liRight">
                    {!!  Form::text('name',old('name'),['placeholder'=>'名称',"class"=>'checkNull']) !!}
                </div>
                <div class="clear"></div>
            </li>
            </transition>
            @if(Route::is('admin.divisional_managements.create'))
            <transition name="fade">
                <li>
                    <div class="liLeft">部门类型：</div>
                    <div class="liRight" >
                        <label for="one"><input type="radio" class='checkNull' id="one" name="identifying"  value="company" v-model="picked">公司</label>
                        <label for="three"><input type="radio" class='checkNull' id="three" name="identifying" value="department" v-model="picked">部门</label>
                        <label for="four"><input type="radio" class='checkNull' id="four" name="identifying" value="group" v-model="picked">分组</label>
                        <label for="two"><input type="radio" class='checkNull' id="two" name="identifying" value="member"  v-model="picked">成员</label>
                    </div>
                    <div class="clear"></div>
                </li>
            </transition>
            <transition name="fade">
                <li v-if="picked === 'member'">
                    <div class="liLeft">成员：</div>
                    <div class="liRight" >
                        @foreach($admins as $key=>$item)
                            <label for="four{{ $key }}">
                                {!!  Form::checkBox('admins[]',$key,old('admins[]'),['id'=>'four'.$key]) !!}
                                {{ $item }}</label>
                         @endforeach
                    </div>
                    <div class="clear"></div>
                </li>
            </transition>
            @endif
        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
<script>
    var vm = new Vue({
        el:"#app",
        data:{
            typed:'',
            @if(Route::is('admin.divisional_managements.create'))
            @if($parent->identifying =='company')
                 picked: 'department',
            @elseif($parent->identifying =='department')
                 picked: 'group',
           @elseif($parent->identifying =='group')
                 picked: 'member',
            @else
                picked: 'member',
            @endif
            @endif
        },
        methods: {

        }
    });
</script>


