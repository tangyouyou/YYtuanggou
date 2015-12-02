<?php

class CollectViewModel extends ViewModel{

	protected $viewFields = array();

	/*
      验证是否收藏过该订单
    */
    public function checkCollect($where){
        return $this->table('yy_collect')->where($where)->count();
    }
    /*
      添加收藏
    */
    public function addCollect($data){
        return $this->table('yy_collect')->add($data);
    }

    /*
      获得所有收藏
    */
    public function getCollect($where){
        $this->viewFields = array(
          'goods'=>array(
            'main_title','gid','goods_img','price','end_time',
            '_type'=>'INNER'        
          ),
          'collect' => array(
              'collectid','user_id','goods_id',
              '_on'=>'goods.gid = collect.goods_id'
          )
        ); 
        $fields = array(
        	'main_title',
			    'goods_img',
			    'price',
			    'end_time',
			    'gid');
    	return $this->field($fields)->where($where)->select();
    }

    /*
      删除收藏
    */
    public function delCollect($where){
    	return $this->table('yy_collect')->where($where)->delete();
    }
}
?>