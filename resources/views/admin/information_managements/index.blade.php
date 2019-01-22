@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create information_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.information_managements.create') }}?type={{ $type }}">添加{{ config('status.information_managements_type')[$type] }}</button>
                @endcan
                @can('edit information_managements')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete information_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/information_managements/destory') }}">删除
                    </button>
                @endcan
            </div>
            @include('admin.common._search',[
           'url'=>route('admin.information_managements.index'),
           'status'=>array_except(Request::all(),['keyword','_token']),
           ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.information_managements_type'),'duiBiCanShu'=>$type,'url'=>route('admin.information_managements.index'),'canshu'=>'type'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="information_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">名称</th>
                    <th class="">展示</th>
                    <th class="">标签</th>
                    <th  class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>

                </tr>

                @forelse($information_managements as $information_management)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $information_management->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.information_managements.edit',$information_management->id) }}">{{ $information_management->name }}</a>
                        </td>
                        <td class="">
                            <label for="show{{ $information_management->id }}">
                                {{ Form::checkbox('edit['.$information_management->id.'][marketing->show]',$information_management->marketing['show'],old('edit['.$information_management->id.'][marketing->show]',$information_management->marketing['show']),['class'=>'radio','id'=>'show'.$information_management->id]) }}
                                展示</label>
                        </td>
                        <td class="">
                            @foreach(config('status.information_management_marketing') as $key=>$status)
                                <label for="marketing{{ $information_management->id.$key }}">
                                        {{ Form::checkbox('edit['.$information_management->id.'][marketing->'.$key.']',$information_management->marketing[$key],old('edit['.$information_management->id.'][marketing->'.$key.']',$information_management->marketing[$key]),['class'=>'radio','id'=>'marketing'.$information_management->id.$key]) }}
                                    {{ $status }}</label>
                            @endforeach
                        </td>
                        <td class="tableMoreHide">{{ $information_management->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $information_management->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
                {{ $information_managements->links() }}
            </form>

        </div>
    </div>

@endsection