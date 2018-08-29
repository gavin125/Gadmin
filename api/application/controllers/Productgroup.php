<?php
/**
 * @name 产品组
 * @author gulei
 */

class ProductgroupController extends Yaf_Controller_Abstract {

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
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		$model = new ProductgroupModel();
		$product_group = $model->getgroup();
		if(!$product_group){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'product_group'=>$product_group
		));
		return false;
	}
	
	/*删除*/
	public function delAction(){
		$id = $this->getRequest()->get("id");
		
		$model = new ProductgroupModel();
		if($model->del($id)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}


	
}
