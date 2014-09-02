<?php
/**
 * PHP SDK for 微信sutui(微信号：sutui)
 * 
 * @author 小卒 （http://weibo.com/xiaozu）
 */
include('Requests.php');
class sutui
{

	function __construct($key, $secret, $api_host='')
	{
		$this->key=$key;
		$this->secret=$secret;
		if(!$api_host)
			$this->api_host='http://api.sutui.me';
		else
			$this->api_host=$api_host;
		Requests::register_autoloader();
	}

    private function _complete_url($url)
    {
    	$key = 'api.key=' .$this->key;
        $ts = 'api.timestamp=' .time();
        $sign = 'api.signature='.sha1($this->key.'&'.$this->secret.'&'.time());
        $url= $this->api_host.$url.'?'.$key.'&'.$ts.'&'.$sign;
        return $url;
    }

    function subscribe($user_id, $channel_id, $unsubscribe=0)
    {
    	$paramArr = array(
          'user_id' => $user_id,
          'channel_id' => $channel_id,
          'unsubscribe' => $unsubscribe 
          );
        $url=$this->_complete_url('/subscription/');
		return Requests::post($url,array(),$paramArr);
    }

    function unsubscribe($sid)
    {
        $url=$this->_complete_url('/subscription/'.$sid.'/');
        return Requests::delete($url);
    }

    function subscriptions($uid)
    {
        $paramArr = array(
          'user_id' => $user_id
          );
        $url=$this->_complete_url('/subscription/');
        return Requests::get($url,array(),$paramArr);
    }

    function channels()
    {
        $url=$this->_complete_url('/channel/');
        return Requests::get($url);
    }

    function create_channel()
    {
        $paramArr = array(
          'name' => $name
          );
        $url=$this->_complete_url('/channel/');
        return Requests::post($url,array(),$paramArr);
    }

    function remove_channel($channel_id)
    {
        $url=$this->_complete_url('/channel/'.$channel_id.'/');
        return Requests::delete($url);
    }

    function notify($channel_id, $msg_type, $message)
    {
    	$data=array('channel_id'=>$channel_id,'msg_type'=>$msg_type,'content'=>$message);
    	$url=$this->_complete_url('/message/');
    	$postdata = json_encode($data);
		return Requests::post($url,array('Accept' => 'application/json'),$postdata);
    }

    function commands($channel_id='')
    {
        $paramArr=array();
        if($channel_id)
          $paramArr = array(
          'channel' => $channel_id
          );
        $url=$this->_complete_url('/command/');
        return Requests::get($url,array(),$paramArr);
    }

    function create_command($channel_id, $command, $url, $description='',$override=true)
    {
        $paramArr = array(
          'channel_id' => $channel_id,
          'command' => $command,
          'url' => $url,
          'description' => $description,
          'override' => $override
          );
        $url=$this->_complete_url('/command/');
        return Requests::post($url,array(),$paramArr);
    }

    function update_command($command_id,$channel_id='', $command='', $url='', $description='')
    {
        $paramArr = array(
          'channel_id' => $channel_id,
          'command' => $command,
          'url' => $url,
          'description' => $description
          );
        $url=$this->_complete_url('/command/'.$command_id.'/');
		return Requests::put($url,array(),$paramArr);
    }

    function remove_command($command_id)
    {
        $url=$this->_complete_url('/command/'.$command_id.'/');
        return Requests::delete($url);
    }
}
?>