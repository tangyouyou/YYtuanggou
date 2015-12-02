<?php
header("Content-type: text/html; charset=utf-8");
class LoginAction extends Action{

	public function _initialize(){
       $this->uid = (int)$_SESSION[C('USER_AUTH_KEY')];
       $db = D('Category');
       $this->nav = $db->getNavCategory(0);
       $this->assign('userIsLogin',isset($_SESSION[C('USER_AUTH_KEY')]));
    }
    

	public function index(){
		$this->display();
	}

	public function login(){
		if(IS_POST === false) $this->error('非法请求');

		$username = $this->_post('username');
		$password = $this->_post('password','md5');
	    $condition['email'] = $username;
        $condition['username'] = $username;
        $condition['_logic'] = 'OR';
		$this->db = D('User');
		$userinfo = $this->db->getUser($condition);
		$uid = $userinfo['uid'];
		if($userinfo['password'] == $password){
			session(C('USER_AUTH_KEY'),$uid);   
            if(isset($_POST['auto_login'])){
            	setcookie(session_name(),session_id(),time()+C('COOKIE_EXPIRE'),'/');
            }
            $this->success('登录成功',U('Index/Index/index'));
		}else{
			$this->error('账户或密码错误');
		}

	}

    public function logout(){
    	setcookie(session_name(),session_id(),1,'/');
    	session_unset();
    	session_destroy();
    	$this->success('退出成功',U('Index/Index/index'));	
    }
}
?>