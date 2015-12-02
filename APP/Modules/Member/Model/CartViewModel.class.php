<?php

class CartViewModel extends ViewModel{

    protected $viewFields = array(
			
	);

	/**
	 * 获取商品的数据
	 */
	public function getGoods($gid){
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time'		
		);
		return $this->table('yy_goods')->field($fields)->where(array('yy_goods.gid'=>$gid))->find();
	}
	/**
	 * 添加购物车
	 */
	public function addCart($data){
		return $this->table('yy_cart')->add($data);
	}
	/**
	 * 验证购物车信息是否存在
	 */
	public function checkCart($where){
		$result = $this->table('yy_cart')->field('cart_id')->where($where)->find();
		return isset($result['cart_id'])?$result['cart_id']:null;
	}
	
	/**
	 * 自增购物车
	 */
	public function incCart($id,$num){
		return $this->table('yy_cart')->where(array('cart_id'=>$id))->setInc('goods_num',$num);
	}
	/**
	 * 统计购物车总数
	 */
	public function countCart($where){
		return $this->table('yy_cart')->where($where)->count();
	}
	/**
	 * 更新购物车商品数量
	 */
	public function updateCartNum($where,$num){
		$result = $this->table('yy_cart')->where($where)->save(array('goods_num'=>$num));
		return $result;
	}
	
	/**
	 * 获取所有购物车的数据
	 */
	public function getCartAll($uid){
		$this->viewFields = array(
			'goods'=>array(
				'main_title','gid','goods_img','price','end_time',
				'_type'=>'INNER'				
			),
			'cart'=>array(
				'cart_id','goods_num',
                '_type'=>'INNER',
                '_on'=>'goods.gid = cart.goods_id'
			)
		);
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time',
			'cart_id',
			'goods_num'	
		);
		return $this->field($fields)->where(array('user_id'=>$uid))->select();
	}
	/**
	 *删除购物车
	 */
	public function delCart($where){
		return $this->table('yy_cart')->where($where)->delete();
	}


}
?>