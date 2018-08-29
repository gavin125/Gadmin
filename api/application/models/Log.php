<?php
/**
 * @name 日志
 * @author gulei
 */



class LogModel {
  public function __construct() {
  	$this->_pdo=Yaf_Registry::get('pdo');
  	$this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    $this->errcode=401;
    $this->errmsg='没有权限';
    return false;
  }

  public function getlogs($page,$size) {
    if(!$this->_isadmin()){return false;}

  	$sth=$this->_pdo->prepare('SELECT l.id,l.add_time,l.action,m.user_name,l.last_ip FROM xgg_log AS l,xgg_manager AS m WHERE l.user_id=m.id AND l.user_id=? LIMIT '.($page-1)*$size.','.$size);
    $sth->execute(array($this->_mem->get('uid')));
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $k => $v) {
      foreach ($v as $k1 => $v1) {  
        if($k1=='add_time'){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
      }
    }
    return $res;
  }

  public function gettotel() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->query('SELECT id FROM xgg_log');
    return $sth->rowCount();
  }

  public function getloginlog(){
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT add_time,last_ip FROM xgg_log WHERE action=? AND user_id=? LIMIT 3');
    $sth->execute(array('管理员登录成功',$this->_mem->get('uid')));
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $k => $v) {
      foreach ($v as $k1 => $v1) {  
        if($k1=='add_time'){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
      }
    }
    return $res;
  }
  

  
}
