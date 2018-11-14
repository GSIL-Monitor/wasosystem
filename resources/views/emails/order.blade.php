@if($last_login_time == $created_at   || empty($last_login_time))
    <div>
        欢迎新会员{{ $username }}，您在网烁购买的产品(订单号：{{ $serial_number }})已发货,物流信息:{{ $logistics_info }}，您可在我司网站(www.waso.com.cn)查询购买记录及质保服务。账号:{{ $username }}  初始密码:{{ $password }}，谢谢惠顾!<br/>系统邮件无需回复。<br/>成都网烁信息科技有限公司<br/>{{ $send_time }};
    </div>
@else
    <div>尊敬的客户：{{ $username }}，您购买的产品(订单号：{{ $serial_number }})已发货,物流信息：{{ $logistics_info }},谢谢惠顾!</div>
@endif
