<template>
   <div><Select
           v-model="product_good_id"
           filterable
           remote
           clearable
           :remote-method="remoteMethod"
           :loading="loading">
       <Option v-for="(option, index) in options" :value="option.id" :key="index">{{option.name}}</Option>
   </Select>
       <input type="hidden" name="product_good_id" v-model="product_good_id" class="checkNull">
   </div>
</template>
<script>
    export default {
        props:['url'],
        data () {
            return {
                options:[],
                loading:false,
                product_good_id:''
            }
        },
        methods: {
            remoteMethod (query){
                var self=this;
                if (query !== '') {
                    this.loading = true;
                    axios.post(self.url,{
                        "name":query,"_token":getToken()
                    })
                        .then((response)=>{
                            self.loading = false;
                            self.options = response.data.filter(item => item.name.toLowerCase().indexOf(query.toLowerCase()) > -1);
                        })
                        .catch((err)=>{
                            self.options = [];
                        });
                } else {
                    this.options = [];
                }
            },
        },
        mounted() {
         console.log(this.url)

        },
    }
</script>
