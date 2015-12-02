<?php

class UserModel extends Model{

    public $tableName = 'user';
    //验证字段是否存在
	public function check($field,$value){
         return $this->where(array($field=>$value))->count();
	}

    //添加用户
    public function addUser($data){
         return $this->add($data);
    }

    //登录用户
    public function getUser($where){
         return $this->where($where)->find();
    }
    
    /**
     * 添加账户余额
     */
    public function addBalance($uid){
         return $this->table('yy_userinfo')->where(array('user_id'=>$this->uid))->setInc('balance',10000);
    }

    /**
     * 获取用户的账户余额
     */
    public function getUserBalance($uid){
        $result = $this->field('balance')->table('yy_userinfo')->where(array('user_id'=>$uid))->find();
        return $result['balance'];
    }
    
    /**
     * 更新用户余额
     */
    public function updateBalance($uid,$num){
        $this->table('yy_userinfo')->where(array('user_id'=>$uid))->setDec('balance',$num);
    }
    /**
     * 添加收货地址
     */
    public function addAddress($data){
        return $this->table('yy_address')->add($data);
    }
    /**
     * 读取收货地址
     */
    public function getAddress($uid){
        return $this->table('yy_address')->where(array('user_id'=>$uid))->select();
    }
    /**
     * 删除收货地址
     */
    public function delAddress($id){
        return $this->table('yy_address')->where(array('addressid'=>$id))->del();
    }
    


}
?>