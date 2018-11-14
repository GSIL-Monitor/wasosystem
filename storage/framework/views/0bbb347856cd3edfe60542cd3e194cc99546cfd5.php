<script>
    var vm = new Vue({
        el: "#app",
        data: {
            product_id: '',
            good_nums: 1,
            url:"<?php echo e($url); ?>",
            goodList:[],
        },
        methods: {

            getArguments: function () {
                const Notice = this.$Notice;
                axios.post("<?php echo e(route('admin.product_goods.getseries')); ?>", {
                    "_token": getToken(),
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
                if(!this.good_nums){Notice.error({title: "配件数量不能为空"});return false}
                var data={
                    "_token": getToken(),
                    "arr": {
                        "product_good_id": good_id,
                        "product_good_num": this.good_nums,
                    },
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