<?php
/**
 * @name Bootstrap
 * @author gulei
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
require_once 'plugins/_PDO.php';
require_once 'plugins/_Memcache.php';


header("Access-Control-Allow-Origin: http://localhost:8080");


class Bootstrap extends Yaf_Bootstrap_Abstract {

	private $_db;

  public function _initConfig() {
		//把配置保存起来
		$this->_db = Yaf_Application::app()->getConfig()->db;
		$this->_mem = Yaf_Application::app()->getConfig()->mem;
	}

	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
		//注册一个插件
		// $objSamplePlugin = new SamplePlugin();
		// $dispatcher->registerPlugin($objSamplePlugin);
		$pdo=_PDO::getInstance()->connect($this->_db->host,$this->_db->name,$this->_db->user,$this->_db->pass);
		Yaf_Registry::set('pdo', $pdo);
		$mem=_Memcache::getInstance()->connect($this->_mem->host,$this->_mem->port);
		Yaf_Registry::set('mem', $mem);
	}

	public function _initRoute(Yaf_Dispatcher $dispatcher) {
		// //在这里注册自己的路由协议,默认使用简单路由
		// $router =Yaf_Dispatcher::getInstance()->getRouter();
		// //创建一个路由协议实例
		// $route=new Yaf_Route_Rewrite(
		// 	'user/reg/:username',
		// 	array('controller'=>'user','action'=>'reg')
		// );
		// //使用路由器装载路由协议
		// $router->addRoute('product',$route);
	}
	
	// public function _initView(Yaf_Dispatcher $dispatcher) {
	// 	//在这里注册自己的view控制器，例如smarty,firekylin
	// }
}
