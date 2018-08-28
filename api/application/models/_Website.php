<?php
/**
 * @name 管理员信息
 * @author gulei
 */



class _WebsiteModel {
  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    return false;
  }

  public function gettotel() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
  	$res['name']=$this->_pdo->query('SELECT title FROM xgg_config WHERE id=1')->fetch(PDO::FETCH_ASSOC)['title'];
    $res['num_log']=$this->_pdo->query('SELECT * FROM xgg_log')->rowCount();
    $res['num_page']=$this->_pdo->query('SELECT * FROM xgg_page')->rowCount();
    $res['num_article']=$this->_pdo->query('SELECT * FROM xgg_article')->rowCount();
    $res['num_article_group']=$this->_pdo->query('SELECT * FROM xgg_article_group')->rowCount();
    $res['num_product']=$this->_pdo->query('SELECT * FROM xgg_product')->rowCount();
    $res['num_product_group']=$this->_pdo->query('SELECT * FROM xgg_product_group')->rowCount();
    return $res;
  }

  public function getserver(){
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $res['php_ver']=PHP_VERSION;
    $res['mysql_ver']=$this->_pdo->query('SELECT VERSION()')->fetch(PDO::FETCH_ASSOC)['VERSION()'];
    $res['server_ver']=apache_get_version();
    $res['os_ip'] = PHP_OS.'('.$_SERVER['SERVER_ADDR'].')';
    $res['max_filesize'] = ini_get('upload_max_filesize');
    return $res;
  }

  

  
}
