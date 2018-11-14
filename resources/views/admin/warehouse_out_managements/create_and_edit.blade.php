@extends('admin.layout.default')


@section('js')
    <script>
        function cteate_codes() {
            var arr={};
            var codes=[];
            $(".listTable tr td input").each(function () {
                var id=$(this).attr('data-id');
                var code=$(this).val();
                var number=$(this).attr('data-number');
                var num=$(this).attr('data-num');
                if(arr[id] == undefined){
                    arr[id]={};
                    arr[id]['product_good_id']=id;
                    arr[id]['product_good_number']=number;
                    arr[id]['product_good_num']=num;
                    arr[id]['code']=[code];
                    codes[id]=[code]

                }else{
                   arr[id]['code'].push(code)
                   codes[id].push(code)
                }

            })
//            console.log(JSON.stringify(arr));
            $('.codes').val(JSON.stringify(arr));
            return codes;
        }
        var vm=new Vue({
            el:"#warehouse_out_managements",
            data:{
                code: '',
                @if(Route::is('admin.warehouse_out_managements.create'))
                out_storage_storage_counts:{!! !empty($out_order) ? $out_order->order_product_goods->sum('pivot.product_good_num') : 0 !!},
                out_storage_count:0,
                codes: {},
                @else
                out_storage_storage_counts:{!! $warehouse_out_management->out_number ?? 0 !!},
                out_storage_count:{!! $warehouse_out_management->finish_out_number !!},
                codes: {},
                @endif
                disabled:false,
            },
            methods: {
                del: function (id,index) {
                  console.log(id,index,this.codes[id]);

                    if($('.good_'+id).eq(index).hasClass('good')){
                        this.codes[id].splice(index, 1)
                        $('.good_'+id).eq(index).removeClass('good').val('');
                        this.out_storage_count--;
                        cteate_codes();
                        this.disabled = false;
                    }
                    console.log(this.codes[id]);
                },
                in_array: function (code) {
                    var codes="";
                    for(var item in this.codes){
                        codes += ',' + this.codes[item].join(',') + ',';
                    };

                    return codes.indexOf("," + code + ",") != -1;
                },
                entering: function () {
                    if (!this.in_array(this.code)) {
                        this.checkCode(this.code);
                    } else {
                        showError($('.out_storage'), '录入条码已存在')
                        this.code = '';
                    }
                },
                checkCode: function (code) {
                    axios.post("{{ route('admin.warehouse_out_managements.checkCode') }}", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        var good_id=response.data.codes.product_good_id;
                      if(good_id){
                          $('.good_'+good_id).not('.good').eq(0).addClass('good').val(code);

                          if(vm.codes.length == 0 || vm.codes[good_id] == undefined){
                              vm.codes[good_id]=[code]
                          }else{
                              vm.codes[good_id].push(code);
                          }
                          vm.out_storage_count++;
                          cteate_codes();
                          vm.code = '';
                          hideError($('.out_storage'))
                          if (vm.out_storage_count == vm.out_storage_storage_counts) {
                              vm.disabled = true;
                          }
                      }else{
                          showError($('.out_storage'), '没有这个条码')
                      }
                    }).catch(function (err) {

                    });
                },
                checkNumber:function () {
                    if(this.out_storage_count > this.out_storage_storage_counts){
                        showError($('.out_storage'), '出库数量不能大于总条码数量')
                    }else{
                        hideError($('.out_storage'))
                        this.disabled = false;
                    }
                }
            },
            mounted: function () {
                $('.out_storage').focus();
                @if(!Route::is('admin.warehouse_out_managements.create'))
                this.codes=cteate_codes();
                @endif
                @if(!Route::is('admin.warehouse_out_managements.create') && $warehouse_out_management->out_status == 'finish')
                    this.disabled = true;
                $('.listTable').find('button').hide()
                    $('.common_add').hide()
                @endif
            },
        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.warehouse_out_managements.create'))
                @can('create warehouse_out_managements')
                    <button type="submit" class="Btn common_add" form_id="warehouse_out_managements"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit warehouse_out_managements')
                    <button type="submit" class="Btn common_add" form_id="warehouse_out_managements"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.warehouse_out_managements.form')
        </div>
    </div>
@endsection