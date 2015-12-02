<?php

class GoodsViewModel extends ViewModel{

	protected $viewFields = array(
       'goods'=>array(
          'gid','cid','aid','main_title','sub_title','price','old_price','buy','goods_img',
          '_type'=>'INNER'
        ),
       'category'=>array(
          'cid','cname','key_words','title','description','sort','display','pid',
          '_on'=>'goods.cid = category.cid',
          '_type'=>'INNER'       
        ),
       'shops'=>array(
          'sid','shopname','shopaddress','metroaddress','shoptel','shopcoord',
          '_on'=>'goods.sid = shops.sid',
          '_type'=>'INNER'
        ),
       'area'=>array(
           'aid','aname',
           '_on'=>'goods.aid = area.aid'
        ),
       'goods_detail'=>array(
           'goods_id','goods_server','detail',
           '_on'=>'goods.gid = goods_detail.goods_id'
        )
  );

  //获取所有商品的数据
	public function getGoodsAll(){
		return $this->order('gid desc')->select();
	}
  //获取单条商品的数据
  public function getGoodsFind($gid){
    return $this->where(array('gid'=>$gid))->find();
  }

  public function addGoods($data){
     $gid = $this->table('yy_goods')->add($data['goods']);
     $data['goods_detail']['goods_id'] = $gid;
     return $this->table('yy_goods_detail')->add($data['goods_detail']);
  }

  //编辑商品
  public function editGoods($data,$gid){
     $count = 0;
     $this->table('yy_goods')->where(array('gid'=>$gid))->save($data['goods']);
     $count += $this->getAffectedRows();
     $this->table('yy_goods_detail')->where(array('goods_id'=>$gid))->save($data['goods_detail']);
     $count += $this->getAffectedRows();
     return $count;
  }

  //删除商品
  public function delGoods($gid){
     $img = $this->field('goods_img')->where(array('gid'=>$gid))->find();
     return $img['goods_img'];
  }
}
?>