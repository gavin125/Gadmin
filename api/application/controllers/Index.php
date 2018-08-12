<?php
/**
 * @name IndexController
 * @author gulei
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */



class IndexController extends Yaf_Controller_Abstract {
	public function init(){
		
	}

	public function indexAction() {
		return $this->addAction();
	}

	public function addAction(){
		// 检查权限
		if(!$this->_isAdmin()){echo $this->_createJson(401,'没有权限');}
		//获取参数
		$id = $this->getRequest()->getQuery("id");
		//调用Model，返回数据
		$model = new IndexModel();
		if($text=$model->get(1)){
			echo $this->_createJson(0,'',$text);
		}

		return false;
	}


	private function _isAdmin(){
		return true;
	}


	private function _createJson($code, $msg = '', $data = array()){
    if(!is_numeric($code)) {return '';}//如果状态码不是数字就返回空
    //构造返回数据格式数组
    $result = array('errcode' => $code,'errmsg' =>$msg,'data' => $data);
    return json_encode($result,JSON_UNESCAPED_UNICODE);//中文不转码unicode
  }
}
