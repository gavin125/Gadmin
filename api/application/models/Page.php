<?php
/**
 * @name 管理员信息
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
    return false;
  }

  public function getindex() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
  	$res=$this->_pdo->query('SELECT id,name FROM xgg_page');
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  

  
}
