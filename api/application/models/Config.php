<?php
/**
 * @name 网站设置
 * @author gulei
 */



class ConfigModel {

  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');

  }   
  
  /*获取网站配置*/
  public function get() {
  	$res=$this->_pdo->query('SELECT * FROM xgg_config');
  	return $res->fetchAll(PDO::FETCH_ASSOC);
  }

 
}
