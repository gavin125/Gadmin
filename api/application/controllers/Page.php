<?php
/**
 * @name 单页面
 * @author gulei
 */

class PageController extends Yaf_Controller_Abstract {

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

		$model = new PageModel();
		$pages = $model->getpages();
		if(!$pages){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

		echo $this->_createJson(0,'',array(
			'manager'=>$manager,
			'pages'=>$pages
		));
		return false;
	}

	/*删除*/
	public function delAction(){
		$id = $this->getRequest()->get("id");

		$model = new PageModel();
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

    $model = new PageModel();
    $page= $model->getpage($id);
    if(!$page){echo $this->_createJson($model->errcode,$model->errmsg);exit();}

    echo $this->_createJson(0,'',array(
      'manager'=>$manager,
      'page'=>$page,
    ));
    return false;
  }

  /*编辑*/
  public function editAction(){
    $id = $this->getRequest()->get("id");

    $title = $this->getRequest()->getPost("title");
    $bannerfile = $this->getRequest()->getFiles("bannerfile");
    $content = $this->getRequest()->getPost("content");
    $keywords = $this->getRequest()->getPost("keywords");
    $description = $this->getRequest()->getPost("description");
    

    $model = new PageModel();
    if($id==0){//新增
      $res= $model->add($title,$bannerfile,$content,$keywords,$description);
      if(!$res){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
    }else{//更新
      $res= $model->update($title,$bannerfile,$content,$keywords,$description,$id);
      if(!$res){echo $this->_createJson($model->errcode,$model->errmsg);exit();}
    }
    echo $this->_createJson(0,'',$res);
    return false;
  }
	
}
