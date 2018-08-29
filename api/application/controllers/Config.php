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

  /*获取全部*/
	public function indexAction(){
		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		$model = new configModel();
		$PC = $model->getPC();
		if(!$PC){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$H5 = $model->getH5();
		if(!$H5){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		
		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'PC'=>$PC,
			'H5'=>$H5
		));
		return false;
	}

	/*设置1*/
	public function PCAction(){
		$on_off = $this->getRequest()->getPost("on_off");
		$title = $this->getRequest()->getPost("title");
		$keywords = $this->getRequest()->getPost("keywords");
		$description = $this->getRequest()->getPost("description");
		$address = $this->getRequest()->getPost("address");
		$icp = $this->getRequest()->getPost("icp");
		$tel = $this->getRequest()->getPost("tel");
		$email = $this->getRequest()->getPost("email");
		$code = $this->getRequest()->getPost("code");

		$logofile=$this->getRequest()->getFiles('logofile');
		
		$model = new ConfigModel();
		if($model->setPC($on_off,$title,$keywords,$description,$address,$icp,$tel,$email,$code,$logofile)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	/*设置2*/
	public function displayAction(){
		$display=$this->getRequest()->getPost('display');

		$model = new ConfigModel();
		if($model->setdisplay($display)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	/*设置3*/
	public function H5Action(){
		$on_off = $this->getRequest()->getPost("on_off");
		$title = $this->getRequest()->getPost("title");
		$keywords = $this->getRequest()->getPost("keywords");
		$description = $this->getRequest()->getPost("description");
		$display=$this->getRequest()->getPost('display');

		$logofile=$this->getRequest()->getFiles('logofile');
		
		$model = new ConfigModel();
		if($model->setH5($on_off,$title,$keywords,$description,$display,$logofile)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}
}
