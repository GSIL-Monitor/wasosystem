<script>
    var vm = new Vue({
        el: "#app",
        data: {
            product_id: '',
            good_num: 1,
            <?php if($type == 'create'): ?>
            url:"<?php echo e(route('parts_buy.store')); ?>",
            <?php else: ?>
            url:"<?php echo e(route('parts_buy.store')); ?>",
            <?php endif; ?>
            goodList:[],
        },
        methods: {
            getArguments: function () {
                const Notice = this.$Notice;
                axios.post("<?php echo e(route('parts_buy.get_product')); ?>", {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
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
                var good_id=this.$refs.child.good_id;
                if(!good_id){Notice.error({title: "请选择配件"});return false}
                if(!this.good_num){Notice.error({title: "配件数量不能为空"});return false}
                var data={
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "product_good_id": good_id,
                    "product_good_num": this.good_num,
                };
                <?php if($type == 'edit' ): ?>
                    data['_method']='PUT';
                <?php endif; ?>
                axios.post(this.url, data).then(function (response) {
                    Notice.success({
                        title: response.data.info,
                        duration:1,
                        onClose:function () {
                       location.reload();
                        }
                    });

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