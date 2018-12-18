var vm=new Vue({
    el:"#app",
    data:{
        condition_more:false,
        selected :[],

    },
    methods:{
        page:function(url){
            console.log(url);
        },
        condition_m:function () {

            this.condition_more=this.condition_more ? false :true;
        },
        add_selected_filter:function (type,value) {

             var addJson={};
             var self=this;
             addJson[type]=value;
             this.selected.push(addJson);
             $('.'+type).hide()
             axios.post(url,{
                   "_token":getToken(),
                   "filter":this.selected
                 }).then(function (response) {
                $('.server').html(response.data)
                 $(".type_box li:nth-child(4n)").addClass("lastLi");
                 $("img.lazy").lazyload({effect: "fadeIn"});
             }).catch(function (err) {
                swal(err.response.data.message,'','error');
             });
        },
        del_selected:function (idnex,type) {

            this.selected.splice(idnex,1)
            $('.'+type).show()
            axios.post(url,{
                    "_token":getToken(),
                    "filter":this.selected
                }
            ).then(function (response) {
                $('.server').html(response.data)
                $(".type_box li:nth-child(4n)").addClass("lastLi");
                $("img.lazy").lazyload({effect: "fadeIn"});
            }).catch(function (err) {
                swal(err.response.data.message,'','error');
            });
        },
    },
    computed: {

    }
});