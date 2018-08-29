<?php
/**
 * @name 单页面
 * @author gulei
 */



class PageModel {
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

  public function getpages() {
    if(!$this->_isadmin()){return false;}

  	$res=$this->_pdo->query('SELECT id,name,src FROM xgg_page');
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('DELETE FROM xgg_page WHERE id=?');
    $sth->execute(array($id));
    return true;
  }

  

  
}
