<?php
namespace Weixin\Controller;
use Think\Controller;
use Think\Wechat\Wechat;
class QingController extends Controller {
	public function test(){
		echo C("Images")."Weixin/head.jpg";
		echo '<br>';
		echo __ROOT__.'/Weixin/Index';
	}
    public function index(){
        $options = array(
			'token'=>'findcarowner', //填写你设定的key
			'encodingaeskey'=>'*****', //填写加密用的EncodingAESKey
			'appid'=>'****', //填写高级调用功能的app id
			'appsecret'=>'****', //填写高级调用功能的密钥
			'debug' => true
		);
	 	$weObj = new Wechat($options);
	    $weObj->valid();
	    $type = $weObj->getRev()->getRevType();
	    switch($type) {
	   		case Wechat::MSGTYPE_TEXT:
	   			$content = $weObj->getRev()->getRevContent(); //获取消息内容
                $pattern = '/(车)|(che)/i';
                if(preg_match($pattern, $content)){                   
                        $data = array(    //articles  图文消息，一个图文消息支持1到10个图文
                                "0"=>array(
                                    "Title" => "Find Car Owner",             //标题
                                    "Description" => "", //描述
                                    "PicUrl" => C("Images")."Weixin/head.jpg",          //图文消息的图片链接,支持JPG、PNG格式，较好的效果为大图6320，
                                    "Url" => __ROOT__.'Weixin/Index/index',                 //点击后跳转的链接。可根据url里面带的code参数校验员工的真实身份。
                                    //小图80。如不填，在客户端不显示图片
                                ),
                        );
                    $result = $weObj->news($data)->reply();
                }elseif($content == '添加'){
						$data = array(    //articles  图文消息，一个图文消息支持1到10个图文
                                "0"=>array(
                                    "Title" => "Add Car Owner Information",             //标题
                                    "Description" => "", //描述
                                    "PicUrl" => C("Images")."Weixin/head.jpg",          //图文消息的图片链接,支持JPG、PNG格式，较好的效果为大图6320，
                                    "Url" => __ROOT__.'Weixin/Index/index',                //点击后跳转的链接。可根据url里面带的code参数校验员工的真实身份。
                                    //小图80。如不填，在客户端不显示图片
                                ),
                        );
                    $result = $weObj->news($data)->reply();                
                }else{
                    $weObj->text("========*******========
查询车主信息，请回复‘车主’
添加车主信息，请回复‘添加’
========*******========")->reply();
                }
	   			exit;
	   			break;
	   		case Wechat::MSGTYPE_EVENT:

	   			break;
	   		case Wechat::MSGTYPE_IMAGE:
	   			break;
	   		default:
	   			$weObj->text("help info")->reply();
   		}
    }
}