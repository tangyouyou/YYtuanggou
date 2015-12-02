<?php

class OrderAction extends CommonAction{

	public function index(){
        	 $db = D('OrderView');
        	 $status = $this->_get('status','intval',null);
        	 if(is_null($status)){
        	 	$where = array('user_id'=>$this->uid);
        	 }else{
        	 	$where = array('user_id'=>$this->uid,'status'=>$status);
        	 }
        	 $data =  $db->getOrderData($where);//获取订单的数据        	
        	 $order = $this->disData($data);
        	 $this->assign('order', $order);
           $this->display();            
        }
        /**
         * 处理订单数据
         * @param  $data
         * @return string
         */
        private function disData($data){
        	if(!$data) return false;
        	foreach ($data as $k=> $v){
        		$data[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_90x55',-4,0);
        		$data[$k]['zongji'] = $v['goods_num']*$v['price'];
        	}
        	return $data;
        }
              
        /***
         * 删除订单
         */
   		public function del(){
   			$oid = $this->_get('oid','intval',null);
   			if(is_null($oid)){
   				$this->error('404错误');
   			}
   			$where = array('user_id'=>$this->uid,'orderid'=>$oid);
   			$db = D('OrderView');
   			if($db->delOrder($where)){
   				$this->success('删除成功!',U('Member/Order/index'));
   			}else{
   				$this->error('删除失败！',U('Member/Order/index'));
   			}
   		}  	
}
?>