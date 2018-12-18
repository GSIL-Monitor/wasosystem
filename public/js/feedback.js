var vm = new Vue({
    el: '#app',
    data: {
        name:'',
        phone:'',
        email: '',
        title: '',
        content: '',
        captcha: '',

    },
    methods: {
        save:function () {
            this.$validator.validateAll().then(function () {
                var self = this;
                if (!this.errors.any()) {
                    axios.post($('.feedback_save').attr('action'), $('.feedback_save').fixedSerialize()).then(function (response) {
                        swal(response.data.info,
                            '请根据提示操作！',
                            'success').then(function () {
                            location.reload();
                        })
                    }).catch(function (err) {
                        $("#che_pic").attr('src',$("#che_pic").attr('src')+'?'+Math.random())
                        if (err.response.data.errors != undefined) {
                            $.each(err.response.data.errors, function (name, errMsg) {
                                console.log(name, errMsg[0]);
                                vee_errors(self,name, errMsg[0])
                            });
                        } else {
                            swal(err.response.data.message,
                                '请根据提示操作！',
                                'warning')
                        }
                    });
                }
            });
        }
    }
});


// /**
//  * Created by john on 2016/7/8.
//  */
//
// $(document).ready(function(){
//      $('.email').focus(function(){
//          if($(this).val()=="您的电子邮箱 *"){
//                $(this).val("").css("color","#000");
//          }
//      });
//     $('.email').blur(function(){
//         if($(this).val()=="" || $(this).val()==" "){
//             $(this).attr("value","您的电子邮箱*").css("color","#999");
//         }
//     });
//
//     $('.name').focus(function(){
//         if($(this).val()=="标题 *"){
//             $(this).val("").css("color","#000");
//         }
//     });
//     $('.name').blur(function(){
//         if($(this).val()=="" || $(this).val()==" "){
//             $(this).val("标题 *").css("color","#999");
//         }
//     });
//
//     $('.content').focus(function(){
//         if($(this).val()=="具体内容 *"){
//             $(this).val("").css("color","#000");
//         }
//     });
//     $('.content').blur(function(){
//         if($(this).val()=="" || $(this).val()==" "){
//             $(this).val("具体内容 *").css("color","#999");
//         }
//     });
//
// });
//
//
//
//
//
//
//
