<?php
   class DetailAction extends CommonAction{
        private $gid; 
   		  public function _auto(){
   			  $this->gid = $this->_get('gid','intval',0);
        	$this->db = D('GoodsView');
          $this->setRecentView();
        }
   		/**
   		 * 显示细节页
   		 */
   		public function index(){
       	  $detail = $this->db->getGoodsDetail($this->gid);		
		      $detail = $this->getDetail($detail);
          $this->getRelatedGoods(); 
		    	$this->assign('detail',$detail);
        	$this->display();            
        }

        /*
          处理商品细节页数据
        */
        private function getDetail($detail){
          $detail['discount'] = round(($detail['price']/($detail['old_price']-1)*10),1);
        	$detail['goods_img'] = substr_replace(SITE_URL.$detail['goods_img'],'_460x280',-4,0);
        	if($detail['end_time']-time()>(pow(60,2)*24*3)){
        		$detail['end_time'] = '剩余<span>3</span>天以上';
        	}else{
        		$detail['end_time'] = date('Y-m-d H:i:s').'下架';
        	}
        	$goodsServe = array_slice(unserialize($detail['goods_server']),0,2);
        	$serve = C('goods_server');
        	$detail['serve'] = array(
        			$serve[$goodsServe[0]],
        			$serve[$goodsServe[1]]
        	);
        	return $detail;
        }

        /*
        最近浏览功能
        */
        private function setRecentView(){
          import('Class.Encry',APP_PATH);
          $key = Encry::encrypt('recent-view');
          $value = isset($_COOKIE[$key])?unserialize(Encry::decrypt($_COOKIE[$key])):array();
          if(!in_array($this->gid,$value)){
            array_unshift($value, $this->gid);
          }
          setcookie($key,Encry::encrypt(serialize($value)),time()+3600,'/');
        }


        /*
           团购用户查看功能
        */
        private function getRelatedGoods(){
           $cid = $this->db->getGoodsCid($this->gid);
           $relateGoods = $this->db->getRelatedGoods($cid);
           foreach ($relateGoods as $k => $v) {
              $relateGoods[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_200x100',-4,0);
           }
           $this->assign('relateGoods',$relateGoods);
        }
		
   }
?>

