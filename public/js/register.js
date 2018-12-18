var vm = new Vue({
    el: '#app',
    data: {
        phone: '',
        phone_code: '',
        email: '',
        email_code: '',
        username: '',
        password: '',
        password_confirmation: '',
        next_step: false,
        content: '发送验证码',  // 按钮里显示的内容
        totalTime: 30,    //记录具体倒计时时间
        canClick: true, //添加canClick,
        checked: true
    },
    methods: {
        count_down: function () {
            this.canClick = false;
            this.content = this.totalTime + 's后重新发送';
            var self = this;
            var clock = window.setInterval(function () {
                self.totalTime--;
                self.content = self.totalTime + 's后重新发送';
                if (self.totalTime < 0) {
                    window.clearInterval(clock)
                    self.content = '重新发送验证码'
                    self.totalTime = 30
                    self.canClick = true  //这里重新开启
                }
            }, 1000);
        },
        send: function (url, number, type) {
            var self = this;
            var name = type == 'phone' ? '手机号' : '邮箱';
            if (!number) {
                vee_errors(self, type, '请输入' + name);
            } else {
                if (!this.canClick) return false;
                self.count_down();
                axios.post(url, {
                    '_token': getToken(),
                    'number': number
                }).then(function (response) {
                }).catch(function (err) {
                    if (err.response.data.info) {
                        vee_errors(self, type + '_code', err.response.data.info)
                    } else {
                        swal(err.response.data.message,
                            '请根据提示操作！',
                            'warning')
                    }
                });
            }
        },
        next: function (url, number, type) {
            var self = this;
            var code = type == 'email' ? this.email_code : this.phone_code;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.post(url, {
                        '_token': getToken(),
                        'number': number,
                        'type': type,
                        'code_name': type + '_code',
                        'code': code
                    }).then(function (response) {
                        self.next_step = true
                    }).catch(function (err) {
                        vee_errors(self, type + '_code', err.response.data.info)
                    });
                }
            });
        },
        wechat_bind: function (url) {
            var self = this;
            var Notice = this.$Notice;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.post(url, {
                        '_token': getToken(),
                        'username': self.username,
                    }).then(function (response) {
                        Notice.success(
                            {
                                title: "绑定成功！",
                                duration: 1,
                                onClose: function () {
                                    location.href = '/member_center'
                                }
                            });

                    }).catch(function (err) {
                        swal('网络错误！', '', 'error')
                    });
                }
            });
        },
        wechat_save: function (url) {
            var self = this;
            var Notice = this.$Notice;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.post(url, {
                        '_token': getToken(),
                        'username': self.username,
                        'phone': self.phone,
                        'password': self.password,
                    }).then(function (response) {
                        Notice.success(
                            {
                                title: "注册成功！稍后会有客服人员联系您！",
                                duration: 1,
                                onClose: function () {
                                    location.href = '/member_center'
                                }
                            });

                    }).catch(function (err) {
                        swal('网络错误！', '', 'error')
                    });
                }
            });
        },
        save: function (url, number, type) {
            var self = this;
            var Notice = this.$Notice;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.post(url, {
                        '_token': getToken(),
                        'number': number,
                        'type': type,
                        'username': self.username,
                        'password': self.password,
                    }).then(function (response) {
                        Notice.success(
                            {
                                title: "注册成功！",
                                duration: 1,
                                onClose: function () {
                                    location.href = 'registers/check/' + response.data
                                }
                            });

                    }).catch(function (err) {
                        swal('网络错误！', '', 'error')
                    });
                }
            });
        },
    },
    created: function () {
    },
});

$(document).ready(function () {


    /*  注册方式 */
    // $(".registerInfoBox").load("register_phone.html");
    // $(document).on("click","#register_body li",function(){
    //     var type = $(this).attr("name");
    //     $(this).addClass("active").siblings("li").removeClass("active");
    //     if(type=="phone"){
    //         $(".registerInfoBox").html("");
    //         $(".registerInfoBox").load("register_phone.html");
    //     }else if(type=="mail"){
    //         $(".registerInfoBox").html("");
    //         $(".registerInfoBox").load("register_mail.html");
    //     }
    // });

    /*  同意条例 */
    $(document).on("click", '.agrees input', function () {
        if ($(this).hasClass('agree')) {
            $(this).removeClass('agree').addClass('no_agree');
        } else {
            $(this).removeClass('no_agree').addClass('agree');
        }
    });


});











