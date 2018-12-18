var vm=new Vue({
    el:'#app',
    data:{
            selects:{
              'email': "邮箱找回",
              'phone':"手机找回"
            },
            type:'phone',
            number:'',
            code:'',
            content: '发送验证码',  // 按钮里显示的内容
            totalTime: 30,    //记录具体倒计时时间
            canClick: true, //添加canClick,
            next_step:false,
            password:'',
            password_confirmation:'',

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
            var name= type == 'phone' ? '手机号' : '邮箱';
            if (!number){
                vee_errors(self,'number','请输入'+name);
            }else{
                if (!this.canClick) return false;
                self.count_down();
                axios.post(url, {
                    '_token': getToken(),
                    'number': number
                }).then(function (response) {
                }).catch(function (err) {
                    if(err.response.data.info){
                        vee_errors(self,type + '_code',err.response.data.info)
                    }else{
                        swal(err.response.data.message,
                            '请根据提示操作！',
                            'warning')
                    }
                });
            }
        },
        next: function (url, number, type) {
            var self = this;
            this.$validator.validateAll().then(function (msg) {
                if(msg){
                    axios.post(url, {
                        '_token': getToken(),
                        'number': number,
                        'type': type,
                        'code_name': type + '_code',
                        'code': self.code
                    }).then(function (response) {
                        self.next_step=true
                    }).catch(function (err) {
                        if(err.response.data.info=='已存在'){
                            self.next_step=true
                        }else{
                            vee_errors(self,type + '_code',err.response.data.info)
                        }
                    });
                }
            });
        },
        save: function (url,number,type) {
            var self = this;
            var Notice=this.$Notice;
            this.$validator.validateAll().then(function (msg) {
                if(msg){
                    axios.post(url, {
                        '_token': getToken(),
                        'number': number,
                        'type': type,
                        'password': self.password,
                    }).then(function (response) {
                        Notice.success(
                            {
                                title: "重置密码成功！",
                                duration:1,
                                onClose: function () {
                                    location.href='/login'
                                }
                            });

                    }).catch(function (err) {
                        swal('网络错误！','','error')
                    });
                }
            });
        },
    },
    created: function () {
        const self = this;
        this.$validator.extend('unique', {
            getMessage: field => field + '不存在！',
            validate: value => {
                return axios.post('/binding_authorization/check_number', {
                    '_token': getToken(),
                    'number': value,
                }).then(function (response) {
                    return {
                        valid: false,
                    };
                }).catch(function (err) {
                    return {
                        valid: true,
                    };
                });
            }
       });
    },
});