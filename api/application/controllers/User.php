<?php
/**
 * @name IndexController
 * @author gulei
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class UserController extends Yaf_Controller_Abstract {

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/admin/index/index/index/name/gulei 的时候, 你就会发现不同
     */
	public function RegAction($name = "user reg") {
		//1. fetch query
		$get = $this->getRequest()->getQuery("get", "default value");

		var_dump($name);
		//2. fetch model
		$model = new SampleModel();


		//3. assign
		$this->getView()->assign("content", $model->selectSample());
		$this->getView()->assign("name", $name);

		//4. render by Yaf, 如果这里返回FALSE, Yaf将不会调用自动视图引擎Render模板
        return false;
	}
}
