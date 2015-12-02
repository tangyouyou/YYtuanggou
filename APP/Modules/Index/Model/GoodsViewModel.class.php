<?php

class GoodsViewModel extends ViewModel{
	public $cids = array();    //需要检索的cid
	public $aids = array();    //需要检索的aid
	public $pricefirst = '';   //需要检索的price
	public $priceend = '';     //需要检索的price
	public $order = '';        //排序规则
	public $keywords = null;     //搜索关键字
    //设置商品的关联模型
    protected $viewFields = array(
       'goods'=>array(
          'gid','cid','aid','sid','main_title','sub_title','price','old_price','buy','goods_img','begin_time','end_time',
          '_type'=>'INNER'
       	),
       'category'=>array(
       	  'cid','cname','key_words','title','description','sort','display','pid',
          '_on'=>'goods.cid = category.cid',
          '_type'=>'INNER'       
       	),
       'area'=>array(
           'aid','aname',
           '_on'=>'goods.aid = area.aid',
           '_type'=>'INNER'
       	),
       'shops'=>array(
           'sid','shopname','shopaddress','metroaddress','shoptel','shopcoord',
           '_on'=>'goods.sid = shops.sid'
       	)
    );

    //获取所有商品
    public function getAllGoods(){
    	return $this->select();
    }

    //查询商品
    public function getGoods(){
    	return $this->field('cid,aid,gid')->select();
    }

     //设置搜索条件
	public function setSearch($limit){
		//两个条件都存在
		if(!empty($this->cids['cid']) && !empty($this->aids['aid'])){
			$map['cid'] = array('in',$this->cids['cid']);
			$map['aid'] = array('in',$this->aids['aid']);
		}else{
			//存在分类筛选
           if(!empty($this->cids['cid'])){
			 $map['cid'] = array('in',$this->cids['cid']);
		   }
		   //存在地区筛选的情况
		   if(!empty($this->aids['aid'])){
			 $map['aid'] = array('in',$this->aids['aid']);
		   }
		}
		if(!empty($this->priceend)){
			$map['price'] = array(array('gt',$this->pricefirst),array('lt',$this->priceend));
		}else{
			$map['price'] = array('gt',$this->pricefirst);
		}
		if(!is_null($this->keywords)){
		   $map['sub_title'] = array('like',"%$this->keywords%");
		}    
		$field = array('gid','cid','sid','aid','price','old_price','main_title','sub_title','buy','goods_img');		
        return $this->field($field)->where($map)->order($this->order)->limit($limit)->select();
	}

	//获取商品的总数据
	public function getGoodsTotal(){
        //两个条件都存在
		if(!empty($this->cids['cid']) && !empty($this->aids['aid'])){
			$map['cid'] = array('in',$this->cids['cid']);
			$map['aid'] = array('in',$this->aids['aid']);
		}else{
			//存在分类筛选
           if(!empty($this->cids['cid'])){
			 $map['cid'] = array('in',$this->cids['cid']);
		   }
		   //存在地区筛选的情况
		   if(!empty($this->aids['aid'])){
			 $map['aid'] = array('in',$this->aids['aid']);
		   }
		}
		if(!empty($this->priceend)){
			$map['price'] = array(array('gt',$this->pricefirst),array('lt',$this->priceend));
		}else{
			$map['price'] = array('gt',$this->pricefirst);
		} 
		$field = array('gid','sid','aid','price','old_price','maint_title','sub_title','buy','goods_img');		
        return $this->field($field)->where($map)->count();
	}

	//获取商品细节页数据
	public function getGoodsDetail($gid){
		$this->viewFields['goods_detail'] = array(
           'goods_id','goods_server','detail',
           '_on'=>'goods.gid = goods_detail.goods_id',
           '_type'=>'INNER'
		);
		return $this->where(array('gid'=>$gid))->find();
	}

	/**
	 * 获得商品的分类
	 */
	public function getGoodsCid($gid){			
		$result = $this->field('cid')->where(array('gid'=>$gid))->find();
		return $result['cid'];
	}

	/*
      获取团购商品
	*/
    public function getRelatedGoods($cid){
    	$fields = array(
            'main_title',
			'goods_img',
			'price',
			'buy',
			'gid'
    	);
        return $this->where(array('cid'=>$cid))->order('buy desc')->limit(5)->select();
    }

	/*
      实现热卖商品功能
	*/
    public function getHostGoods(){
        $fields = array(
			'main_title',
			'goods_img',
			'price',
			'old_price',
			'buy',
			'gid'
		);
		return $this->field($fields)->order('buy desc')->limit(5)->select();
    }

    /*
      实现热门团购
    */
    public function getHostGroup(){
    	$fields = array('cid','cname');
    	return $this->field($fields)->group('cid')->order('buy desc')->limit(7)->select();
    }



}
?>