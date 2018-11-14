@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create business_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.business_managements.create') }}?type=job">添加</button>
                @endcan
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
                    <th class="tableInfoDel">职位名称</th>
                    <th class="">职位类别</th>
                    <th class="">薪资待遇</th>
                    <th class="">工作地点</th>
                    <th class="">招聘人数</th>
                    <th>过期</th>
                    <th  class="tableMoreHide">修改时间</th>
                    <th class="">发布时间</th>

                </tr>

                @forelse($jobs as $job)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $job->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.business_managements.edit',$job->id) }}?type=job">{{ $job->field['position'] }}</a>
                        </td>
                        <td class="">{{ $job->field['position_type'] }}</td>
                        <td class="">{{ $job->field['salary'] }}</td>
                        <td class="">{{ $job->field['workplace'] }}</td>
                        <td class="">{{ $job->field['recruiting_numbers'] }}</td>
                        <td class="">
                            <label for="show{{ $job->id }}">
                                {{ Form::checkbox('edit['.$job->id.'][field->over]',$job->field['over'],old('edit['.$job->id.'][field->over]',$job->field['over']),['class'=>'radio','id'=>'show'.$job->id]) }}
                                过期</label>
                        </td>
                        <td class="tableMoreHide">{{ $job->updated_at->format('Y-m-d') }}</td>
                        <td class="">{{ $job->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $jobs->links() }}
        </div>
    </div>

@endsection