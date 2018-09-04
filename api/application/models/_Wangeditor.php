<?php
/**
 * @name 编辑器上传图片
 * @author gulei
 */



class _WangeditorModel {
  public function __construct() {
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    $this->errcode=401;
    $this->errmsg='没有权限';
    return false;
  }

  private function _upload($file,$n) {
    if ($file['error'] > 0){//如果错误抛出错误代码
      $this->errcode=403;
      $this->errmsg=$file['error'];
      return false;
    }else{
      $dir = "../upload/editor/";
      if(!file_exists($dir)){mkdir($dir,0777,true);}
      $img_name = explode(".", $file['name']);
      $img_type = '.'.$img_name[count($img_name)-1];
      $newname=$dir.time().$n.$img_type;
      if(!move_uploaded_file($file['tmp_name'],$newname)){
        $this->errcode=403;
        $this->errmsg='存储文件错误';
        return false;
      }
      return 'http://www.gavin.com/Gadmin/api/'.$newname;
    }
  }


  /*上传*/
  public function uploads($files) {
    if(!$this->_isadmin()){return false;}
    $src=array();
    $n=1;
    foreach ($files as $k => $v) {
      array_push($src, $this->_upload($v,'_'.$n++));
    }
    return $src;
  }
  
}
