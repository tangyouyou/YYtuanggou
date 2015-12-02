<?php

class AreaModel extends Model{

	public function getAreaLevel($pid){
         return $this->field('aname,aid')->where(array('pid'=>$pid,'display'=>1))->order('sort asc')->select();
	}

	//获取父类的pid
	public function getAreaPid($aid){
		$result = $this->field('pid')->where(array('aid'=>$aid))->find();
		return $result['pid'];
	}

	//获取子地区
	public function getChildArea($aid){
		$result = $this->field('aid')->where(array('pid'=>$aid))->select();
		if(is_null($result)){
			$result = array('aid'=>$aid);
		}
		return $result;
	}
}

?>