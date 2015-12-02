<?php
header("Content-type: text/html; charset=utf-8");
 Class CommonAction extends Action{
 	protected $db; //数据连接
        protected $uid; 
    //初始化
 	public function _initialize(){
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