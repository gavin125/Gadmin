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

  public function getproducts($page,$size) {
    if(!$this->_isadmin()){return false;}


    $sth=$this->_pdo->query('SELECT a.id,a.src,a.title,a.add_time,a.sort,b.name FROM xgg_product AS a LEFT JOIN xgg_product_group AS b ON a.group_id=b.id LIMIT '.($page-1)*$size.','.$size);
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

    $sth=$this->_pdo->query('SELECT id FROM xgg_product');
    return $sth->rowCount();
  }

  /*删除*/
  public function del($id) {
    if(!$this->_isadmin()){return false;}
    
    $sth=$this->_pdo->prepare('DELETE FROM xgg_product WHERE id=?');
    $sth->execute(array($id));
    return true;
  }
  
  

  
}
