<?php
/**
 * @name 编辑器上传图片
 * @author gulei
 */

class WangeditorController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errno' => $code,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }




	public function indexAction(){

		$files = $this->getRequest()->getFiles();

		$model = new _WangeditorModel();
		$src = $model->uploads($files);
		if(!$src){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		echo $this->_createJson(0,'',$src);
		return false;
	}

	
	
}
