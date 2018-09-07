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

  private function _upload($file) {
    if ($file['error'] > 0){//如果错误抛出错误代码
      $this->errcode=403;
      $this->errmsg=$file['error'];
      return false;
    }else{
      $dir = "../upload/page/";
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
  public function getpages() {
    if(!$this->_isadmin()){return false;}

  	$res=$this->_pdo->query('SELECT id,title,src FROM xgg_page');
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getpage($id){
    if($id==0){
      return array(
        'title'=>'',
        'banner'=>'',
        'content'=>'<p>请编辑内容</p>',
        'keywords'=>'',
        'description'=>''
      );
    }
    $sth=$this->_pdo->prepare('SELECT title,src AS banner,content,keywords,description FROM xgg_page WHERE id=?');
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

  /*编辑*/
  public function add($title,$bannerfile,$content,$keywords,$description) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('INSERT INTO xgg_page (title,content,keywords,description) VALUES (?,?,?,?)');
    $sth->execute(array($title,$content,$keywords,$description));
    $id=$this->_pdo->lastInsertId();
    if($bannerfile){
      $sth=$this->_pdo->prepare('UPDATE xgg_page SET src=? WHERE id=?');
      $sth->execute(array($this->_upload($bannerfile),$id));
    }
    return array('insertid'=>$id);
  }

  public function update($title,$bannerfile,$content,$keywords,$description,$id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('UPDATE xgg_page SET title=?,content=?,keywords=?,description=? WHERE id=?');
    $sth->execute(array($title,$content,$keywords,$description,$id));
    if($bannerfile){
      $sth=$this->_pdo->prepare('UPDATE xgg_page SET src=? WHERE id=?');
      $sth->execute(array($this->_upload($bannerfile),$id));
    }
    return array('updateid'=>$id);
  }
  

  
}
