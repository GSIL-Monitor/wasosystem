@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create menus')
                <button class="alertWeb Btn" data_url="{{ route('admin.menus.create') }}?parent_id=0">添加菜单</button>
                @endcan
                @can('edit menus')
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete menus')
                <button  type="submit" class="red Btn AllDel" form="AllDel" data_url="{{ url('/waso/menus/destory') }}">删除</button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
            <div class="clear"></div>
        </div>

        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.menus_cats'),'duiBiCanShu'=>$cat,'url'=>route('admin.menus.index'),'canshu'=>'cat'])
            @if(count($menus) > 0)
           <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
            <table class="listTable" id="sort">
                <thead>
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th>栏目</th>
                    <th>排序</th>
                    <th class="tableInfoDel">菜单名称</th>
                    <th class="">菜单简称</th>
                    <th class="">菜单链接</th>
                    <th>添加时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="table" value="menus">
                @foreach($menus as $menu)
                    <tr>
                        <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $menu->id }}"></td>
                        <td>{{ config('status.menus_cats')[$menu->cats] }}</td>
                        <td><input type="text" value="{{ $menu->order }}" name="edit[{{ $menu->id }}][order]"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb" data_url="{{ route('admin.menus.edit',$menu->id) }}">{{  $menu->name }}</a></td>
                        <td>{{ $menu->sulg }}</td>
                        <td>{{ $menu->url }}</td>
                        <td>{{ $menu->created_at->format('Y-m-d') }}</td>
                        <td>{{ $menu->updated_at->format('Y-m-d') }}</td>
                        <td><a data_url="{{ route('admin.menus.create') }}?parent_id={{ $menu->id }}&cats={{ $menu->cats }}" class="alertWeb">添加下级</a></td>
                    </tr>
                     @php $childMenus=$menu->childMenus;@endphp
                      @if(count($childMenus) >0)
                        @foreach($childMenus as $childMenu)
                            <tr>
                                <td class="tableInfoDel"><input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $childMenu->id }}"></td>
                                <td>{{ config('status.menus_cats')[$childMenu->cats] }}</td>
                                <td><input type="text" value="{{ $childMenu->order }}" name="edit[{{ $childMenu->id }}][order]"></td>
                                <td class="tableInfoDel  tablePhoneShow  tableName">&nbsp;&nbsp;&nbsp;<a class="alertWeb" data_url="{{ route('admin.menus.edit',$childMenu->id) }}">{{  $childMenu->name }}</a></td>
                                <td>{{ $childMenu->sulg }}</td>
                                <td>{{ $childMenu->url }}</td>
                                <td>{{ $childMenu->created_at->format('Y-m-d') }}</td>
                                <td>{{ $childMenu->updated_at->format('Y-m-d') }}</td>
                                <td>--</td>
                            </tr>
                        @endforeach
                        @endif
                @endforeach

                </tbody>
            </table>
           </form>
            {{ $menus->links() }}
                @else
                <div class="empty">没有数据</div>
            @endif
        </div>
    </div>
@endsection