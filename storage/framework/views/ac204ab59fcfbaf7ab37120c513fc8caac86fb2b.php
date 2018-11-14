<div class="JJList">
    <ul class="maxUl" id="app">
        <?php if(Route::is('admin.product_paramenters.create')): ?>
            <?php echo Form::open(['route'=>'admin.product_paramenters.store','method'=>'post','id'=>'product_paramenters']); ?>

            <?php echo Form::hidden('product_id',old('product_id',Request::get('product_id')),['placeholder'=>'请输入专有项名称']); ?>

        <?php else: ?>
            <?php echo Form::model($productParamenter,['route'=>['admin.product_paramenters.update',$productParamenter->id],'id'=>'product_paramenters','method'=>'put']); ?>

        <?php endif; ?>
        <li>
            <div class="liLeft">专有项名称：</div>
            <div class="liRight">
                <?php echo Form::text('name',old('name'),['placeholder'=>'请输入专有项名称','class'=>'checkNull']); ?>

            </div>
            <div class="clear"></div>
        </li>
            <li>
            <div class="liLeft">专有项单位：</div>
            <div class="liRight">
                <?php echo Form::text('danwei',old('danwei'),['placeholder'=>'请输入专有项单位']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">前/后显示：</div>
            <div class="liRight">
                <label class="checkBoxLabel" for="qiantai_show"><?php echo e(Form::checkbox('qiantai_show',0,old('qiantai_show'),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'qiantai_show'])); ?>前台显示</label>
                <label class="checkBoxLabel" for="admin_show"><?php echo e(Form::checkbox('admin_show',0,old('admin_show'),['onclick'=>'this.value=(this.value==0)?1:0','id'=>'admin_show'])); ?>后台显示</label>
            </div>
            <div class="clear"></div>
        </li>
        <li>
            <div class="liLeft">显示类型：</div>
            <div class="liRight" >
                <?php echo Form::select('type', config('status.procuctParamentselectShow'), old('type'),['placeholder'=>'请先择显示类型','v-model'=>'typed','class'=>'checkNull']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <transition name="fade">
            <li class="halfLi" v-if="typed === 'select' || typed === 'checkbox'">
                <div class="liLeft">产品类型：</div>
                <div class="liRight" >
                    <?php echo Form::select('parameter_pid', $products, old('parameter_pid'),['placeholder'=>'请先择产品类型','class'=>'checkNull','v-model'=>'producted','@change'=>'getCanshus()']); ?>

                    <label class="radioLabel" for="one"><input type="radio" id="one" name="show_type"  value="framework" v-model="picked">产品架构</label>
                    <label class="radioLabel" for="three"><input type="radio" id="three" name="show_type" value="series" v-model="picked">产品系列</label>
                    <label class="radioLabel" for="four"><input type="radio" id="four" name="show_type" value="goods" v-model="picked">产品配件</label>
                    <label class="radioLabel" for="two"><input type="radio" id="two" name="show_type" value="paramenters"  v-model="picked"  @click="getCanshus()">产品专有项</label>
                </div>
                <div class="clear"></div>
            </li>
        </transition>
        <li v-if="picked === 'framework' || picked === 'goods'">
            <input type="hidden" name="parameter_id" v-model="producted" >
        </li>
        <li v-if="picked === 'series'">
            <input type="hidden" name="parameter_id" v-model="producted" >
        </li>
        <transition name="fade">
            <li v-if="picked === 'paramenters'">
                <div class="liLeft">产品专有项：</div>
                <div class="liRight" >
                    <select v-model="paramentered" name="parameter_id"  class=" checkNull">
                        <option value="">请先择产品专有项</option>
                        <option v-for="(item,index) in paramenters"  :value="item.id">{{ item.name }}</option>
                    </select>

                </div>
                <div class="clear"></div>
            </li>
        </transition>
        <li>
            <div class="liLeft">专有项排序：</div>
            <div class="liRight" >
                <?php echo Form::text('order',old('order'),['placeholder'=>'请输入专有项排序']); ?>

            </div>
            <div class="clear"></div>
        </li>
        <div class="clear"></div>
        <?php echo Form::close(); ?>

    </ul>

</div>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
<script>
    var vm = new Vue({
        el:"#app",
        <?php if(Route::is('admin.product_paramenters.create')): ?>
        data:{
            typed:'',
            producted:'',
            picked: '',
            paramentered:'',
            paramenters:[{id:'',name:"请先择产品专有项"}]
        },
        <?php else: ?>
        data:{
            typed:'<?php echo e($productParamenter->type); ?>',
            producted:'<?php echo e($productParamenter->parameter_pid); ?>',
            picked: '<?php echo e($productParamenter->show_type); ?>',
            paramentered:'<?php echo e($productParamenter->parameter_id); ?>',
            paramenters:<?php echo json_encode($product_paramenter_childs, 15, 512) ?>,
        },
        <?php endif; ?>
        methods:{
            getCanshus:function () {
                const Notice =  this.$Notice;
                if(this.producted)
                axios.post("<?php echo e(route('admin.get_paramenters')); ?>",{
                    "_token":$('meta[name="csrf-token"]').attr('content'),
                    "product_id":this.producted,
                }).then(function(response) {
                    vm.paramenters=response.data
                })
                    .catch(function(err) {
                        Notice.error({
                            title:err.message
                        });
                    });
            }
        }
    });
</script>
