<?php
header("Content-type: text/html; charset=utf-8");
class CommonAction extends Action{

	protected $db;  //数据库连接
        protected $uid; 
	public function _initialize(){
		//如果没有登录，跳转到登录界面
		if(!isset($_SESSION[C('USER_AUTH_KEY')])){
			$this->redirect('Member/Login/index', '', 1, '页面跳转中,请先登录');
			exit;
		}

		if(method_exists($this, '_auto')){
			$this->_auto();
		}
		//配置uid
		$this->uid = (int)$_SESSION[C('USER_AUTH_KEY')];
		$this->setNav();
		$this->assign('userIsLogin',isset($_SESSION[C('USER_AUTH_KEY')]));
	
	}
    //设置导航
	private function setNav(){
		if(!$nav = S('nav')){
                $db = D('Category');
 		   $nav = $db->getNavCategory(0);
 		   S('nav',$nav,3600);
		}
 		$this->assign('nav',$nav);
	} 
}
?>