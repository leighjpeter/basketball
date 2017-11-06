<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
    public function index(){
        $this->display();
    }

    /**
     * [test PHP Excel]
     * @Author   LEIGHJ
     * @DateTime 2015-09-10T14:52:14+0800
     * @param    [type]
     * @version  v
     * @return   [type]                   [description]
     */
    public function test(){
    	$filePath = __PHY__ . '/aaa.xls';
    	import('Org.Util.PHPExcel');
    	//require_once __PHY_S__.'php\package\lib\PHPExcel/PHPExcel.php';
    	//require_once __PHY_S__.'php\package\lib\PHPExcel\PHPExcel/Writer/Excel2007.php';
    	//创建PHPExcel对象，注意，不能少了\
    	$PHPExcel=new \PHPExcel();
		//如果excel文件后缀名为.xlsx，导入这下类
		//import("Org.Util.PHPExcel.Reader.Excel2007");
		//$PHPReader=new \PHPExcel_Reader_Excel2007();
		$PHPReader=new \PHPExcel_Reader_Excel5();
		//载入文件
		$PHPExcel=$PHPReader->load($filePath);
		//获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
		$currentSheet=$PHPExcel->getSheet(0);
		//获取总列数
		//$allColumn=$currentSheet->getHighestColumn();
		$allColumn='Z';
		//获取总行数
		$allRow=$currentSheet->getHighestRow();	
		$erp_orders_id = array();  //声明数组		
		/**从第二行开始输出，因为excel表中第一行为列名*/
		for($currentRow = 2;$currentRow <= $allRow;$currentRow++){
			for($currentColumn= 'D';$currentColumn <= $allColumn; $currentColumn++){
				if($currentColumn == 'D'||$currentColumn == 'F'||$currentColumn == 'Q'){
					$val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
					if(strlen($val) > 11){
						break;
					}
					if($val !='' ){
						$erp_orders_id[$currentRow][] = $val;
					}
				}
				/**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
				//echo iconv('utf-8','gb2312', $val)."\t";
			}
		}
		dump($erp_orders_id);die;
    	
    }
}