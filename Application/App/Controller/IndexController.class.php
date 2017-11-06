<?php
namespace App\Controller;
use Think\Controller;

class IndexController extends Controller{	
	/**
	 * 球队信息
	 * [index description]
	 * @access public
	 * @author leighj
	 * @version 2014-11-24 下午2:43:09
	 * @copyright Show More
	 */
	public function index(){
		if( !S('flag') ){
			$res = R('Admin/TeamData/getData',array());
			S('flag',$res,C('SESSION_EXPIRE'));
		}
		//第一部分
		$todaydata = R('Admin/TeamData/mature',array());
		$this->assign('todayData',$todaydata);
		//第二部分
		$tomorrow = date('Y年m月d日',strtotime('+1 day'));
		$nextdayData = M('DailyRecode')->where(array('matchtime'=>$tomorrow))->select();
		$this->assign('nextdayData',$nextdayData);
		//第三部分
		$team_info = M('Team')->field('D_NAME,D_AREA,D_WIN,D_LOS,D_P01,D_WIN/(D_WIN+D_LOS) as tol')->order('D_AREA, tol DESC')->select();
		foreach ($team_info as $key => $value) {
			if ($value['D_AREA'] == 1) {
				$infoWestTeam[] = $value;
			}else{
				$infoEastTeam[] = $value;
			}
		}
		$this->assign('infoWestTeam',$infoWestTeam);
		$this->assign('infoEastTeam',$infoEastTeam);
		//第四部分 新闻
		
		$this->display();	
	}
}