<?php

class AccountAction extends CommonAction{
    /**
	 * 显示账户余额
	 */
	public function index(){
		$db = D('Userinfo');
		$balance = $db->getUserBalance($this->uid);
		$this->assign('balance', $balance);
		$this->display();
	}
	/**
	 * 用户账户设置
	 */
	public function setting(){
		$db = D('User');
		$where = array('uid'=>$this->uid);
		$this->user = $db->getUser($where);
		$this->display();
	}
	/**
	 * 设置收货地址
	 */
	public function setAddress(){
		$db = D('Address');
		$address = $db->getAddress($this->uid);
		$this->assign('address', $address);
		$this->display();
	}
	
	public function delAddress(){
		$db = D('Address');
		$id = $this->_get('addressid','intval');
		if($db->delAddress($id)){
			$this->success('删除成功!','setAddress');
		}else{
			$this->error('删除失败!','setAddress');
		}
	}
	/**
	 * 添加收货地址
	 */
	public function addAddress(){
		$data = array();
		foreach ($_POST as $D=>$v){
			$data[$D] = strip_tags($v);
		}
		$data['user_id'] = $this->uid;
		if(M('address')->add($data)){
			$this->success('添加成功',U('Member/Order/index'));
		}else{
			$this->error('添加失败',U('Member/Order/index'));
		}
	}
	/**
	 * 账户充值
	 */
	public function addBalance(){
		$db = D('User');
		$data = array();
		if(M('userinfo')->where(array('user_id'=>$this->uid))->setInc('balance',10000)){
			$this->success('充值成功',U('index'));
		}else{
			$this->success('充值失败',U('index'));
		}
	}

}
?>