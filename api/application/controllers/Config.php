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


	/*获取*/
	public function getallAction(){

		$model = new ConfigModel();
		if($res=$model->getall()){
			echo $this->_createJson(0,'',$res);
		}
		return false;
	}

	/*设置*/
	public function updateAction(){
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
