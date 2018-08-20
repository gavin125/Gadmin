<?php
/**
 * @name 管理员信息
 * @author gulei
 */



class AdminModel {


  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_ses=Yaf_Registry::get('ses');
  }   
  
  private function _addSalt($str,$salt='xiaoguge'){
  	return md5($str.$salt);
  }

  public function isuname($uname) {
  	$sth=$this->_pdo->prepare('SELECT id FROM xgg_admin WHERE user_name=?');
  	$sth->execute(array($uname));
  	return $sth->fetch(PDO::FETCH_ASSOC);
  }

  public function login($uname,$upw,$ip) {
  	$sth=$this->_pdo->prepare('SELECT id,user_name FROM xgg_admin WHERE user_name=? AND pass_word=?');
  	$sth->execute(array($uname,$this->_addSalt($upw)));
  	$res=$sth->fetch(PDO::FETCH_ASSOC);
  	if($res){
  		$this->_ses->set('id',$res['id']);
  		$this->_ses->set('uname',$uname);
  		$sth=$this->_pdo->prepare('UPDATE xgg_admin SET last_login=?,last_ip=? WHERE id=?');
  		$sth->execute(array(time(),$ip,$res['id']));
  	}
  	return $res;
  }

  public function register($uname,$upw,$email,$aclist) {
  	$sth=$this->_pdo->prepare('INSERT INTO xgg_admin (user_name,pass_word,email,action_list,add_time) VALUES (?,?,?,?,?)');
  	$sth->execute(array($uname,$this->_addSalt($upw),$email,$aclist,time()));
  	return array('id'=>$this->_pdo->lastInsertId(),'user_name'=>$uname);
  }
}
