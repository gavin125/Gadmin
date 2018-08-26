<?php
/**
 * @name 网站操作日志
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
    return false;
  }

  /*获取登陆*/
  public function getloginlog() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT add_time,last_ip FROM xgg_admin_log WHERE user_id=? ORDER BY add_time DESC LIMIT 3');
    $sth->execute(array($this->_mem->get('uid')));
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $k => $v) {
      foreach ($v as $k1 => $v1) {
        if($k1=='add_time'){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
      }
    }
    return $res;
  }
 
}
