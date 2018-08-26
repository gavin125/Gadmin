<?php
/**
 * @name 网站设置
 * @author gulei
 */

class ConfigController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }


	public function indexAction(){
		$model = new adminModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);}

		$model = new configModel();
		$defaults = $model->getdefaults();
		if(!$defaults){echo $this->_createJson($model->errcode,$model->errmsg);}
		$mobile = $model->getmobile();
		if(!$mobile){echo $this->_createJson($model->errcode,$model->errmsg);}
		
		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'defaults'=>$defaults,
			'mobile'=>$mobile
		));
		return false;
	}

	/*设置*/
	public function defualtsAction(){
		// $obj=json_decode($this->getRequest()->getPost());
		var_dump($this->getRequest()->getPost());exit();
		$user_name = $this->getRequest()->getPost("user_name");
		
		$model = new ConfigModel();
		if($model->update()){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

}
