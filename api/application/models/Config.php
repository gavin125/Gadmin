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
    $this->errcode=401;
    $this->errmsg='没有权限';
    return false;
  }

  private function _upload($file) {
    if ($file['error'] > 0){//如果错误抛出错误代码
      $this->errcode=403;
      $this->errmsg=$file['error'];
      return false;
    }else{
      $dir = "../upload/";
      if(!file_exists($dir)){mkdir($dir,0777,true);}
      $img_name = explode(".", $file['name']);
      $img_type = '.'.$img_name[count($img_name)-1];
      $newname=$dir.time().$img_type;
      if(!move_uploaded_file($file['tmp_name'],$newname)){
        $this->errcode=403;
        $this->errmsg='存储文件错误';
        return false;
      }
      return 'http://www.gavin.com/Gadmin/api/'.$newname;
    }
  }

  /*获取*/
  public function getPC() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT * FROM xgg_config WHERE id=?');
    $sth->execute(array(1));//1PC
    return $sth->fetch(PDO::FETCH_ASSOC);
  }

  public function getH5() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT * FROM xgg_config WHERE id=?');
    $sth->execute(array(2));//2H5
    return $sth->fetch(PDO::FETCH_ASSOC);
  }

  /*编辑*/
  public function setPC($on_off,$title,$keywords,$description,$address,$icp,$tel,$email,$code,$logofile) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('UPDATE xgg_config SET on_off=?,title=?,keywords=?,description=?,address=?,icp=?,tel=?,email=?,code=? WHERE id=?');
    $sth->execute(array($on_off,$title,$keywords,$description,$address,$icp,$tel,$email,$code,1));//1PC
    if($logofile){
      $sth=$this->_pdo->prepare('UPDATE xgg_config SET logo=? WHERE id=?');
      $sth->execute(array($this->_upload($logofile),1));//1PC
    }

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'编辑PC配置',$this->_mem->get('uip')));
    return true;
  }

  public function setdisplay($display){
    $sth=$this->_pdo->prepare('UPDATE xgg_config SET display=? WHERE id=?');
    $sth->execute(array($display,1));//1PC

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'编辑显示配置',$this->_mem->get('uip')));
  }

  public function setH5($on_off,$title,$keywords,$description,$display,$logofile) {
    if(!$this->_isadmin()){return false;}
    
    $sth=$this->_pdo->prepare('UPDATE xgg_config SET on_off=?,title=?,keywords=?,description=?,display=? WHERE id=?');
    $sth->execute(array($on_off,$title,$keywords,$description,$display,2));//1PC
    if($logofile){
      $sth=$this->_pdo->prepare('UPDATE xgg_config SET logo=? WHERE id=?');
      $sth->execute(array($this->_upload($logofile),2));//2H5
    }

    // 添加日志
    $sth=$this->_pdo->prepare('INSERT INTO xgg_log (user_id,add_time,action,last_ip) VALUES (?,?,?,?)');
    $sth->execute(array($this->_mem->get('uid'),time(),'编辑H5配置',$this->_mem->get('uip')));
    return true;
  }
 
}
