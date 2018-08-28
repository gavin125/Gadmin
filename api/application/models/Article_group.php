<?php
/**
 * @name 文章组
 * @author gulei
 */



class Article_groupModel {
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
  	$sth=$this->_pdo->query('SELECT ag1.id,ag1.name,ag1.sort,ag2.name AS parent FROM xgg_article_group AS ag1 INNER JOIN xgg_article_group AS ag2 ON ag1.id = ag2.parent_id');
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  
  

  
}
