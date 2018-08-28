<?php
/**
 * @name 导航
 * @author gulei
 */



class NavModel {

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
  public function getmain() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT id,name,link,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('main'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function gettop() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT id,name,link,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('top'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getbottom() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT id,name,link,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('bottom'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getmobile() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT id,name,link,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('mobile'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }


  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('DELETE FROM xgg_nav WHERE id=?');
    $sth->execute(array($id));
    return true;
  }

  /*编辑*/
  
 
}
