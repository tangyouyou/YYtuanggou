<?php 
header("Content-type: text/html; charset=utf-8");
class IndexAction extends CommonAction{

    //后台首页
	public function index(){
         $this->display();
	}

	public function welcome(){
		$this->display();
	}

	//退出
	public function logout(){
        session_destroy();
		session_unset();
		$this->success('已退出!');
	}

	
}

?>