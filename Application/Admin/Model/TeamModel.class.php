<?php
// +----------------------------------------------------------------------
// | TeamModel.class.php
// +----------------------------------------------------------------------
// | Author: leighj
// +----------------------------------------------------------------------
// | Version: 2014-12-20下午12:44:05
// +----------------------------------------------------------------------
// | Copyright: ShowMore
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
class TeamModel extends Model{
	/**
	 * 添加球队信息
	 * [addTeam description]
	 * @param unknown $data
	 * @return boolean
	 * @access public
	 * @author leighj
	 * @version 2014-11-14 上午11:19:23
	 * @copyright Show More
	 */
	public function updateTeam($data){		
		foreach ($data as $v){
			$stmt = $this->where(array('D_NAME'=>$v['D_NAME']))->save($v);
			if($stmt === false){
				break;
				return false;
			}
		}
		return true;
	}

}