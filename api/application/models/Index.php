<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author gulei
 */



class IndexModel {

  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  }   
  
  public function get($id) {
  	$sth=$this->_pdo->prepare('SELECT * FROM xgg_admin WHERE id=?');
  	$sth->execute(array($id));
  	return $sth->fetch(PDO::FETCH_ASSOC);

  }

}
