@extends('admin.layout.default')
@section('js')
    <script>
        $(function () {
            @if(isset($productGood) && $productGood->jiagou_id == 279)
                $('select,input').attr('disabled',true);
                $('.demo-upload-list-cover').hide()
            @endif
        });
        var vm = new Vue({
            el: "#app",
            data: {
                is_show: false,
                typed: '',
                xilied: '',
                series_name:'',
                framework_name:'',
                series: [],
                @if(Route::is('admin.product_goods.create'))
                defaultList: [],
                @else
                defaultList:{!! $productGood->pic !!},
                @endif
                actionImageUrl: "{!! env('ActionImageUrl') !!}",
                imageUrl: "{!! env('IMAGES_URL') !!}",
                deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
                fileCount:5,
            },
            methods: {
                getCanshus: function () {
                    this.framework_name=$('.framework_name option:selected').text();
                    const Notice = this.$Notice;
                    axios.post("{{ route('admin.product_goods.getseries') }}", {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "parent_id": this.typed,
                    }).then(function (response) {
                        vm.series = response.data;
                    })
                        .catch(function (err) {
                            Notice.error({
                                title: err.message
                            });
                        });
                },
                series_names: function () {
                    this.series_name=$('.series_name option:selected').text();
                }
            },
            mounted: function () {
                @if(!Route::is('admin.product_goods.create'))
                    this.typed = "{{ $productGood->jiagou_id }}",
                    this.xilied = "{{ $productGood->xilie_id }}",
                    this.series_name="{{ $productGood->series_name }}",
                    this.series = this.getCanshus(),
                    this.framework_name="{{ $productGood->framework_name }}"
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
                @if(isset($productGood) && $productGood->jiagou_id != 279)
                @can('create product_goods')
                    <button type="submit" class="Btn common_add" form_id="product_goods"
                            location="top">@if(Route::is('admin.product_goods.create'))添加@else
                            修改@endif</button>
                @elsecan('edit product_goods')
                    <button type="submit" class="Btn common_add" form_id="product_goods"
                            location="top">@if(Route::is('admin.product_goods.create'))添加@else
                            修改@endif</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.product_goods.form')
        </div>
    </div>

@endsection