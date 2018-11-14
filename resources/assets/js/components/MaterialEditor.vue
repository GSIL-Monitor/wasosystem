<template>
    <div class="zyw_material_editor listTable">
        <div class="detail_inner">
            <ul>
                <li v-for="(item,index) in goodList" :class="item.bianhao" v-show="!in_array(item.product_id)">
                    <div class="A_caozuo">
                        <Poptip
                                confirm
                                title="你确定删除这个产品吗?"
                                @on-ok="good_del(index)"
                                ok-text="删除"
                                placement="right"
                                v-if="item.del_button "
                        >
                            <Button class="Btn red"><i class=""></i></Button>
                        </Poptip>
                      <span  v-html="item.html_hidden ? item.html_hidden : ''"></span>
                    </div>
                    <div class="A_type">{{item.title}}</div>
                        <div class="A_easy_name A_name">
                            <b class="old" v-if="in_array(item.product_id)">{{item.name}}</b>
                            <Select v-else  :placeholder="item.name"   clearable filterable transfer  @on-change="v=>{ changeSelect(v,item.product_good_id,item.num,item.product_good_raid,'good',index)}">
                                <Option v-for="(item2,index2) in item.list" :value="index2"
                                        :key="index2" >
                                    {{index2}}----{{item2}}
                                </Option>
                            </Select>
                    </div>
                    <div class="A_price" :data-id="item.product_good_price">{{item.product_good_price}}</div>
                    <div class="A_Total A_prices">{{item.product_good_price}}</div>
                    <div class="A_num num">
                        <div class="A_numbox" :maxNum="item.max_num">
                            <button  @click="item.del_symbol ? good_num_del(index) : ''" :class="[checkGoodNumber(item.num,item.product_id,null,item.cpu_num)]">{{item.del_symbol}}</button>
                            <!--  加  -->
                            <input  type="text" class="PJnum good_num OneNumber" :readonly="item.readonly" style="text-align: center;padding: 0"
                                   v-model="item.num" :product-name="item.title" :product-bianhao="item.bianhao" :good-id="item.product_good_id"
                                   :good-framework="item.framework"
                                   :good-jianma="item.jianma">
                            <button @click="item.add_symbol ? good_num_add(index) : ''" :class="[checkGoodNumber(item.num,item.product_id,item.max_num,null)]">{{item.add_symbol}}</button>  <!--  减  -->
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="A_radius raids">
                        <Select v-if="item.product_id ==15 && (item.num % 2) == 0 && item.num >= 6" :placeholder="item.product_good_raid"     clearable filterable transfer  @on-change="v=>{ changeSelect(v,item.product_good_id,item.num,item.product_good_raid,'raid',index)}">
                            <Option v-for="raid4 in raidLists.raid4" :value="raid4"
                                    :key="raid4" >
                                {{raid4}}
                            </Option>
                        </Select>
                        <Select v-else-if="item.product_id ==15 &&  (item.num % 2) == 0 && item.num >= 4" :placeholder="item.product_good_raid"    clearable filterable transfer  @on-change="v=>{ changeSelect(v,item.product_good_id,item.num,item.product_good_raid,'raid',index)}">
                            <Option v-for="raid3 in raidLists.raid3" :value="raid3"
                                    :key="raid3" >
                                {{raid3}}
                            </Option>
                        </Select>
                        <Select v-else-if="item.product_id ==15 &&  item.num >= 3" :placeholder="item.product_good_raid"    clearable filterable transfer  @on-change="v=>{ changeSelect(v,item.product_good_id,item.num,item.product_good_raid,'raid',index)}">
                            <Option v-for="raid2 in raidLists.raid2" :value="raid2"
                                    :key="raid2" >
                                {{raid2}}
                            </Option>
                        </Select>
                        <Select  v-else-if="item.product_id ==15 &&  item.num == 2" :placeholder="item.product_good_raid"     clearable filterable transfer  @on-change="v=>{ changeSelect(v,item.product_good_id,item.num,item.product_good_raid,'raid',index)}">
                            <Option v-for="raid2 in raidLists.raid2" :value="raid2"
                                    :key="raid2" >
                                {{raid2}}
                            </Option>
                        </Select>
                    </div>
                    <div class="A_detail ">{{ item.parameter }} </div>
                    <div class="clear"></div>
                </li>
                <li v-if="goodList.length <= 0">
                    <div class="empty">没有产品</div>
                </li>

            </ul>
        </div>
        <div class="addPro">
            <select v-model="product_id" @change="getArguments()">
                <option value="">请选择产品</option>
            <option v-for="item in products" :value="item.id" :key="item.id">{{item.title}}</option>
            </select>

            <select2 :good-list="goods" :good-ids="good_id"  ref="Child"></select2>
            <span class="addNumBox">数量：<input type="number" v-model="good_num" class="OneNumber"></span><!-- （添加后可修改） -->
            <span class="addBtnBox"><button class="addPJBtn" @click="add_good()">添加</button></span>
        </div>
    </div>
