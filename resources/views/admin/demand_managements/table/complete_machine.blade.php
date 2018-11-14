{!!  Form::select('product',$product,old('product'),['placeholder'=>'请选择产品','v-model'=>'product_id','@change'=>'getArguments()']) !!}
<select2 :good-list="goodList" ref="Child"></select2>
<input type="hidden"  value="" v-model="good_nums">
<input class="Btn" type="button" @click="add_good()" value="添加">
<div class="clear"></div>
