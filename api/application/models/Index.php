<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author gulei
 */



class IndexModel {

  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    return false;
  }
  
  public function getwebsite() {
  	if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
  	$res['name']=$this->_pdo->query('SELECT value FROM xgg_config WHERE id=1')->fetch(PDO::FETCH_ASSOC)['value'];
  	$res['num_log']=$this->_pdo->query('SELECT * FROM xgg_admin_log')->rowCount();
  	$res['num_page']=$this->_pdo->query('SELECT * FROM xgg_page')->rowCount();
  	$res['num_article']=$this->_pdo->query('SELECT * FROM xgg_article')->rowCount();
  	$res['num_article_group']=$this->_pdo->query('SELECT * FROM xgg_article_group')->rowCount();
  	$res['num_product']=$this->_pdo->query('SELECT * FROM xgg_product')->rowCount();
  	$res['num_product_group']=$this->_pdo->query('SELECT * FROM xgg_product_group')->rowCount();

  	$res['php_ver']=PHP_VERSION;
  	$res['mysql_ver']=mysql_get_server_info();
  	$res['server_ver']=apache_get_version();
  	$res['os_ip'] = PHP_OS.'('.$_SERVER['SERVER_ADDR'].')';
  	$res['max_filesize'] = ini_get('upload_max_filesize');

  	return $res;
  }

  public function getloginlog(){
  	if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $res=$this->_pdo->query('SELECT add_time,last_ip FROM xgg_admin_log ORDER BY add_time DESC LIMIT 3')->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $k => $v) {
    	foreach ($v as $k1 => $v1) {
    		if($k1=='add_time'){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
    	}
    }
    return $res;
  }

}
