<?php
// +----------------------------------------------------------------------
// | WebHookController.class.php
// +----------------------------------------------------------------------
// | Author: alexander <gt199899@gmail.com>
// +----------------------------------------------------------------------
// | Version: [2015-1-8下午4:15:04]
// +----------------------------------------------------------------------
// | Copyright: ShowMore
// +----------------------------------------------------------------------
namespace Git\Controller;
use Think\Controller;
use Think\Log;
class WebHookController extends Controller{
	
	// token
	private $token = "basketball";
	
	
	/**
	 * index
	 * webhook处理
	 * @access public
	 * @author alexander<gt199899@gmail.com>
	 * @version [2015-1-9 上午11:29:37]
	 * @copyright Show More
	 */
	public function index(){
		$git_push_info = file_get_contents('php://input', 'r');
		$this->log($git_push_info);
		$git_push_arr = json_decode($git_push_info, true);
		$this->checkAccess($git_push_arr['token']) or $this->noAccess();
		$this->gitPull();
	}
	
	/**
	 * _after_index
	 * 后置操作
	 * @access public
	 * @author alexander<gt199899@gmail.com>
	 * @version [2015-1-9 下午12:19:18]
	 * @copyright Show More
	 */
	public function _after_index(){
		$this->log('', 'save');
	}
	
	/**
	 * checkAccess
	 * token验证
	 * @access public
	 * @param unknown $token
	 * @return boolean
	 * @author alexander<gt199899@gmail.com>
	 * @version [2015-1-9 上午11:58:55]
	 * @copyright Show More
	 */
	private function checkAccess($token){
		if($this->token == $token){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * noAccess
	 * @access public
	 * @author alexander<gt199899@gmail.com>
	 * @version [2015-1-9 下午12:04:32]
	 * @copyright Show More
	 */
	private function noAccess(){
		$this->log('no access');
		header("HTTP/1.1 403 Access forbidden");
		header('Status:403 Access forbidden');
		echo "<html>
			<head>
			<title>Access forbidden!</title>
			</head>
			<body>
			<h1>Access forbidden!</h1>
			</body>
			</html>";
		exit;
	}
	
	/**
	 * gitPull
	 * git的pull操作
	 * @access public
	 * @author alexander<gt199899@gmail.com>
	 * @version [2015-1-9 下午12:20:20]
	 * @copyright Show More
	 */
	private function gitPull(){
		$pull_command = "cd /www/basketball";
		exec($pull_command, $output, $return);
		$this->log(json_encode($output));//dump($output);
		$this->log($return);
		$pull_command = "git pull origin master";
		exec($pull_command, $output, $return);//dump($output);dump($return);
		$this->log(json_encode($output));
		$this->log($return);
	}
	
	/**
	 * log
	 * 记录日志
	 * @access public
	 * @author alexander<gt199899@gmail.com>
	 * @version [2015-1-9 下午12:15:25]
	 * @copyright Show More
	 */
	private function log($git_push_info, $type = 'record'){
		$type == 'record' and Log::record($git_push_info, Log::INFO, true);
		$type == 'save' and Log::save('file', C('LOG_PATH').'webhook_'.date('y_m_d').'.log');
	}
	
	public function request(){
		$a = '{"after":"cb31157bbdc9fecb2e80dbbf069bbd4c1a526190","ref":"master","repository":{"https_url":"https://coding.net/leigh/Basketball.git","description":"","web_url":"https://coding.net/u/leigh/p/Basketball","name":"Basketball","project_id":"53025","owner":{"email":"***@qq.com","name":"leigh"},"ssh_url":"git@coding.net:leigh/Basketball.git"},"before":"5e87568735e2ee3df826a97b65c5926ef987e25e","event":"push","commits":[{"sha":"cb31157bbdc9fecb2e80dbbf069bbd4c1a526190","short_message":"ttt\n","committer":{"email":"***@qq.com","name":"leigh"}}],"token":"basketball"}';
		$url = "http://nba.webghome.com/Git/WebHook/index.html";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $a);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);//echo $response;
		curl_close($curl);
	}
	
}
