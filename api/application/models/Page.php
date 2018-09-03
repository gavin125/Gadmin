<?php
/**
 * @name 单页面
 * @author gulei
 */



class PageModel {
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
  public function getpages() {
    if(!$this->_isadmin()){return false;}

  	$res=$this->_pdo->query('SELECT id,name,src FROM xgg_page');
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getpage($id){
    if($id==0){
      return array(
        'title'=>'',
        'banner'=>'',
        'keywords'=>'',
        'description'=>'',
        'content'=>'<p>请编辑内容</p>'
      );
    }
    $sth=$this->_pdo->prepare('SELECT type,name,link,src,sort FROM xgg_carousel WHERE id=?');
    $sth->execute(array($id));
    $res=$sth->fetch(PDO::FETCH_ASSOC);
    return $res;
  }

  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('DELETE FROM xgg_page WHERE id=?');
    $sth->execute(array($id));
    return true;
  }

  

  
}
