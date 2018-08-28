<?php
/**
 * @name 文章组
 * @author gulei
 */



class ArticleModel {
  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    return false;
  }

  public function getarticles($page,$size) {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    // $sth=$this->_pdo->query('SELECT a.id,a.src,a.title,b.name AS group,a.add_time,a.click FROM xgg_article AS a,xgg_article_group AS b WHERE a.group_id=b.id LIMIT '.($page-1)*$size.','.$size);
    $sth=$this->_pdo->query('SELECT a.id,a.src,a.title,a.add_time,a.click,b.name FROM xgg_article AS a,xgg_article_group AS b WHERE a.group_id=b.id LIMIT '.($page-1)*$size.','.$size);
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    var_dump($res);exit();
    foreach ($res as $k => $v) {
      foreach ($v as $k1 => $v1) {  
        if($k1=='add_time'){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
      }
    }
    return $res;
  }

  public function gettotel() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->query('SELECT id FROM xgg_article');
    return $sth->rowCount();
  }
  
  

  
}
