<?php
/**
 * @name 产品组
 * @author gulei
 */



class ProductgroupModel {
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

  private function _haschild($id) {
    $sth=$this->_pdo->prepare('SELECT parent_id FROM xgg_product WHERE parent_id=?');
    $res=$sth->execute(array($id));
    if(!$res){ return true;}
    $this->errcode=403;
    $this->errmsg='该分类包含文章';
    return false;
  }

  public function getgroups() {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->query('SELECT id,name,parent_id,sort FROM xgg_product_group');
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getparentOps($id) {
    if(!$this->_isadmin()){return false;}

    $sth=$this->_pdo->prepare('SELECT id AS value,name AS text FROM xgg_product_group WHERE id!=? ORDER BY sort');
    $sth->execute(array($id));
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    array_unshift($res,array('value'=>'','text'=>'请选择'));

    return $res;
  }

  public function getproductgroup($id){
    if($id==0){
      return array(
        'name'=>'',
        'parent_id'=>'',
        'sort'=>'0'
      );
    }
    $sth=$this->_pdo->prepare('SELECT name,parent_id,sort FROM xgg_product_group WHERE id=?');
    $sth->execute(array($id));
    $res=$sth->fetch(PDO::FETCH_ASSOC);
    if($res['parent_id']===NULL){$res['parent_id']='';}
    return $res;
  }


  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}
    if(!$this->_haschild($id)){return false;}

    $sth=$this->_pdo->prepare('DELETE FROM xgg_product_group WHERE id=?');
    $sth->execute(array($id));
    return true;
  }
  
  /*编辑*/
  public function add($name,$parent_id,$sort) {
    if(!$this->_isadmin()){return false;}
    
    if($parent_id==''){$parent_id=null;}
    $sth=$this->_pdo->prepare('INSERT INTO xgg_product_group (name,parent_id,sort) VALUES (?,?,?)');
    $sth->execute(array($name,$parent_id,$sort));
    return array('insertid'=>$this->_pdo->lastInsertId());
  }
  public function update($name,$parent_id,$sort,$id) {
    if(!$this->_isadmin()){return false;}

    if($parent_id==''){$parent_id=null;}
    $sth=$this->_pdo->prepare('UPDATE xgg_product_group SET name=?,parent_id=?,sort=? WHERE id=?');
    $sth->execute(array($name,$parent_id,$sort,$id));
    return array('updateid'=>$id);
  }
  

  
}