</template>
<script>
    export default {
        props:['goodLists','raidLists','total_price'],
        data() {
            return {
                product_id: "",
                products: [],
                goodList: [],
                goods: [],
                good_num: 1,
                good_id:'',
                placeholder:'请选择raid',
                totalTime:1,
            }
        },
        methods: {
            total_prices(arr){
                var price=0;
                arr.forEach(function (item,index) {
                    price+=(item.product_good_price * item.num);
                })
                this.$emit('price',price)
            },
            add_or_delete(index){
                var self=this;
                const Notice = this.$Notice;
                axios.post('/completeMachine/add_or_delete', this.goodList[index]).then(function (response) {
                    self.goodList=[];
                    self.goodList=response.data
                    self.goodList[index].product_good_raid='请选择raid'
                    self.total_prices(self.goodList);
                    Notice.success(
                        {
                            title: "修改成功！",
                            duration: self.totalTime,
                            onClose: function () {
                                zheng_JiXingHao_Create();
                                ConfigurationCodeCreate()
                                qrcode();
                            }
                        });
                }).catch(function (error) {
                    swal(error.response.message,'','warning')
                });
            },
            changeSelect (value,good_id,num,raid,type,index) {
                if(type == 'good'){
                    this.goodList[index].product_good_id=value;
                    this.goodList[index].type='edit'
                }
                if(type == 'raid'){
                    this.goodList[index].product_good_raid=value;
                    this.goodList[index].type='edit'
                }
              this.add_or_delete(index)
            },
            in_array:function (val) {
                var testStr=','+[13,20,21,23].join(",")+",";
                return testStr.indexOf(","+val+",")!=-1;
            },
            good_del: function (index) {
                var self=this;
                const Notice = this.$Notice;
                this.goodList[index].type='delete'
                axios.post('/completeMachine/add_or_delete', this.goodList[index]).then(function (response) {
                    self.goodList=[];
                    self.goodList=response.data
                    self.total_prices(self.goodList);
                    Notice.success(
                        {
                        title: "删除成功！",
                        duration: self.totalTime,
                        onClose: function () {
                            zheng_JiXingHao_Create();
                            ConfigurationCodeCreate()
                            qrcode();
                        }
                    });

                }).catch(function (error) {
//                    swal(error.response.data.message,'','warning')
                });

            },
            good_num_del: function (index) {
                if (this.goodList[index].num <= 1) return false;
                if(this.goodList[index].product_id == 14){
                    if(this.goodList[index].num > this.goodList[index].cpu_num){
                        this.goodList[index].num=this.goodList[index].num - this.goodList[index].cpu_num  ;
                    }else{
                        this.goodList[index].num=this.goodList[index].cpu_num;

                    }
                }else{
                    this.goodList[index].num--;
                }
                this.goodList[index].type='edit'
                this.add_or_delete(index);
            },
            good_num_add: function (index) {
                if (this.goodList[index].num === this.goodList[index].max_num) return false;
                if(this.goodList[index].product_id == 14){
                    this.goodList[index].num=this.goodList[index].num + this.goodList[index].cpu_num ;
                }else{
                    this.goodList[index].num++;
                }
                this.goodList[index].type='edit'
                this.add_or_delete(index,'good_num_add');
            },
            getArguments: function () {
                const Notice = this.$Notice;
                var self = this;
                axios.post("/member_center/parts_buy/get_product", {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "parent_id": this.product_id,
                }).then(function (response) {
                    self.goods = response.data;
                })
                    .catch(function (err) {
                        Notice.error({
                            title: err.message
                        });
                    });
            },
            getProduct: function () {
                const Notice = this.$Notice;
                var self = this;
                axios.post("/member_center/parts_buy/get_product", {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                }).then(function (response) {
                    self.products = response.data;
                })
                    .catch(function (err) {
                        Notice.error({
                            title: '网烁错误！'

                        });
                    });
            },
            add_good: function () {
                const Notice = this.$Notice;
                var good_id=this.$refs.Child.good_id;
                if (!good_id) {
                    Notice.error({title: "请选择配件"});
                    return false
                }
                if (!this.good_num) {
                    Notice.error({title: "配件数量不能为空"});
                    return false
                }
                var data = {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "product_good_id": good_id,
                    "num": this.good_num,
                    "type":'add'
                };
                var self=this;
                axios.post('/completeMachine/add_or_delete',data).then(function (response) {
                    self.goodList=[];
                    self.goodList=response.data
                    self.total_prices(self.goodList);
                    Notice.success(
                        {
                            title: "添加成功！",
                            duration: self.totalTime,
                            onClose: function () {
                                zheng_JiXingHao_Create();
                                ConfigurationCodeCreate()
                                qrcode();
                            }
                        });
                }).catch(function (error) {
                    swal(error.response.data.message,'','warning')
                });
//                axios.post(this.url, data).then(function (response) {
//                    Notice.success({
//                        title: response.data.info,
//                        duration: self.totalTime,
//                        onClose: function () {
//                             editMachine();
//                            location.reload();
//                        }
//                    });
//
//                })
//                    .catch(function (err) {
//                        Notice.error({
//                            title: err.response.data.info
//                        });
//                    });

            },
        },
        computed: {
            // 计算属性的 getter
            checkGoodNumber: function () {
                return function (num, product_id, max_num = null,cpu_num=1) {
                    if(product_id == 22){
                        return 'none';
                    }else{
                        if(max_num){
                            return num == max_num ? 'none' : '';
                        }else{
                            if(product_id == 14){
                                return num <= cpu_num ? 'none' : ''
                            }else{
                                return num <= 1 ? 'none' : ''
                            }
                        }
                    }
                }
            },

        },
        mounted() {
            this.getProduct();
            this.in_array();
            this.goodList=this.goodLists;

        }
    }
</script>
