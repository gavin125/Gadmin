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
    return false;
  }


  /*获取*/
  public function getPC() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT id,name,link,src,sort FROM xgg_carousel WHERE type=? ORDER BY sort');
    $sth->execute(array('PC'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getH5() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT id,name,link,src,sort FROM xgg_carousel WHERE type=? ORDER BY sort');
    $sth->execute(array('H5'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }



  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('DELETE FROM xgg_carousel WHERE id=?');
    $sth->execute(array($id));
    return true;
  }

  /*编辑*/
  
 
}
