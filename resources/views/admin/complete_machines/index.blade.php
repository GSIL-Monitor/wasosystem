@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create complete_machines')
                    <button class="changeWeb Btn" data_url="{{ route('admin.complete_machines.create') }}?parent_id={{ $parent_id }}">添加{{$parent_parameters[$parent_id]}}</button>
                @endcan
                @can('edit complete_machines')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete complete_machines')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/complete_machines/destory') }}">删除
                    </button>
                @endcan
            </div>
            @include('admin.complete_machines.search',['url'=>route('admin.complete_machines.index')])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>array_only($parent_parameters,[1,2]),'duiBiCanShu'=>$parent_id,'url'=>route('admin.complete_machines.index'),'canshu'=>'parent_id'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="complete_machines">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">产品型号</th>
                    <th class="">单页描述</th>
                    <th class="">架构</th>
                    <th class="">展示 / 推荐</th>
                    <th class="">营销</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                </tr>

                @foreach($complete_machines as $complete_machine)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $complete_machine->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.complete_machines.edit',$complete_machine->id) }}?parent_id={{ $parent_id }}">{{ $complete_machine->name }}</a>
                        </td>
                        <td class="">{{ $complete_machine->additional_arguments['page_description'] }}</td>
                        <td class="">{{ implode(',',array_filter_empty($complete_machine->jiagou)) }}</td>
                        <td class="">
                            <label for="show{{ $complete_machine->id }}">
                                {{ Form::checkbox('edit['.$complete_machine->id.'][status->show]',$complete_machine->status['show'],old('edit['.$complete_machine->id.'][status->show]',$complete_machine->status['show']),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'show'.$complete_machine->id]) }}
                                展示</label>
                            <label for="recommend{{ $complete_machine->id }}">
                                {{ Form::checkbox('edit['.$complete_machine->id.'][status->recommend]',$complete_machine->status['recommend'],old('edit['.$complete_machine->id.'][status->recommend]',$complete_machine->status['recommend']),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'recommend'.$complete_machine->id]) }}
                                推荐</label>
                        <td class="">
                            @foreach(config('status.complete_machine_marketing') as $key=>$status)
                                <label for="marketing{{ $complete_machine->id.$key }}">
                                    @if($key==$complete_machine->marketing)
                                    {{ Form::radio('edit['.$complete_machine->id.'][marketing]',$key,old('edit['.$complete_machine->id.'][marketing]',true),['id'=>'marketing'.$complete_machine->id.$key]) }}
                                   @else
                                        {{ Form::radio('edit['.$complete_machine->id.'][marketing]',$key,old('edit['.$complete_machine->id.'][marketing]',false),['id'=>'marketing'.$complete_machine->id.$key]) }}
                                    @endif
                                    {{ $status }}</label>
                            @endforeach
                        </td>
                        <th class="tableMoreHide">{{ $complete_machine->created_at->format('Y-m-d') }}</th>
                        <td class="">{{ $complete_machine->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
             {{ $complete_machines->links() }}
            </form>

        </div>
    </div>

@endsection