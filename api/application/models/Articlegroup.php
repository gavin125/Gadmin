<?php
/**
 * @name 文章组
 * @author gulei
 */



class ArticlegroupModel {
  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    return false;
  }

  public function getgroup() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->query('SELECT id,name,parent_id,sort FROM xgg_article_group');
  	// $sth=$this->_pdo->query('SELECT a.id,a.name,a.sort,b.name AS parent FROM xgg_article_group AS a JOIN xgg_article_group AS b ON a.parent_id=b.id');
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  
  

  
}
