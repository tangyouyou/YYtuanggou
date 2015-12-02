<?php
header("Content-type: text/html; charset=utf-8");
class RegAction extends Action{

	public function _initialize(){
       $this->uid = (int)$_SESSION[C('USER_AUTH_KEY')];
       $db = D('Category');
       $this->nav = $db->getNavCategory(0);
       $this->assign('userIsLogin',isset($_SESSION[C('USER_AUTH_KEY')]));
    }

	public function index(){
		$this->display();
	}

	public function showCode(){
           ob_clean();
	   import('ORG.Util.Image');
       Image::buildImageVerify();
	}

	public function check(){
		$this->db = D('User');
		if(IS_AJAX === false){
			$this->error('非法请求');
		}
		$key =  addslashes(key($_POST));
		$value = $this->_post($key);
		switch ($key) {
			case 'email':
				if($this->db->check('email',$value)){
					$result = array('status'=>false,'msg'=>'该邮箱已经存在');
				}else{
					$result = array('status'=>true);
				}
			break;
			case 'username':
			    if($this->db->check('username',$value)){
			    	$result = array('status'=>false,'msg'=>'该用户名已经存在');
			    }else{
					$result = array('status'=>true);
				}
			break;
			case 'code':
			    if($_SESSION['verify'] != md5($value)){
                    $result = array('status'=>false,'msg'=>'验证码错误');
			    }else{
					$result = array('status'=>true);
				}
     		break;			
		}
        exit(json_encode($result));
	}

	public function addUser(){
		if(IS_POST === false) $this->error('非法请求');
		$this->db = D('User');
		$data = array();
		$data['email'] = $this->_post('email');
		$data['username'] = $this->_post('username');
		$data['password'] = $this->_post('password','md5');
        $uid = $this->db->addUser($data);
        if($uid){
            session(C('USER_AUTH_KEY'),$uid);
            setcookie(session_name(),session_id(),time()+C('COOKIE_EXPIRE'),'/');
            $this->success('注册成功',U(Index .'/Index/index'));
            $data['user_id'] = $uid;
            D('Userinfo')->addUser($data);
        }else{
            $this->error('注册失败',U(Index .'/Index/index'));
        }
	}


}
?>