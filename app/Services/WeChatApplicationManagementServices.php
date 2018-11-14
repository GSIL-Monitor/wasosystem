<?php

namespace App\Services;

use App\Http\Requests\Request;
use App\Models\WeChatApplicationManagement;
use GuzzleHttp\Client;
class WeChatApplicationManagementServices
{
    protected $applicationManagement;
    protected $corpid='ww9a464e38eed8c6d1';
    protected $secret='';
    protected $accessToken='';
    protected $client;
    protected $app;
    public function __construct(WeChatApplicationManagement $applicationManagement,Client $client,Request $request)
    {
        $this->applicationManagement=$applicationManagement;
        $this->client=$client;
        $this->setSecret($request);
        $this->setAccessToken();
    }

    public function headers()
    {
        return[
            'Content-Type'=>'application/json',
            'charset'=>'utf-8',
            'Access-Control-Allow-Origin'=>'*'
        ];
    }

    //设置access_token
    public function setAccessToken(){
        $request=$this->client->get($this->getTokenUrl());
        $request_arr=json_decode($request->getBody()->getContents(),true);
        $this->accessToken=$request_arr['access_token'];
    }
    //设置secret
    public function setSecret($request)
    {
        $agentid=$request->get('agentId') ?? '1000003';
        $app=$this->applicationManagement->whereAgentid($agentid)->first();
        $this->app=$app;
        $this->secret=$app->secret ?? 'cdlJhwsZP0quN3g2lHjJ8P7GUfKW5EdWSk3Vokqubxg';
    }
    //获取token链接
    public function getTokenUrl()
    {
        return "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={$this->corpid}&corpsecret={$this->secret}";
    }
    //获取创建群聊url
    public function getAppcChatUrl()
    {
        return "https://qyapi.weixin.qq.com/cgi-bin/appchat/create?access_token={$this->accessToken}";
    }
    //创建
    public function createAppcChat($data)
    {
        $request = $this->client->post($this->getAppcChatUrl(),[
            'body' => json_encode($data),
            'headers' => $this->headers()
        ]);
        $result = json_decode($request->getBody()->getContents(),true);
    //    dump($result);
        if($result['errmsg'] == 'ok'){
          //  dump($result['chatid']);
            if(empty($this->app->group_chat_array)){
                $chartids=[$result['chatid']=>$data['name']];
            }else{
                $chartids=array_prepend($this->app->group_chat_array,$data['name'],$result['chatid']);
              //  dump($this->app->group_chat_array);
            }
//
            $this->app->update(['group_chat_array'=>$chartids]);
//            dump($chartids);
//            dump($this->app);
        }


        return $result;
    }

}

?>