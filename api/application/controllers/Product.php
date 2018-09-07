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
		$group = $this->getRequest()->get("group");
		$text = $this->getRequest()->get("text");

		$model = new managerModel();
		$manager = $model->getname();
		if(!$manager){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		$model = new ProductModel();
		$products = $model->getproducts($page,$size,$group,$text);
		if(!$products && is_bool($products)){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
		$pagination=array(
			'current'=>intval($page),
			//当数据为空时，设置为1
			'totel'=>count($products)==0?1:ceil($model->gettotel($group,$text)/$size)
		);
		
		$model = new ProductgroupModel();
		$groupOps = $model->getgroupOps();
		if(!$groupOps){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'products'=>$products,
			'pagination'=>$pagination,
			'groupOps'=>$groupOps
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

	/*批量*/
	public function executeAction(){
		$action = $this->getRequest()->get("action");
		$group = $this->getRequest()->get("group");
		$checked = $this->getRequest()->get("checked");

		$model = new ProductModel();
		if($model->execute($action,$group,$checked)){
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

    $model = new ProductgroupModel();
    $groupOps= $model->getgroupOps();
    if(!$groupOps){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

    $model = new ProductModel();
    $product= $model->getproduct($id);

    if(!$product){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

    echo $this->_createJson(0,'',array(
      'manager'=>$manager,
      'groupOps'=>$groupOps,
      'product'=>$product,
    ));
    return false;
  }

  /*编辑*/
  public function editAction(){
    $id = $this->getRequest()->get("id");

    $group_id = $this->getRequest()->getPost("group_id");
    $title = $this->getRequest()->getPost("title");
    $content = $this->getRequest()->getPost("content");
    $imagefile = $this->getRequest()->getFiles("imagefile");
    $keywords = $this->getRequest()->getPost("keywords");
    $description = $this->getRequest()->getPost("description");
    $sort = $this->getRequest()->getPost("sort");
    
    $model = new ProductModel();
    if($id==0){//新增
      $res= $model->add($group_id,$title,$content,$imagefile,$keywords,$description,$sort);
      if(!$res){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
    }else{//更新
      $res= $model->update($group_id,$title,$content,$imagefile,$keywords,$description,$sort,$id);
      if(!$res){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
    }
    echo $this->_createJson(0,'',$res);
    return false;
  }

	
}
