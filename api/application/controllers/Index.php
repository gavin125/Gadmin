<?php
/**
 * @name IndexController
 * @author gulei
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */



class IndexController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }

	public function getwebsiteAction() {

		$model = new IndexModel();
		if($res=$model->getwebsite()){
			echo $this->_createJson(0,'',$res);
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	public function getloginlogAction() {

		$model = new IndexModel();
		if($res=$model->getloginlog()){
			echo $this->_createJson(0,'',$res);
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	
}
