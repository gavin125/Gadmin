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

  public function indexAction() {

		$model = new adminModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);}

		$model = new pageModel();
		$pages = $model->getindex();
		if(!$pages){echo $this->_createJson($model->errcode,$model->errmsg);}

		$model = new _websiteModel();
		$total = $model->gettotal();
		if(!$total){echo $this->_createJson($model->errcode,$model->errmsg);}
		$server = $model->getserver();
		if(!$server){echo $this->_createJson($model->errcode,$model->errmsg);}

		$model = new logModel();
		$login_log = $model->getloginlog();
		if(!$login_log){echo $this->_createJson($model->errcode,$model->errmsg);}

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'pages'=>$pages,
			'total'=>$total,
			'server'=>$server,
			'login_log'=>$login_log,
		));
		return false;
	}

	
}
