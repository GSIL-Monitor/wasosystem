<script>
    var vm = new Vue({
        el: "#app",
        data: {
            showCodeMsg:'显示二维码',
            showCode:false,
            product_id: '',
            good_num: 1,
            @if(!Route::is('admin.'.$model.'.create'))
            url:"{{ route('admin.'.$model.'.update',$id) }}",
            @else
            url:"{{ route('admin.'.$model.'.store') }}",
            @endif
            goodList:[],
        },
        methods: {
            show:function () {
                this.showCode=this.showCode== true? false:true;
            },
            getArguments: function () {
                const Notice = this.$Notice;
                axios.post("{{ route('admin.product_goods.getseries') }}", {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "parent_id": this.product_id,
                    "get_good": this.product_id,
                }).then(function (response) {
                    vm.goodList = response.data;
                })
                    .catch(function (err) {
                        Notice.error({
                            title: err.message
                        });
                    });
            },
            add_good:function () {
                const Notice = this.$Notice;
                var good_id=this.$refs.Child.good_id;
                if(!good_id){Notice.error({title: "请选择配件"});return false}
                if(!this.good_num){Notice.error({title: "配件数量不能为空"});return false}
                var data={
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "product_good_id": good_id,
                    "product_good_num": this.good_num,
                };
                @if(!Route::is('admin.'.$model.'.create'))
                    data['_method']='PUT';
                @endif
                axios.post(this.url, data).then(function (response) {
                    toastrMessage('success',response.data.info)
                })
                    .catch(function (err) {
                        Notice.error({
                            title: err.response.data.info
                        });
                    });
            }
        },
        mounted: function () {
        },
    });

</script>