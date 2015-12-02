<?php 
header("Content-type: text/html; charset=utf-8");
class LoginAction extends Action{

	public function index(){
 		$this->display();
	}

	public function showCode(){
           ob_clean();
	   import('ORG.Util.Image');
           Image::buildImageVerify();
	}


	public function login(){
	   if(IS_POST === false) exit();
                if(md5($_POST['code']) != session('verify')){
			$this -> error('验证码错误');
		}		
		$username = $this->_post('username','addslashes','');
		$password = $this->_post('password','md5');
		$db = M('admin');
		$where = array('adminname'=>$username);
		$info = $db->where($where)->find();
		if($info['password'] !=$password){
			$this->error('账号或密码错误');
		}else{
			$_SESSION[C('USER_AUTH_KEY')] = $info['adminid'];
			$this->success('登陆成功!',U('Admin/Index/index'));
		}
   }


}
?>