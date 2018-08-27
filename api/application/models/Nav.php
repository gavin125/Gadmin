<?php
/**
 * @name 导航
 * @author gulei
 */



class NavModel {

  public function __construct() {
    $this->_pdo=Yaf_Registry::get('pdo');
    $this->_mem=Yaf_Registry::get('mem');
  }

  public $errcode=0,$errmsg='';

  private function _isadmin() {
    if($this->_mem->get('uid')){return true;}
    return false;
  }


  /*获取*/
  public function getmain() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT * FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('main'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function gettop() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT * FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('top'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getbottom() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT * FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('bottom'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getmobile() {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('SELECT * FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('mobile'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }



  /*编辑*/
  public function setPC($on_off,$title,$keywords,$description,$address,$icp,$tel,$email,$code,$logofile) {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('UPDATE xgg_config SET on_off=?,title=?,keywords=?,description=?,address=?,icp=?,tel=?,email=?,code=? WHERE id=?');
    $sth->execute(array($on_off,$title,$keywords,$description,$address,$icp,$tel,$email,$code,1));//1PC
    if($logofile){
      $sth=$this->_pdo->prepare('UPDATE xgg_config SET logo=? WHERE id=?');
      $sth->execute(array($this->_upload($logofile),1));//1PC
    }

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_admin_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'编辑PC配置',$this->_mem->get('uip')));
    return true;
  }

  public function setdisplay($display){
    $sth=$this->_pdo->prepare('UPDATE xgg_config SET display=? WHERE id=?');
    $sth->execute(array($display,1));//1PC

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_admin_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'编辑显示配置',$this->_mem->get('uip')));
  }

  public function setH5($on_off,$title,$keywords,$description,$display,$logofile) {
    if(!$this->_isadmin()){
      $this->errcode=403;
      $this->errmsg='没有权限';
      return false;
    }
    $sth=$this->_pdo->prepare('UPDATE xgg_config SET on_off=?,title=?,keywords=?,description=?,display=? WHERE id=?');
    $sth->execute(array($on_off,$title,$keywords,$description,$display,2));//1PC
    if($logofile){
      $sth=$this->_pdo->prepare('UPDATE xgg_config SET logo=? WHERE id=?');
      $sth->execute(array($this->_upload($logofile),2));//2H5
    }

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_admin_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'编辑H5配置',$this->_mem->get('uip')));
    return true;
  }
 
}
