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
    $this->errcode=401;
    $this->errmsg='没有权限';
    return false;
  }


  /*获取*/
  public function getmain() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT id,name,link,parent_id,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('main'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function gettop() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT id,name,link,parent_id,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('top'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getbottom() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT id,name,link,parent_id,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('bottom'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getmobile() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT id,name,link,parent_id,sort FROM xgg_nav WHERE site=? ORDER BY sort');
    $sth->execute(array('mobile'));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getparentOps($id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT id AS value,name AS text FROM xgg_nav WHERE site=? AND id!=? ORDER BY sort');
    $sth->execute(array('main',$id));
    $main=$sth->fetchAll(PDO::FETCH_ASSOC);
    array_unshift($main,array('value'=>'','text'=>'请选择'));

    $sth=$this->_pdo->prepare('SELECT id AS value,name AS text FROM xgg_nav WHERE site=? AND id!=? ORDER BY sort');
    $sth->execute(array('top',$id));
    $top=$sth->fetchAll(PDO::FETCH_ASSOC);
    array_unshift($top,array('value'=>'','text'=>'请选择'));

    $sth=$this->_pdo->prepare('SELECT id AS value,name AS text FROM xgg_nav WHERE site=? AND id!=? ORDER BY sort');
    $sth->execute(array('bottom',$id));
    $bottom=$sth->fetchAll(PDO::FETCH_ASSOC);
    array_unshift($bottom,array('value'=>'','text'=>'请选择'));

    return array(
      'main'=>$main,
      'top'=>$top,
      'bottom'=>$bottom,
    );
  }

  public function getcustomnav($id){
    if($id==0){
      return array(
        'name'=>'',
        'site'=>'main',
        'link'=>'',
        'parent_id'=>'',
        'sort'=>'0'
      );
    }

    $sth=$this->_pdo->prepare('SELECT name,site,link,parent_id,sort FROM xgg_nav WHERE id=?');
    $sth->execute(array($id));
    return $sth->fetch(PDO::FETCH_ASSOC);
  }


  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('DELETE FROM xgg_nav WHERE id=?');
    $sth->execute(array($id));
    return true;
  }

  /*编辑*/
  public function add($parent_id,$name,$site,$link,$sort) {
    if(!$this->_isadmin()){return false;}

    if($parent_id==''){$parent_id=null;}
    $sth=$this->_pdo->prepare('INSERT INTO xgg_nav (parent_id,name,site,link,sort) VALUES (?,?,?,?,?)');
    $sth->execute(array($parent_id,$name,$site,$link,$sort));
    return array('insertid'=>$this->_pdo->lastInsertId());
  }
  public function update($parent_id,$name,$site,$link,$sort,$id) {
    if(!$this->_isadmin()){return false;}

    if($parent_id==''){$parent_id=null;}
    $sth=$this->_pdo->prepare('UPDATE xgg_nav SET parent_id=?,name=?,site=?,link=?,sort=? WHERE id=?');
    $sth->execute(array($parent_id,$name,$site,$link,$sort,$id));
    return array('updateid'=>$id);
  }
}
