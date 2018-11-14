<script>
    var vm = new Vue({
        el: "#app",
        data: {
            product_id: '',
            good_nums: 1,
            url:"{{ $url }}",
            goodList:[],
        },
        methods: {
            getArguments: function () {
                const Notice = this.$Notice;
                axios.post("{{ route('admin.demand_managements.get_complete_machine') }}", {
                    "_token": getToken(),
                    "parent_id": this.product_id,
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
                var complete_machine_id=this.$refs.Child.good_id;
                if(!complete_machine_id){Notice.error({title: "请选择整机"});return false}
                if(!this.good_nums){Notice.error({title: "整机数量不能为空"});return false}
                var data={
                    "_token": getToken(),
                    "complete_machine_id":complete_machine_id,
                    "type":'complete_machine',
                    'status':'添加'
                };
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