<?php
namespace App\Services;
use GuzzleHttp\Client;

class MessageSendServices{

     protected $post_url="";
     protected  $client;

    public function setPostUrl($phone,$content)
    {
        $this->client=new Client();
        $post_data =config('message');
        $post_data['content'] = urlencode("【网烁】".$content);
        $post_data['mobile'] = $phone;
        $this->post_url="http://dx1.xitx.cn:8888/sms.aspx?action=send".array_to_url($post_data);
    }

    public function MessageSend($phone,$content)
    {
        $this->setPostUrl($phone,$content);
        $request=$this->client->get($this->post_url);
        return $this->xmlToArray($request->getBody()->getContents())['message'];
    }

    public function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }
    public function checkCode($key,$value)
    {
        if(cache()->has($key))
            if(cache()->get($key) == $value){
//                cache()->forget($key) ;
                return 'success';
            }else{
                return 'error';
            }
        else{
            return 'overdue';
        }
    }
}
?>