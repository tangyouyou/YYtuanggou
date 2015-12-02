<?php
header("Content-type: text/html; charset=utf-8");
class ShopsModel extends Model{
    //默认操作表
    public $table = 'shops';

    public function addShops($data){
    	return $this->add($data);
    }

	public function getShops($sid){
		return $this->where(array('sid'=>$sid))->find();
	}

	public function delShops($sid){
		return $this->where(array('sid'=>$sid))->delete();
	}

}
?>