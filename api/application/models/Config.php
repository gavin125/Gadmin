<?php
/**
 * @name 网站设置
 * @author gulei
 */



class ConfigModel {

  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_ses=Yaf_Registry::get('ses');
  }   
  
  /*获取全部*/
  public function getall() {
  	$res=$this->_pdo->query('SELECT * FROM xgg_config');
  	return $res->fetchAll(PDO::FETCH_ASSOC);
  }


  /*检查session*/
  public function isadmin() {
  	if($this->_ses->get('id')){return true;}
  	return false;
  }
 
}
