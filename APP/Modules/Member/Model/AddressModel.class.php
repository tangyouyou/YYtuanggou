<?php

class AddressModel extends Model{ 
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