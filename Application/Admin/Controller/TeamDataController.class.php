<?php
// +----------------------------------------------------------------------
// | TeamDataController.class.php
// +----------------------------------------------------------------------
// | Author: leighj
// +----------------------------------------------------------------------
// | Version: 2014-11-19下午5:44:43
// +----------------------------------------------------------------------
// | Copyright: ShowMore
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
use Common\Conf;
set_time_limit(3600);
class TeamDataController extends Controller{

	/**
	 *
	 * [getData 获取胜负场]
	 * @return boolean
	 * @access public
	 * @author leighj
	 * @version 2014-11-19 下午4:59:40
	 * @copyright Show More
	 */
	public function getData(){
		C( load_config( CONF_PATH.'web_url'.CONF_EXT  ) ) ;
		$team = C('team');
		$content = file_get_contents($team);
		$pattern = '/(<tr class="odd">[\s\S]+<\/tr>)+|(<tr class="even">[\s\S]+<\/tr>)+/U';
		preg_match_all($pattern, $content, $matche);
		dump($matche);die;
		foreach ($matche[0] as $k=>$v){
			$p = '/<td[^>]+>\s*(\d+)\s*<\/td>/U';
			preg_match_all($p, $v, $m);
			//dump($m);
			$p2 = '/.*?(&#\d{5};&#)/U';
			preg_match_all($p2, $v, $m2);
			array_push($m[1], $m2[1][0]);
			$arr = $m[1];
// 			dump($arr);
			$data[$k] = $this->packageInfo($arr);
		}
		//dump($data);
		$res = D('Admin/Team')->updateTeam($data);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 *
	 * [packageInfo description]
	 * @param unknown $arr
	 * @return unknown
	 * @access public
	 * @author leighj
	 * @version 2014-11-18 上午11:50:23
	 * @copyright Show More
	 */
	protected function packageInfo($arr){
		$str = substr($arr[3], 2,5);
		switch($str){
			case '28784':
				$data['D_NAME'] = '灰熊';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '28779':
				$data['D_NAME'] = '火箭';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '21191':
				$data['D_NAME'] = '勇士';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '25299':
				$data['D_NAME'] = '开拓者';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '23567':
				$data['D_NAME'] = '小牛';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '24555':
				$data['D_NAME'] = '快船';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '40520':
				$data['D_NAME'] = '鹈鹕';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '22269':
				$data['D_NAME'] = '国王';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '39532':
				$data['D_NAME'] = '马刺';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '22826':
				$data['D_NAME'] = '太阳';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '29237':
				$data['D_NAME'] = '爵士';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '25496':
				$data['D_NAME'] = '掘金';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '38647':
				$data['D_NAME'] = '雷霆';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '26519':
				$data['D_NAME'] = '森林狼';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '28246':
				$data['D_NAME'] = '湖人';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;//西部     //东部
			case '29467':
				$data['D_NAME'] = '猛龙';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '22855':
				$data['D_NAME'] = '奇才';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '20844':
				$data['D_NAME'] = '公牛';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '39569':
				$data['D_NAME'] = '骑士';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '32769':
				$data['D_NAME'] = '老鹰';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '28909':
				$data['D_NAME'] = '热火';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '38596':
				$data['D_NAME'] = '雄鹿';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '39764':
				$data['D_NAME'] = '魔术';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '31726':
				$data['D_NAME'] = '篮网';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '40644':
				$data['D_NAME'] = '黄蜂';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '34892':
				$data['D_NAME'] = '步行者';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '29305':
				$data['D_NAME'] = '凯尔特人';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '27963':
				$data['D_NAME'] = '活塞';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			case '20811':
				$data['D_NAME'] = '尼克斯';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
			default:
				$data['D_NAME'] = '76人';
				$data['D_WIN'] = (int)$arr[1];
				$data['D_LOS'] = (int)$arr[2];
				break;
		}
		return $data;
	}

	/**
	* [每日实时比分获取，缓存10秒]
	* @param unknown
	* @return unknown
	* @access public
	* @author leighj
	* @copyright Show More
	*/
	public function mature(){
		C( load_config( CONF_PATH.'web_url'.CONF_EXT  ) ) ;
		$boxscore = S('livedata');
		if(empty($boxscore)){
			$url = C('score');
			$content = file_get_contents($url);
			$contents = json_decode($content,1);
			$today = $contents['payload']['today']['games'];
			foreach ($today as $key => $value) {
				$boxscore[$key] = $value['boxscore'];
				$boxscore[$key]['awayTeam'] = $value['awayTeam']['profile']['name'];
				$boxscore[$key]['homeTeam'] = $value['homeTeam']['profile']['name'];
			}
			S('livedata',$boxscore,10);
		}
		return $boxscore;
	}


	/**
	 *
	 * [archive 一周的赛程]
	 * @return multitype:array
	 * @access public
	 * @author leighj
	 * @version 2014-11-27 下午3:47:18
	 * @copyright Show More
	 */
	protected function archive(){
		$url = 'http://nba.sports.163.com/schedule/';
		$content = file_get_contents($url);
		$p = '/<table[^>]+>([\s\S]+?)<\/table>/';
		preg_match_all($p,$content,$m);
		$p2 = '/<h2  class="tb-title">([\s\S]+?)<\/h2>/';
		preg_match_all($p2,$content,$m2);
		$matchday = $m2[1];
		foreach ($matchday as $val){
			$mat[] = substr($val,0, -10);
		}
		$matchdaynum = count($mat);
		foreach ($m[1] as $k=>$v){
			preg_match_all('/<td[^>]*>[\s](.*?)<\/td>/', $v,$data[]);
			preg_match_all('/<span class="dycolor">(.*?)<\/span>/', $v,$data[]);
		}
		foreach ($data as $val){
			if(empty($val[1])){
				break;
			}
			$res[] = $val[1];
		}
		unset($data,$k,$v,$val);
		for ($i = 2;$i <= $matchdaynum*2;$i = $i+2 ){
			foreach ($res as $k=>$v){
				if($k < 2 ){
					if($k%2 == 0){
						$a1 = $v;
					}else{
						$a2 = $v;
					}
				}else{
					break;
				}
			}
			$res = array_slice($res,2);
			for ( $j = 0 ; $j < count($a2) ; $j = $j + 2 ){
				if( strlen( $a1[$j] ) < 6 ){
					$data[$i][$j]['flag'] = $a1[$j/2];
					$data[$i][$j]['score'] = 'VS';
				}else{
					$data[$i][$j]['flag'] = $a1[$j];
					$data[$i][$j]['score'] = $a1[$j+1];
				}
				$data[$i][$j]['guestt'] = $a2[$j];
				$data[$i][$j]['hostt'] = $a2[$j+1];
			}
		}
		$result = array_combine($mat, $data);
		return $result;
	}
	
	/**
	 * 
	 * [addDailyRecode 记录每日最终比分]
	 * @return boolean
	 * @access public
	 * @author leighj
	 * @version 2014-12-29 上午10:25:24
	 * @copyright Show More
	 */
	public function addDailyRecode(){		
		$weekRecode = $this->archive();
		$today = date('Y年m月d日',time());
		G('begin_update');
		foreach ($weekRecode as $key => $value){
			switch ($key){
				case $today:
					foreach ($value as $k => $v){						
							//update
							$where = array('guestt'=>$v['guestt'] ,'hostt'=>$v['hostt'],'score'=>'VS','matchtime' =>  $today);
							$map = array(
									'score'     =>  $v['score'],
									'flag'      =>	$v['flag'],									
							);
							$res = M('DailyRecode')->where($where)->setField($map);
					}
					break;
			}
		}
		G('end_update');
		$update_use_time = G('begin_update','end_update').'s';
		\Think\Log::record("success to update today match score from 163 using ".$update_use_time, 'INFO', true);
		\Think\Log::save('File', C('LOG_PATH') . 'updateScoreData_' . date('y_m_d') . '.log');
	}
	
	/**
	 * 
	 * [addWeekRecode 记录每周赛程]
	 * 一星期add一次
	 * @access public
	 * @author leighj
	 * @version 2014-12-29 下午1:21:43
	 * @copyright Show More
	 */
	public function addWeekRecode(){
		G('begin_catch');
		$weekRecode = $this->archive();
		G('end_catch');
		$api_use_time = G('begin_catch','end_catch').'s';
		\Think\Log::record("success to catch weeklydata from 163 using ".$api_use_time, 'INFO', true);
		G('begin_db');
		//避免重复抓取下周数据
		$extreweek = date('Y-m-d',strtotime('-1 week')); 
		$last = M('DailyRecode')->field('MIN(matchtime) as TT')->where("DATE_FORMAT(intime,'%Y-%m-%d') = '$extreweek'")->find();
		if(array_key_exists($last['TT'], $weekRecode)){
			return ;
		}
		foreach ($weekRecode as $key => &$value){
			foreach ($value as $k => &$v){
				$v['matchtime'] = $key;
			}
			$res[] = M('DailyRecode')->addAll($value);
		}
		G('end_db');
		$db_use_time = G('begin_db','end_db').'s';
		\Think\Log::record("success to add weeklydata to db using ".$db_use_time, 'INFO', true);		
		\Think\Log::save('File', C('LOG_PATH') . 'catchWeeklyData_' . date('y_m_d') . '.log');
	}	
	
	/**
	 *
	 * [china.nba.com/news/]
	 * @return multitype:array
	 * @access public
	 * @author leighj
	 * @version 2015-09-08 下午3:47:18
	 * @copyright Show More
	 */
	public function getNews(){		
		$url = 'http://china.nba.com/news/';
		$content = file_get_contents($url);
		$content = substr($content,12400,5000);
		
		$filePath = __PHY__.'/tt.html';

		$filehandler = fopen($filePath, 'w');

		if(!$filehandler){
			echo 1;
		}
		if ( fwrite ( $filehandler ,  $content ) ==  FALSE ) {
	        echo  "不能写入到文件  $filename " ;
	        exit;
	    }

		/*$contents = fread($filehandler, filesize($filePath));
		$p = '/<div class="new-posi">([\s\S]+)<\/div><\/div>/';
		preg_match($p,$contents,$m);
		print_r($m[1]);
		*/
		fclose($filehandler);

	}


}