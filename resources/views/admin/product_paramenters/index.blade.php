@extends('admin.layout.default')
@section('content')
    @inject('ProductParamenterPresenter','App\Presenters\ProductParamenterPresenter')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create product_paramenters')
                    <button class="alertWeb Btn" data_url="{{ route('admin.product_paramenters.create') }}?product_id={{ $product_id }}">添加参数</button>
                @endcan
                @can('edit product_paramenters')
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete product_paramenters')

                    <button  class="red Btn AllDel"
                            data_url="{{ url('/waso/product_paramenters/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_paramenters.index'),'canshu'=>'product_id'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="product_paramenters">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th>排序</th>
                    <th class="tableInfoDel">参数名称</th>
                    <th class="">参数单位</th>
                    <th class="">前台/后台（显示）</th>
                    <th class="">参数值</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="tableInfoDel">操作</th>
                </tr>
                @foreach($product_paramenters as $product_paramenter)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product_paramenter->id }}">
                        </td>
                        <td><input type="text" style="width:60px;" name="edit[{{ $product_paramenter->id }}][order]" value="{{ $product_paramenter->order }}"></td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><input type="text" name="edit[{{ $product_paramenter->id }}][name]"
                                                                                   value="{{ $product_paramenter->name }}">
                            <a class="alertWeb" data_url="{{ route('admin.product_paramenters.edit',$product_paramenter->id) }}">{{ $product_paramenter->name }}</a>
                        </td>
                        <td><input type="text"  name="edit[{{ $product_paramenter->id }}][danwei]"
                                   value="{{ $product_paramenter->danwei }}"></td>
                        <td class="">
                            <label for="qiantai_show{{ $product_paramenter->id }}">{{ Form::checkbox('edit['.$product_paramenter->id.'][qiantai_show]',$product_paramenter->qiantai_show,old('edit['.$product_paramenter->id.'][qiantai_show]',$product_paramenter->qiantai_show),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'qiantai_show'.$product_paramenter->id]) }}前台显示</label>/
                            <label for="admin_show{{ $product_paramenter->id }}">{{ Form::checkbox('edit['.$product_paramenter->id.'][admin_show]',$product_paramenter->admin_show,old('edit['.$product_paramenter->id.'][admin_show]',$product_paramenter->admin_show),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'admin_show'.$product_paramenter->id]) }}后台显示</label>
                        </td>
                        <td>
                            {{ config('status.procuctParamentselectShow')[$product_paramenter->type] }}
                            @php $ZDCanShu=$ProductParamenterPresenter->showCanShu($product_paramenter);@endphp
                            @if(count($ZDCanShu) > 0)
                                {{--{{ $ProductParamenterPresenter->showCanShuName($product_paramenter,$products)  }}--}}
                                {{ Form::select('',$ZDCanShu,null,['class'=>'select2']) }}
                            @endif
                        </td>
                        <td class="tableMoreHide">{{ $product_paramenter->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $product_paramenter->updated_at->format('Y-m-d') }}</td>
                        <td><a class="alertWeb" data_url="{{ route('admin.product_paramenters.show',$product_paramenter->id) }}">添加参数值</a></td>
                    </tr>
                @endforeach
            </table>
            </form>
        </div>
    </div>

@endsection