@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('edit inventory_managements')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
            </div>
            @include('admin.common._search',[
          'url'=>route('admin.inventory_managements.index'),
          'status'=>array_except(Request::all(),['keyword','_token'])
          ])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.inventory_managements.index'),'canshu'=>'product_id'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="inventory_managements">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel">产品规格</th>
                    <th class="">库存数量</th>
                    <th class="">良品</th>
                    <th class="">坏货</th>
                    <th class="">返厂在途</th>
                    <th class="">代管</th>
                    <th class="">测试品</th>
                    <th class="">库存报警</th>
                </tr>

                @forelse($inventory_managements as $inventory_management)
                    <tr>

                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            {{ $inventory_management->product_good->name }}
                        </td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][new]" value="{{ $inventory_management->new }}"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][good]" value="{{ $inventory_management->good }}"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][bad]" value="{{ $inventory_management->bad }}"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][return_factory]" value="{{ $inventory_management->return_factory }}"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][proxies]" value="{{ $inventory_management->proxies }}"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][test]" value="{{ $inventory_management->test }}"></td>
                        <td class=""><input type="number" style="width: 100px;" class="" name="edit[{{ $inventory_management->id }}][warning]" value="{{ $inventory_management->warning }}"></td>
                    </tr>
                    @empty
                     <tr><td><div class='error'>没有数据</div></td></tr>
                @endforelse
            </table>
             {{ $inventory_managements->links() }}
            </form>

        </div>
    </div>

@endsection