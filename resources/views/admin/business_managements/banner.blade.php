@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create business_managements')
                    <button class="changeWeb Btn" data_url="{{ route('admin.business_managements.create') }}?type=banner">添加</button>
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
                    <th class="">排序</th>
                    <th class="tableInfoDel">大字</th>
                    <th class="tableMoreHide">小字</th>
                    <th class="">背景色</th>
                    <th class="">链接</th>
                    <th class="tableMoreHide">对齐方向</th>
                    <th class="tableMoreHide">手机端变色</th>
                    <th class="">PC端图片</th>
                    <th class="">手机端图片</th>
                    <th class="">展示更多</th>
                    <th  class="tableMoreHide">修改时间</th>
                    <th class="">发布时间</th>
                </tr>

                @forelse($banners as $banner)
                    @php $pics=json_decode($banner->pic,true);@endphp
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $banner->id }}">
                        </td>
                        
                        <td><input  type="text" name="edit[{{ $banner->id }}][sort]" value="{{ $banner->sort }}" style="width:40px;"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                               data_url="{{ route('admin.business_managements.edit',$banner->id) }}?type=banner">{{ $banner->field['max_font'] }}</a>
                        </td>
                        <td class="tableMoreHide">{{ config('status.banner_font_float')[$banner->field['font_float']] }}</td>
                        <td class="tableMoreHide">{{ config('status.banner_font_color')[$banner->field['font_color']] }}</td>

                        <td>{{ $banner->field['color'] }}</td>
                        <td>{{ $banner->field['url'] }}</td>

                        <td class="tableMoreHide">{{ $banner->field['min_font'] }}</td>
                        <td><img src="{{ $pics[0]['url'] ?? '' }}" alt="" style="height: 100px;"></td>
                        <td><img src="{{ $pics[1]['url'] ?? ''}}" alt="" style="height: 100px;"></td>
                       <td> {!! Form::checkbox("edit[{$banner->id}][field->more]",$banner->field['more'],old("edit[{$banner->id}][field->more]",$banner->field['more']),['class'=>'radio']) !!}</td>
                        <td class="tableMoreHide">{{ $banner->updated_at->format('Y-m-d') }}</td>
                        <td class="">{{ $banner->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
            </form>
             {{ $banners->links() }}
        </div>
    </div>

@endsection