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

  /*权限验证*/
	private function _isAdmin(){

		$model = new ConfigModel();
    return $model->isadmin();
  }


	/*获取全部*/
	public function getallAction(){

		$model = new ConfigModel();
		if($res=$model->getall()){// 获取配置信息
			echo $this->_createJson(0,'',$res);
		}
		return false;
	}

	/*设置*/
	public function updateAction(){

		if(!$this->_isAdmin()){echo $this->_createJson(403,'没有权限');exit();}
		echo $this->_createJson(0,'可以更新');
		// $user_name = $this->getRequest()->getPost("user_name");
		// $pass_word = $this->getRequest()->getPost("pass_word");
		// $eamil = $this->getRequest()->getPost("eamil");
		// $aclist = $this->getRequest()->getPost("action_list")?$this->getRequest()->getPost("action_list"):'ALL';
		
		// $model = new AdminModel();
		// if($res=$model->isuname($user_name)){// 检查用户名是否存在
		// 	echo $this->_createJson(400,'用户名已存在');
		// }else{
		// 	if($res=$model->register($user_name,$pass_word,$eamil,$aclist)){
		// 		echo $this->_createJson(0,'',$res);
		// 	}else{
		// 		echo $this->_createJson(500,'注册信息失败');
		// 	}
		// }
		return false;
	}

}
