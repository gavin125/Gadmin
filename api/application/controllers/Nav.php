<?php
/**
 * @name 导航
 * @author gulei
 */

class NavController extends Yaf_Controller_Abstract {

	/*生成JSON*/
	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }

  /*获取全部*/
	public function indexAction(){
		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);}

		$model = new NavModel();
		$main = $model->getmain();
		if(!$main){echo $this->_createJson($model->errcode,$model->errmsg);}
		$top = $model->gettop();
		if(!$top){echo $this->_createJson($model->errcode,$model->errmsg);}
		$bottom = $model->getbottom();
		if(!$top){echo $this->_createJson($model->errcode,$model->errmsg);}
		$mobile = $model->getmobile();
		if(!$top){echo $this->_createJson($model->errcode,$model->errmsg);}
		
		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'nav'=>array(
				'main'=>$main,
				'top'=>$top,
				'bottom'=>$bottom,
				'mobile'=>$mobile)
		));
		return false;
	}

	/*删除*/
	public function delAction(){
		$id = $this->getRequest()->get("id");
		
		$model = new NavModel();
		if($model->del($id)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	
}
