<?php
/**
 * @name 文章组
 * @author gulei
 */

class Article_groupController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }



	/*获取*/
	public function indexAction(){
		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);}

		$model = new Article_groupModel();
		$article_group = $model->getgroupgetgroup();
		if(!$article_group){echo $this->_createJson($model->errcode,$model->errmsg);}

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'article_group'=>$article_group
		));
		return false;
	}
	



	
}
