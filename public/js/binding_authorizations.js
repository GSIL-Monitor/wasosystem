var vm = new Vue({
    el: "#app",
    data: {
        edit_email: false,
        edit_phone: false,
        email_code: '',
        phone_code: '',
        email: '',
        phone: '',
        new_email: false,
        new_phone: false,
        content: '发送验证码',  // 按钮里显示的内容
        totalTime: 30,    //记录具体倒计时时间
        canClick: true, //添加canClick,
        mailReg: /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/,
        phoneReg: /^1[3-578]\d{9}$/,
        error: false,

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
            if (!this.canClick) return false;
            self.count_down();
            axios.post(url, {
                '_token': getToken(),
                'number': number
            }).then(function (response) {
            }).catch(function (err) {
                swal(err.response.data.message,
                    '请根据提示操作！',
                    'warning')
                if (type == 'email') {
                    self.email_error = err.response.data.message
                } else {
                    self.phone_error = err.response.data.message
                }
            });
        },
        bind: function (url, number, type) {
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
                        swal(response.data.info,
                            '请根据提示操作！',
                            'success').then(function () {
                            location.reload();
                        })
                    }).catch(function (err) {
                        vee_errors(self,type + '_code',err.response.data.info)
                    });
                }
            });
        },
        check_code: function (url, type) {
            var self = this;
            var code = type == 'email_code' ? this.email_code : this.phone_code;
            const field = this.$validator.fields.find({name: type, scope: this.$options.scope});
            if (!field) return;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.post(url, {
                        '_token': getToken(),
                        'code': code,
                        'code_name': type
                    }).then(function (response) {
                        self.content = '发送验证码'; // 按钮里显示的内容
                        self.otalTime = 30;    //记录具体倒计时时间
                        if (type == 'email_code') {
                            self.edit_email = false
                            self.new_email = true
                        } else {
                            self.edit_phone = false
                            self.new_phone = true
                        }
                        self.email_code = ''
                        self.phone_code = ''
                    }).catch(function (err) {
                        self.$validator.errors.add({
                            id: field.id,
                            field: type,
                            msg: err.response.data.info,
                            scope: self.$options.scope,
                        });
                    });
                }
            });
        },
        edit: function (type) {
            if (type == 'email') {
                this.edit_email = true
                this.edit_phone = false
                this.new_phone = false
            } else {
                this.edit_phone = true
                this.edit_email = false
                this.new_email = false
            }
        },
        bind_new: function (type) {
            this.aa = '1';
            if (type == 'email') {
                this.new_email = true
                this.new_phone = false
                this.edit_phone = false
            } else {
                this.new_phone = true
                this.new_email = false
                this.edit_email = false
            }
        },
        cancel: function (type) {
            if (type == 'email') {
                this.edit_email = false
                this.new_email = false
            } else {
                this.new_phone = false
                this.edit_phone = false
            }
        },
    },
    created: function () {
        const self = this;
        // this.$validator.extend('unique', {
        //     getMessage: field => field + '已存在！',
        //     validate: value => {
        //         return axios.post('/binding_authorization/check_number', {
        //             '_token': getToken(),
        //             'number': value,
        //         }).then(function (response) {
        //             return {
        //                 valid: true,
        //             };
        //         }).catch(function (err) {
        //             return {
        //                 valid: false,
        //             };
        //         });

                // return axios.post('/binding_authorization/check_number', {
                //     '_token': getToken(),
                //     'number': value,
                // }).then(function (response) {
                //     return {
                //         valid: true,
                //     };
                // }).catch(function (err) {
                //     return {
                //         valid: false,
                //     };
                // });
        //     }
        // });
    },
    mounted: function () {


    }
});