<?php

class GoodsModel extends Model{
	
	public function getGoods($in){
		$fields = array(
           'main_title',
           'price',
           'gid',
           'old_price',
           'goods_img',
           'end_time'
		);
		$map['gid'] = array('in',$in);
		return $this->field($fields)->where($map)->select();
	}

	/**
	 * 查询单条商品的记录
	 */
	public function getGoodsFind($gid){
		$fields = array(
				'main_title',
				'gid',
				'price'
		);
		return $this->where(array('gid'=>$gid))->find();
	}
}
?>