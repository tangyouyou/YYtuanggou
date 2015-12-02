<?php

class UserViewModel extends ViewModel{

	protected $viewFields = array(
		'user'=>array(
			'uid','username','email','password',
			'_type'=>'INNER'
		),
		'userinfo'=>array(
            'user_id','balance',
            '_on'=>'user.uid = userinfo.user_id'
		)
	);

	/**
	 * 获得用户总的数据的条数
	 */
	public function getUserTotal(){
		return $this->count();
	}
	/**
	 * 获得用户的数据
	 */	
	public function getUser(){
		$fields = array(
			'uid',
			'email',
			'username',
			'balance'				
		);
		return $this->field($fields)->select();
	}
	
	/**
	 * 删除用户的
	 */
	
	public function deleteUser($uid){
		$this->table('yy_collect')->where(array('user_id'=>$uid))->delete();
		$this->table('yy_cart')->where(array('user_id'=>$uid))->delete();
		$this->table('yy_order')->where(array('user_id'=>$uid))->delete();
		$this->table('yy_userinfo')->where(array('user_id'=>$uid))->delete();
		$this->table('yy_address')->where(array('user_id'=>$uid))->delete();
		return $this->where(array('uid'=>$uid))->delete();
	}
}
?>