<?php
/**
 * @name 管理员信息
 * @author gulei
 */

class ManagerController extends Yaf_Controller_Abstract {

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
		$managers = $model->getmanagers();
		if(!$managers){echo $this->_createJson($model->errcode,$model->errmsg);}

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'managers'=>$managers
		));
		return false;
	}

	/*删除*/
	public function delAction(){
		$id = $this->getRequest()->get("id");

		$model = new managerModel();
		if($model->del($id)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}
	

	/*登录*/
	public function loginAction(){

		$user_name = $this->getRequest()->getPost("user_name");
		$pass_word = $this->getRequest()->getPost("pass_word");
		$ip=$this->getRequest()->getServer('REMOTE_ADDR');
		
		$model = new managerModel();
		if($model->login($user_name,$pass_word,$ip)){
			echo $this->_createJson(0,'');
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}


	/*获取信息*/
	public function getnameAction(){
		
		$model = new managerModel();
		if($res=$model->getname()){
			echo $this->_createJson(0,'',$res);
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	/*获取信息*/
	public function logoutAction(){
		
		$model = new managerModel();
		if($res=$model->logout()){
			echo $this->_createJson(0,'',$res);
		}else{
			echo $this->_createJson($model->errcode,$model->errmsg);
		}
		return false;
	}

	/*注册*/
	// public function registerAction(){

	// 	$user_name = $this->getRequest()->getPost("user_name");
	// 	$pass_word = $this->getRequest()->getPost("pass_word");
	// 	$eamil = $this->getRequest()->getPost("eamil");
	// 	$aclist = $this->getRequest()->getPost("action_list")?$this->getRequest()->getPost("action_list"):'ALL';
		
	// 	$model = new AdminModel();
	// 	if($res=$model->isuname($user_name)){// 检查用户名是否存在
	// 		echo $this->_createJson(400,'用户名已存在');
	// 	}else{
	// 		if($res=$model->register($user_name,$pass_word,$eamil,$aclist)){
	// 			echo $this->_createJson(0,'',$res);
	// 		}else{
	// 			echo $this->_createJson(500,'注册信息失败');
	// 		}
	// 	}
	// 	return false;
	// }

}
