<?php
// +----------------------------------------------------------------------
// | IndexAction.class.php
// +----------------------------------------------------------------------
// | Author: leighj
// +----------------------------------------------------------------------
// | Version: 2014-11-13下午5:41:20
// +----------------------------------------------------------------------
// | Copyright: ShowMore
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller{

	public function upload(){
		if(!empty($_FILES['file']['name'])){
			$data = $this->_upload();
			$this->ajaxReturn($data['count'],$data['savename'],1);
		}else{
			$this->ajaxReturn('','没有上传文件',0);
		}
		
	}
	
	/**
	 *
	 * [_upload description]
	 * @return 文件保存路径
	 * @access public
	 * @author leighj
	 * @version 2014-10-23 上午9:57:21
	 * @copyright Show More
	 */
	protected function _upload() {
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3292200 ;// 设置附件上传大小
		$dt =  Date('Y-m-d').'-'.time();
		$upload->saveRule = $dt;//文件命名规则
		$upload->allowExts  = array('txt');// 设置附件上传类型
		$upload->savePath =  __PHY__.'/Public/Uploads/';// 设置附件上传目录
		foreach ($_FILES as $key=>$file){
			if(!empty($file['name'])) {
				$info =  $upload->uploadOne($file);
				if($info){ // 保存附件信息
					//单条分析
					$data['savename'] = $info[0]['savename'];
					$data['count'] = $this->ckfilecontent($data['savename']);
					return $data;
				}else{ // 上传错误
					$this->ajaxReturn('',$upload->getErrorMsg(),0);
				}
			}
		}
	}
		protected function ckfilecontent($filename){
			$path = __PHY__.'/Public/Uploads/';
			$content = trim(file_get_contents($path.$filename));
			$file_data = iconv ( 'GBK', 'UTF-8', $content );
			$str = explode("\r\n", $file_data);
			$arrSize = count($str);
			return $arrSize;
		}
		

		/**
		 *
		 * [saveData 保存数据]
		 * @param 文件保存路径 $savename
		 * @param 组id $gdid
		 * @return unknown
		 * @access public
		 * @author leighj
		 * @version 2014-10-23 上午9:53:52
		 * @copyright Show More
		 */		
		public function saveData(){
			$this->isAjax() or throw_exception('wrong request'); 
			$savename = $this->_post('filename');
			//$savename = '2014-11-14-1415937508.txt';
			$path = __PHY__.'/Public/Uploads/';
			$content = trim(file_get_contents($path.$savename));			
			$file_data = iconv ( 'GBK', 'UTF-8', $content );			
			$str = explode("\r\n", $file_data);
			foreach ($str as $key => $val){
				$row = (int)($key+1);
				if(empty($val)){
					continue;
				}if(ord($val[0])==239 && ord($val[1])==187 && ord($val[2])==191){
					$val = substr($val, 3);
				};
				$val = str_replace('，', ',', $val);
				$a = explode(",", $val);               //a[0] 队名 a[1]东西部 a[2]胜场 a[3]负场				
				$data[$key]['D_ID'] = array('exp','SEQ_DTEAM_ID.NEXTVAL');
				$data[$key]['D_NAME']  = $a[0];
				$data[$key]['D_AREA'] = (int)$a[1];
				$data[$key]['D_WIN'] = (int)$a[2];
				$data[$key]['D_LOS'] = (int)$a[3];
			}
			$res = D('App/DTeam')->addTeam($data);
			if($res){
				$this->ajaxReturn('','添加成功',1);
			}else{
				$this->ajaxReturn('','添加失败',0);
			}
				
		}


		
		
}