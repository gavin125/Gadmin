<?php
/**
 * 链接Memcache缓存单例模式方式
 * @author gavin <gavin.gu@migang.com>
 * @version 1.0 更新于2018-06-04
 */


class _Memcache{
  /**
   * 自身唯一的实例对象
   */
  private static $_instance;

  /**
   * PDO对象
   */
  private static $_mem;


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
  public function connect($memhost,$memport){
    if(!self::$_mem){
      try {
        self::$_mem = new Memcache;
        self::$_mem->connect($memhost, $memport);
      }catch(PDOException $e){
        die ("Error!: " . $e->getMessage() . "<br/>");
      }
    }
    return self::$_mem;
  }

} 