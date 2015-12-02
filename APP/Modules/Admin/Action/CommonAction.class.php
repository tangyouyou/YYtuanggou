<?php 
header("Content-type: text/html; charset=utf-8");
 Class CommonAction extends Action{
 	protected $db; //数据连接
    //初始化
 	public function _initialize(){
 		if(method_exists($this, '_auto')){
 			$this->_auto();
 		}
 	    //如果没有登录，跳转到登录界面
		if(!isset($_SESSION[C('USER_AUTH_KEY')])){
			$this->redirect('Admin/Login/index', '', 3, '页面跳转中,请先登录');
			exit;
		}
 	}


}
?>