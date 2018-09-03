<?php
/**
 * @name 轮播图
 * @author gulei
 */



class CarouselModel {

  public function __construct() {
    $this->_pdo=Yaf_Registry::get('pdo');
    $this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    $this->errcode=401;
    $this->errmsg='没有权限';
    return false;
  }

  private function _upload($file) {
    if ($file['error'] > 0){//如果错误抛出错误代码
      $this->errcode=403;
      $this->errmsg=$file['error'];
      return false;
    }else{
      $dir = "../upload/carousel/";
      if(!file_exists($dir)){mkdir($dir,0777,true);}
      $img_name = explode(".", $file['name']);
      $img_type = '.'.$img_name[count($img_name)-1];
      if(!move_uploaded_file($file['tmp_name'],$dir.time().$img_type)){
        $this->errcode=403;
        $this->errmsg='存储文件错误';
        return false;
      }
      return $dir.time().$img_type;
    }
  }


  /*获取*/
  public function getPC() {
    $sth=$this->_pdo->prepare('SELECT id,name,link,src,sort FROM xgg_carousel WHERE type=? ORDER BY sort');
    $sth->execute(array('PC'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getH5() {
    $sth=$this->_pdo->prepare('SELECT id,name,link,src,sort FROM xgg_carousel WHERE type=? ORDER BY sort');
    $sth->execute(array('H5'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getcarousel($id){
    if($id==0){
      return array(
        'type'=>'PC',
        'name'=>'',
        'link'=>'',
        'src'=>'',
        'sort'=>'0'
      );
    }
    $sth=$this->_pdo->prepare('SELECT type,name,link,src,sort FROM xgg_carousel WHERE id=?');
    $sth->execute(array($id));
    $res=$sth->fetch(PDO::FETCH_ASSOC);
    return $res;
  }



  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('DELETE FROM xgg_carousel WHERE id=?');
    $sth->execute(array($id));
    return true;
  }

  /*编辑*/
  public function add($type,$name,$link,$srcfile,$sort) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('INSERT INTO xgg_carousel (type,name,link,sort) VALUES (?,?,?,?)');
    $sth->execute(array($type,$name,$link,$sort));
    $id=$this->_pdo->lastInsertId();
    if($srcfile){
      $sth=$this->_pdo->prepare('UPDATE xgg_carousel SET src=? WHERE id=?');
      $sth->execute(array($this->_upload($srcfile),$id));
    }
    return array('insertid'=>$id);
  }

  public function update($type,$name,$link,$srcfile,$sort,$id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('UPDATE xgg_carousel SET type=?,name=?,link=?,sort=? WHERE id=?');
    $sth->execute(array($type,$name,$link,$sort,$id));
    if($srcfile){
      $sth=$this->_pdo->prepare('UPDATE xgg_carousel SET src=? WHERE id=?');
      $sth->execute(array($this->_upload($srcfile),$id));
    }
    return array('updateid'=>$id);
  }
  
  
 
}
