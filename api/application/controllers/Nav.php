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

  /*获取列表*/
	public function indexAction(){
		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		$model = new NavModel();
		$main = $model->getmain();
		if(!$main){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$top = $model->gettop();
		if(!$top){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$bottom = $model->getbottom();
		if(!$top){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$mobile = $model->getmobile();
		if(!$top){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		
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

	/*获取配置*/
	public function prepareAction(){
		$id = $this->getRequest()->get("id");

		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		$model = new NavModel();
		$parentOps= $model->getparentOps($id);
		if(!$parentOps){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$customnav=$model->getcustomnav($id);

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'parentOps'=>$parentOps,
			'customnav'=>$customnav,
		));
		return false;
	}

	/*编辑*/
	public function editAction(){
		$id = $this->getRequest()->get("id");


		$parent_id = $this->getRequest()->getPost("parent_id");
		$name = $this->getRequest()->getPost("name");
		$site = $this->getRequest()->getPost("site");
		$link = $this->getRequest()->getPost("link");
		$sort = $this->getRequest()->getPost("sort");

		$model = new NavModel();
		if($id==0){//新增
			$res= $model->add($parent_id,$name,$site,$link,$sort);
			if(!$res){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		}else{//更新
			$res= $model->update($parent_id,$name,$site,$link,$sort,$id);
			if(!$res){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		}
		echo $this->_createJson(0,'',$res);
		return false;
	}

}
