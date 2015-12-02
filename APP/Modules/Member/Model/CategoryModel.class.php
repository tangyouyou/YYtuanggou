<?php

class CategoryModel extends Model{

	public function getCategoryLevel($pid){
         return $this->field('cname,cid')->where(array('pid'=>$pid,'display'=>1))->order('sort asc')->select();
	}

	//获取父类的pid
	public function getCategoryPid($cid){
		$result = $this->field('pid')->where(array('cid'=>$cid))->find();
		return $result['pid'];
	}

	//获取所有的子分类
	public function getChildCategory($cid){
		$result = $this->field('cid')->where(array('pid'=>$cid))->select();
		if(is_null($result)){
			$result = array('cid'=>$cid);
		}
		return $result;
	}

	public function getNavCategory($pid){
         return $this->field('cname,cid')->where(array('pid'=>$pid,'display'=>1))->order('sort asc')->limit(4)->select();
	}
}
?>