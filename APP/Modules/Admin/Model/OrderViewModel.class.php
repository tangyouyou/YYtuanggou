<?php

class OrderViewModel extends ViewModel{


	/**
	 * 获取订单总数
	 */
	public function getOrderTotal($where){
		$string ='INNER JOIN yy_goods ON yy_goods.gid = yy_order.goods_id';	
		return $this->table('yy_order')->join($string)->where($where)->count();
	}
	
	/**
	 * 获取订单
	 */
	public function getOrder($where){
		$fields = array(
			'main_title',
			'goods_num',
			'price',
			'orderid',
			'total_money',
			'status'		
		);
		$string ='INNER JOIN yy_goods ON yy_goods.gid = yy_order.goods_id';	
		return $this->table('yy_order')->join($string)->where($where)->select();
	}
	
	/**
	 * 删除订单
	 */
	public function delOrder($oid){
		return $this->where(array('orderid'=>$oid))->del();
	}
}
?>