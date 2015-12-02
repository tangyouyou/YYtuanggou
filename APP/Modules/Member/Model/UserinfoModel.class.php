<?php

class UserinfoModel extends Model{
   /**
     * 添加账户余额
     */
    public function addBalance($uid){
         return $this->where(array('user_id'=>$this->uid))->setInc('balance',10000);
    }

    /**
     * 获取用户的账户余额
     */
    public function getUserBalance($uid){
        $result = $this->where(array('user_id'=>$uid))->find();
        return $result['balance'];
    }

    /*
    添加用户
    */
    public function addUser($data){
       return $this->add($data);
    }
    
    /**
     * 更新用户余额
     */
    public function updateBalance($uid,$num){
        $this->where(array('user_id'=>$uid))->setDec('balance',$num);
    }

}


?>