<?php
/**
 * @name 单页面信息
 * @author gulei
 */

class PageController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }



	/*获取首页列表*/
	public function getindexAction(){

		$model = new PageModel();
		if($res=$model->getindex()){
			echo $this->_createJson(0,'',$res);
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}


	
}
