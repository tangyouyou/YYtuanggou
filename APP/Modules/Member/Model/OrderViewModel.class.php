<?php

class OrderViewModel extends ViewModel{

	/**
	 * 获取订单的数据
	 */
	public function getOrderData($where){
	    $string ='INNER JOIN yy_goods ON yy_goods.gid = yy_order.goods_id';	
		return $this->table('yy_order')->where($where)->join($string)->select();
	}

    public function addOrder($data){
		return $this->table('yy_order')->add($data);
	}
	/**
	 * 验证订单是否存在
	 */
	public function checkOrder($where){
		return $this->where($where)->count();
	}	
	/**
	 * 通过订单获取数据
	 */
	public function getOrder($orderids){
		$map['orderid'] = array('in',$orderids);
		$string ='INNER JOIN yy_goods ON yy_goods.gid = yy_order.goods_id';
		return $this->table('yy_order')->join($string)->where($map)->select();
	}
	/**
	 * 修改订单的状态
	 */
	public function updateStatus($orderids){
		$map['orderid'] = array('in',$orderids);
		$data['status'] = 2;
		return $this->table('yy_order')->where($map)->save($data);
	}
		
	/**
	 * 删除订单
	 */
	public function delOrder($where){
		return $this->table('yy_order')->where($where)->delete();
	}
}
?>