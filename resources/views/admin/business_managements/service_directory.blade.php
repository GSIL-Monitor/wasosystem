@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create business_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.business_managements.create') }}?type=service_directory">添加</button>
                @endcan
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @can('delete business_managements')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/business_managements/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="business_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="">分类</th>
                    <th class="tableInfoDel">名称</th>
                    <th  class="tableMoreHide">修改时间</th>
                    <th class="">发布时间</th>
                    <th class="">展示</th>

                </tr>

                @forelse($service_directorys as $service_directory)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $service_directory->id }}">
                        </td>
                        <td class="">{{ config('status.service_directory_type')[$service_directory->field['type']] }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.business_managements.edit',$service_directory->id) }}?type=service_directory">{{ $service_directory->field['name'] }}</a>
                        </td>


                        <td class="tableMoreHide">{{ $service_directory->updated_at->format('Y-m-d') }}</td>
                        <td class="">{{ $service_directory->created_at->format('Y-m-d') }}</td>
                        <td class="">
                            {!! Form::checkbox("edit[{$service_directory->id}][top]",$service_directory->top,old("edit[{$service_directory->id}][top]",$service_directory->top),['class'=>'radio']) !!}
                        </td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $service_directorys->links() }}
        </div>
    </div>

@endsection