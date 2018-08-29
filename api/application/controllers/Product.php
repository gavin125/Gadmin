<?php
/**
 * @name 产品
 * @author gulei
 */

class ProductController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }



	/*获取*/
	public function indexAction(){
		$page = $this->getRequest()->get("page");
		$size = $this->getRequest()->get("size")?$this->getRequest()->get("size"):10;

		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		$model = new ProductModel();
		$products = $model->getproducts($page,$size);
		if(!$products){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$pagination=array(
			'current'=>intval($page),
			'totel'=>ceil($model->gettotel()/$size)
		);

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'products'=>$products,
			'pagination'=>$pagination
		));
		return false;
	}
	

	/*删除*/
	public function delAction(){
		$id = $this->getRequest()->get("id");
		
		$model = new ProductModel();
		if($model->del($id)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}



	
}
