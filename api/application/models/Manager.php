<?php
/**
 * @name 管理员信息
 * @author gulei
 */



class ManagerModel {
  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';
  
  private function _addSalt($str,$salt='xiaoguge'){
  	return md5($str.$salt);
  }

  private function _isuname($uname) {
  	$sth=$this->_pdo->prepare('SELECT id FROM xgg_manager WHERE user_name=?');
  	$sth->execute(array($uname));
  	if($sth->fetch(PDO::FETCH_ASSOC)){return true;}
    return false;
  }

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    $this->errcode=401;
    $this->errmsg='没有权限';
    return false;
  }

  public function login($uname,$upw,$ip) {
    if(!$this->_isuname($uname)){ 
      $this->errcode=403;
      $this->errmsg='用户名不存在';
      return false;
    }
  	$sth=$this->_pdo->prepare('SELECT id,user_name FROM xgg_manager WHERE user_name=? AND pass_word=?');
  	$sth->execute(array($uname,$this->_addSalt($upw)));
  	$res=$sth->fetch(PDO::FETCH_ASSOC);
  	if(!$res){
  		$this->errcode=403;
      $this->errmsg='密码不正确';
      return false;
  	}
    $this->_mem->set('uid',$res['id']);
    $this->_mem->set('uname',$res['user_name']);
  	$this->_mem->set('uip',$ip);
    $sth=$this->_pdo->prepare('UPDATE xgg_manager SET last_login=?,last_ip=? WHERE id=?');
    $sth->execute(array(time(),$ip,$res['id']));

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'管理员登录成功',$this->_mem->get('uip')));
    return true;
  }

  public function getname(){
    if(!$this->_isadmin()){return false;}

    return array('uid'=>$this->_mem->get('uid'),'uname'=>$this->_mem->get('uname'));
  }

  public function getmanagers(){
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->query('SELECT id,user_name,email,add_time,last_login FROM xgg_manager');
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $k => $v) {
      foreach ($v as $k1 => $v1) {  
        if($k1=='add_time'||$k1=='last_login'){
          if($v1!=null){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
        }
      }
    }
    return $res;
  }

  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}
    
    $sth=$this->_pdo->prepare('DELETE FROM xgg_manager WHERE id=?');
    $sth->execute(array($id));
    return true;
  }


  public function logout(){
    $this->_mem->delete('uid');
    $this->_mem->delete('uname');
    return true;
  }

  // public function register($uname,$upw,$email,$aclist) {
  // 	$sth=$this->_pdo->prepare('INSERT INTO xgg_admin (user_name,pass_word,email,action_list,add_time) VALUES (?,?,?,?,?)');
  // 	$sth->execute(array($uname,$this->_addSalt($upw),$email,$aclist,time()));
  // 	return array('id'=>$this->_pdo->lastInsertId(),'user_name'=>$uname);
  // }

  


  
}
