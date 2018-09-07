<?php
/**
 * @name 产品
 * @author gulei
 */


class ProductModel {
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
      $dir = "../upload/product/";
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


  public function getproducts($page,$size,$group_id='',$text='') {
    if(!$this->_isadmin()){return false;}
    $SQLSTR='TRUE';
    if($group_id!=''){ $SQLSTR.=' AND a.group_id='.$group_id;}
    if($text!=''){ $SQLSTR.=' AND a.title LIKE "%'.$text.'%"';}
    
    $sth=$this->_pdo->query('SELECT a.id,a.src,a.title,a.add_time,a.sort,b.name FROM xgg_product AS a LEFT JOIN xgg_product_group AS b ON a.group_id=b.id WHERE '.$SQLSTR.' LIMIT '.($page-1)*$size.','.$size);
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $k => $v) {
      foreach ($v as $k1 => $v1) {  
        if($k1=='add_time'){$res[$k][$k1]=date("Y-m-d H:i:s", $v1);}
      }
    }
    return $res;
  }

  public function getproduct($id){
    if($id==0){
      return array(
        'group_id'=>'',
        'title'=>'',
        'content'=>'<p>请编辑内容</p>',
        'image'=>'',
        'keywords'=>'',
        'description'=>'',
        'sort'=>'0'
      );
    }
    $sth=$this->_pdo->prepare('SELECT group_id,title,content,src AS image,keywords,description,sort FROM xgg_product WHERE id=?');
    $sth->execute(array($id));
    $res=$sth->fetch(PDO::FETCH_ASSOC);
    if($res['group_id']===NULL){$res['group_id']='';}
    return $res;
  }


  public function gettotel($group_id='',$text='') {
    if(!$this->_isadmin()){return false;}
    $SQLSTR='TRUE';
    if($group_id!=''){ $SQLSTR.=' AND group_id='.$group_id;}
    if($text!=''){ $SQLSTR.=' AND title LIKE "%'.$text.'%"';}

    $sth=$this->_pdo->query('SELECT id FROM xgg_product WHERE '.$SQLSTR);
    return $sth->rowCount();
  }

  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}
    
    $sth=$this->_pdo->prepare('DELETE FROM xgg_product WHERE id=?');
    $sth->execute(array($id));
    return true;
  }
  

  /*批量*/
  public function execute($action,$group,$checked){
    if(!$this->_isadmin()){return false;}

    $checked=json_decode($checked);
    if($action=='1'){
      foreach ($checked as $k => $v) {
        $sth=$this->_pdo->prepare('DELETE FROM xgg_product WHERE id=?');
        $sth->execute(array($v));
      }
    }
    if($action=='2'){
      if($group==''){$group=null;}
      foreach ($checked as $k => $v) {
        $sth=$this->_pdo->prepare('UPDATE xgg_product SET group_id=?  WHERE id=?');
        $sth->execute(array($group,$v));
      }
    }
    return true;
  }

  /*编辑*/
  public function add($group_id,$title,$content,$imagefile,$keywords,$description,$sort) {
    if(!$this->_isadmin()){return false;}

    if($group_id==''){$group_id=null;}
    $sth=$this->_pdo->prepare('INSERT INTO xgg_product (group_id,title,content,keywords,description,add_time,sort) VALUES (?,?,?,?,?,?,?)');
    $sth->execute(array($group_id,$title,$content,$keywords,$description,time(),$sort));
    $id=$this->_pdo->lastInsertId();
    if($imagefile){
      $sth=$this->_pdo->prepare('UPDATE xgg_product SET src=? WHERE id=?');
      $sth->execute(array($this->_upload($imagefile),$id));
    }
    return array('insertid'=>$id);
  }

  public function update($group_id,$title,$content,$imagefile,$keywords,$description,$sort,$id) {
    if(!$this->_isadmin()){return false;}

    if($group_id==''){$group_id=null;}
    $sth=$this->_pdo->prepare('UPDATE xgg_product SET group_id=?,title=?,content=?,keywords=?,description=?,sort=? WHERE id=?');
    $sth->execute(array($group_id,$title,$content,$keywords,$description,$sort,$id));
    if($imagefile){
      $sth=$this->_pdo->prepare('UPDATE xgg_product SET src=? WHERE id=?');
      $sth->execute(array($this->_upload($imagefile),$id));
    }
    return array('updateid'=>$id);
  }
  

  
}
