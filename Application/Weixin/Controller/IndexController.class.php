<?php
namespace Weixin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){   
    	$area = M('area')->limit(3)->select();
    	$this->assign("area",$area);
        $this->display();
    }
    
    public function search(){
    	$area = I('post.area');
    	$num = I('post.num');
    	//TODO 检测是否有特殊字符
    	$flag = preg_match('/[0-9a-zA-Z]{5}/', $num);
    	if(IS_AJAX){
    		if($flag != 1){
    			$this->ajaxReturn(array('status'=>2,'content'=>'未查到该车车主信息'));exit();
    		}
			$map['platenum'] = $area.$num;
			
			$res = M('userinfo')->where($map)->find();
			if($res == false){
				$this->ajaxReturn(array('status'=>2,'content'=>'No Data'));exit();
			}else{
				$this->ajaxReturn(array('status'=>1,'content'=>$res));exit();
			}
		}else{
			$this->ajaxReturn(array('status'=>2,'content'=>'wrong request'));exit();
		}
    }

    public function findplatenum(){
        $str = strtoupper(I('post.platenum'));
        $map['platenum'] = array('like',$str.'%');
        $res = M('userinfo')->field('platenum')->where($map)->select();
        if($res === false){
            $this->ajaxReturn(array('status'=>2,'content'=>'wrong request'));exit();
        }else{
            $this->ajaxReturn($res);exit();
        }
    }

    public function add(){
        $area = M('area')->select();
        $this->assign("area",$area);
        $this->display();
    }

    public function validate(){
        $postdata = I('post.data');
        $data = trim($postdata[0]);
        $data = empty($data)?'':$data;
        if(IS_AJAX){
            switch ($postdata[1]) {
            case 'username':
                $username = $data;
                $map = array('carowner'=>$username);
                break;
            case 'platenum':
                $platenum = $data;
                $map = array('platenum'=>$platenum);
                break;
            case 'phone':
                $phone  = $data;
                $map = array('phone'=>$phone);
                break;
            default:
                $this->ajaxReturn(array('status'=>1,'content'=>'illegal data'));exit();
            }
            $res = M('userinfo')->where($map)->find();
            if($res == false){
                $this->ajaxReturn(array('status'=>1,'content'=>'no recode'));exit();
            }else{
                $this->ajaxReturn(array('status'=>2,'content'=>'exist'));exit();
            }
        }else{
            $this->ajaxReturn(array('status'=>3,'content'=>'wrong request'));exit();
        }
    }

    public function saveData(){
         if(IS_AJAX){
            $map = I('post.');
            $map['platenum'] = strtoupper($map['platenum']);
            $res = M('userinfo')->data($map)->add();
            if($res == false){
                $this->ajaxReturn(array('status'=>2,'content'=>'add failure'));exit();
            }else{
                $this->ajaxReturn(array('status'=>1,'content'=>'add success'));exit();
            }
        }else{
            $this->ajaxReturn(array('status'=>3,'content'=>'wrong request'));exit();
        }
    }
}