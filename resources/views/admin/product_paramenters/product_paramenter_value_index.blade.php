@extends('admin.layout.default')



@section('content')
    @inject('ProductParamenterPresenter','App\Presenters\ProductParamenterPresenter')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create product_paramenters')
                    <button class="OneAdd Btn" data_title="参数值" data_parent_id="{{ $productParamenter->id }}"
                            data_product_id="{{ $productParamenter->product_id }}"
                            data_url="{{ route('admin.product_paramenters.store') }}">添加参数
                    </button>
                @endcan
                @can('edit product_paramenters')
                    <button class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete product_paramenters')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/product_paramenters/destory') }}">删除
                    </button>
                @endcan
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

          <ul class="maxUl">
            <li class="sevenLi">
               <div class="liLeft">专有参数：</div>
               <div class="liRight">
                 @php $ZDCanShus=$ProductParamenterPresenter->showCanShu($productParamenter);@endphp
                     @if(count($ZDCanShus) > 0)
                        @foreach($ZDCanShus as $zdchanshu)
                            <span class="canshuSpan">{{ $zdchanshu }}</span>
                        @endforeach
                     @endif
                 @if(count($product_paramenters) > 0)
               </div>
               <div class="clear"></div>
            </li>

            <li class="nineLi">
               <div class="liLeft">产品参数：</div>
               <div class="liRight">
               <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="table" value="product_paramenters">
                   <table class="listTable">
                       <tr>
                           <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                           <th>排序</th>
                           <th class="tableInfoDel">参数名称</th>
                           <th>添加时间</th>
                           <th class="">修改时间</th>
                       </tr>
                       @foreach($product_paramenters as $product_paramenter)
                           <tr>
                               <td class="tableInfoDel"> <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product_paramenter->id }}"></td>
                               <td><input style="width:60px;" type="text" class="num" name="edit[{{ $product_paramenter->id }}][order]" value="{{ $product_paramenter->order }}"></td>
                               <td class="tableInfoDel  tablePhoneShow  tableName"><input style="width:40%;" type="text" name="edit[{{ $product_paramenter->id }}][name]" value="{{ $product_paramenter->name }}">
                                   <a class="alertWeb"  data_url="{{ route('admin.product_paramenters.edit',$product_paramenter->id) }}">{{ $product_paramenter->name }}</a>
                               </td>
                               <td class="">{{ $product_paramenter->created_at->format('Y-m-d') }}</td>
                               <td class="">{{ $product_paramenter->updated_at->format('Y-m-d') }}</td>
                           </tr>
                       @endforeach
                   </table>
               </form>
               </div>
               <div class="clear"></div>
            </li>
          </ul>
            @endif
        </div>
    </div>

@endsection