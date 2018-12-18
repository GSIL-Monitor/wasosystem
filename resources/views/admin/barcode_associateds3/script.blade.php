<script>
    new Vue({
        el: "#main",
        data:{
            {{--options:{!! $users !!},--}}
            options:[],
            orders_for_the_transfer_id:'',
            loading:false
        },
        methods: {
            orders_for_the_transfer() {
                var self=this;
                this.$Modal.confirm({
                    title: '请选择要订单过户的会员',
                    key: 'option',
                    align: 'center',
                    onOk: () => {
                        axios.post("{{ route('admin.orders.orders_for_the_transfer',$order->id) }}",{
                            "_token":getToken(),
                            'user_id': this.orders_for_the_transfer_id
                        }).then((response)=>{
                            toastrMessage('success', response.data.info, 'top')
                        }).catch((err)=>{
                            toastrMessage('error', '订单过户失败', 'static')
                        });
                    },
                    render: (h, params) => {
                        return h('Select', {
                                props:{
                                    loading:this.loading,
                                    filterable:true,
                                    transfer:true,
                                    clearable:true,
                                    remote:true,
                                    loadingText:'正在加载中..',
                                    remoteMethod:(query)=>{
                                        var self=this;
                                        if (query !== '') {
                                            this.loading = true;
                                            axios.get("{{ route('admin.orders.search') }}?username="+query)
                                                .then((response)=>{
                                                    self.loading = false;
                                                    self.options = response.data.filter(item => item.username.toLowerCase().indexOf(query.toLowerCase()) > -1);
                                                })
                                                .catch((err)=>{
                                                    self.options = [];
                                                });
                                        } else {
                                            this.options = [];
                                        }
                                    }
                                },
                                style:{
                                    border:'2px solid #eeeeee',
                                    margin:'0 0 5px 0'
                                },
                                on: {
                                    'on-change':(event) => {
                                        this.orders_for_the_transfer_id=event;
                                    }
                                },
                            },
                            this.options.map(function (item,index) {
                                return h('Option', {
                                    props: { value: item.id}
                                }, item.username);
                            })
                        );
                    },
                })
            },
        }
    });
</script>