<?php
/**
 * 链接数据库单例模式&PDO方式
 * @author gavin <gavin.gu@migang.com>
 * @version 1.0 更新于2018-06-04
 */

class _PDO{
  /**
   * 自身唯一的实例对象
   */
  private static $_instance;

  /**
   * PDO对象
   */
  private static $_pdo;

  /**
   *将构造函数设置为非public，可防止外部使用new创建对象
   */
  private function __construct(){ }

  /**
   * 创建唯一实例的方法
   * @param null
   * @return 类的实例，方便后面调用类的链接数据库方法
   */
  public static function getInstance(){
    if(!(self::$_instance instanceof self)){self::$_instance=new self();}
    return self::$_instance;
  }

  /**
   * 链接数据库的方法
   * @param null
   * @return PDO实例
   */
  public function connect($dbhost,$dbname,$dbuser,$dbpass){
    if(!self::$_pdo){
      try {
        self::$_pdo = new PDO('mysql:dbname='.$dbname.';host='.$dbhost.';charset=utf8', $dbuser, $dbpass);
      }catch(PDOException $e){
        die ("Error!: " . $e->getMessage() . "<br/>");
      }
    }
    return self::$_pdo;
  }

} 