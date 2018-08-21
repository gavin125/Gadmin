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

  public $errcode=0,$errmsg='';
  
  private function _addSalt($str,$salt='xiaoguge'){
  	return md5($str.$salt);
  }

  private function _isuname($uname) {
  	$sth=$this->_pdo->prepare('SELECT id FROM xgg_admin WHERE user_name=?');
  	$sth->execute(array($uname));
  	if($sth->fetch(PDO::FETCH_ASSOC)){return true;}
    return false;
  }

  private function _isadmin() {
    if($this->_ses->get('id')){return true;}
    return false;
  }

  public function login($uname,$upw,$ip) {
    if(!$this->_isuname($uname)){ 
      $this->errcode=400;
      $this->errmsg='用户名不存在';
      return false;
    }
  	$sth=$this->_pdo->prepare('SELECT id,user_name FROM xgg_admin WHERE user_name=? AND pass_word=?');
  	$sth->execute(array($uname,$this->_addSalt($upw)));
  	$res=$sth->fetch(PDO::FETCH_ASSOC);
  	if(!$res){
  		$this->errcode=403;
      $this->errmsg='密码不正确';
      return false;
  	}
  	$this->_ses->set('id',$res['id']);
    $this->_ses->set('uname',$uname);
    $sth=$this->_pdo->prepare('UPDATE xgg_admin SET last_login=?,last_ip=? WHERE id=?');
    $sth->execute(array(time(),$ip,$res['id']));
    return true;
  }

  public function get(){
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $id=$this->_ses->get('id');
    $sth=$this->_pdo->prepare('SELECT * FROM xgg_admin WHERE id=?');
    $sth->execute(array($id));
    $res=$sth->fetch(PDO::FETCH_ASSOC);
    if(!$res){
      $this->errcode=403;
      $this->errmsg='id不争取';
      return false;
    }
  }

  // public function register($uname,$upw,$email,$aclist) {
  // 	$sth=$this->_pdo->prepare('INSERT INTO xgg_admin (user_name,pass_word,email,action_list,add_time) VALUES (?,?,?,?,?)');
  // 	$sth->execute(array($uname,$this->_addSalt($upw),$email,$aclist,time()));
  // 	return array('id'=>$this->_pdo->lastInsertId(),'user_name'=>$uname);
  // }

  


  
}
