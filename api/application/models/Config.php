<?php
/**
 * @name 网站设置
 * @author gulei
 */



class ConfigModel {

  public function __construct() {
    $this->_pdo=Yaf_Registry::get('pdo');
    $this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    return false;
  }

  /*获取全部*/
  public function getall() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $res=$this->_pdo->query('SELECT * FROM xgg_config WHERE module=1')->fetchAll(PDO::FETCH_ASSOC);
    $defaults=array();
    foreach ($res as $k => $v) {$defaults[$v['name']]=$v['value'];}
    $display=$this->_pdo->query('SELECT value FROM xgg_config WHERE module=2')->fetch(PDO::FETCH_ASSOC);
  	$res=$this->_pdo->query('SELECT * FROM xgg_config WHERE module=3')->fetchAll(PDO::FETCH_ASSOC);
    $mobile=array();
    foreach ($res as $k => $v) {$mobile[$v['name']]=$v['value'];}
  	return array('defaults'=>$defaults,'display'=>$display,'mobile'=>$mobile);
  }
 
}
