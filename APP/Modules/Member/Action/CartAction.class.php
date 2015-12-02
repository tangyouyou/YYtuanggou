<?php
header('Content-type:text/json; charset=utf-8');
class CartAction extends Action{

	private $uid = null;
	/*
	 初始化
	*/
    public function _initialize(){
       if(isset($_SESSION[C('USER_AUTH_KEY')])){
       	  $this->uid = $_SESSION[C('USER_AUTH_KEY')];
       	  //将session中的数据写入数据库
       	  $this->writeCart();
       }
       $db = D('Category');
       $this->nav = $db->getNavCategory(0);
       $this->assign('userIsLogin',isset($_SESSION[C('USER_AUTH_KEY')]));
    }


	public function index(){
		//分配收货地址
		$db = D('User');
		$address = $db->getAddress($this->uid);
		$this->assign('address',$address);
		$cart = $this->getCartData();
		$data = $this->disCart($cart);
		if(IS_AJAX === false){
			$this->count = count($cart);
			$this->assign('cart',$data[0]);
			$this->assign('total',$data[1]);
			$this->display();
		}else{
			if(isset($data[0])){
                                exit(json_encode(array('status'=>true,'data'=>$data[0])));                               
				//$this->ajaxReturn(array('status'=>true,'data'=>$data[0]));
			}else{
				$this->ajaxReturn(array('status'=>false),'JSON');	
			}
		}	 
	}

    /**
	 * 获得购物车的数据
	 */
	private function getCartData(){
		$db = D('CartView');
		$result = array();
        if(is_null($this->uid)){
           if(!isset($_SESSION['cart']['goods'])) return ;
           $carts = $_SESSION['cart']['goods'];
           foreach ($carts as $v) {
           	   $data = $db->getGoods($v['id']);
			   $data['goods_num'] = $v['num'];
			   $result[] = $data;
           }
        }else{
            $result = $db->getCartAll($this->uid);
        }
        return $result;
	}

	/**
	 * 处理购物车数据
	*/
	public function disCart($cart){
		if(empty($cart)) return false;
		$total = 0;
		foreach ($cart as $k=>$v){
			$cart[$k]['xiaoji'] = $v['goods_num']*$v['price'];
			$cart[$k]['status'] = $v['end_time']<time()?'已下架':'可购买';
			$cart[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_90x55',-4,0);
			$cart[$k]['sub_title'] = mb_substr($v['sub_title'],0,14,'utf8');
			$total += $cart[$k]['xiaoji'];
		}
		return array($cart,$total);
	}
    
	public function addCart(){
		if(IS_AJAX === false) $this->error('非法请求');
        $result = array();
        import('Class.Cart',APP_PATH);
		if(is_null($this->uid)){
			$data = array(
               'id'=>$this->_get('gid','intval'),
               'name'=>'',
               'num'=>1,
               'price'=>0
			);
			Cart::add($data);
			$total = count($_SESSION['cart']['goods']);
            $result = array('status'=>true,'total'=>$total);
		}else{//用户已登录
			$data = array();
			$data['goods_id'] = $this->_get('gid','intval');
			$data['user_id'] = $this->uid;
			$data['goods_num'] = 1;
			$result = $this->checkAdd($data);
			if($result){
				$db = D('CartView');
				$where = array('user_id'=>$data['user_id']);
				$total = $db->countCart($where);
				$result = array('status'=>true,'total'=>$total);
			}
		}
		exit(json_encode($result));
	}

	private function writeCart(){
		if(!isset($_SESSION['cart']['goods'])) return;
		$goods = $_SESSION['cart']['goods'];
		foreach ($goods as $v) {
			$data = array();
            $data['user_id'] = $this->uid;
            $data['goods_id'] = $v['id'];
            $data['goods_num'] = $v['num'];
            $this->checkAdd($data);
		}
		unset($_SESSION['cart']);
	}
    /*
     验证添加，存在自增，不存在添加新数据
    */
	private function checkAdd($data){
        $where = array('user_id'=>$data['user_id'],'goods_id'=>$data['goods_id']);
        $db = D('CartView');
        $cart_id = $db->checkCart($where);
        if(is_null($cart_id)){
           return $db->addCart($data); 
        }else{
           return $db->incCart($cart_id,$data['goods_num']); 
        }
	}

	//验证购物车商品数量
    public function updataGoodsNum(){
    	if(IS_AJAX === false) return false;
    	$gid = $this->_post('gid','intval');
        $num = $this->_post('num','intval');
        $result = array();
        //用户没有登录
        if(is_null($this->uid)){
           $carts = $_SESSION['cart']['goods'];
           foreach ($carts as $k=>$v){
			  if($v['id'] == $gid){
					$carts[$k]['num'] = $num;
					$result = array(
						'status'=>true,
						'num'=>$num		
					);
			  }
		   }
        }else{//用户登录
          $db = D('CartView');
		  $where = array(
			'goods_id'=>$gid,
			'user_id'=>$this->uid		
		  );
		  if($db->updateCartNum($where,$num)){
				$result = array(
					'status'=>true,
					'num'=>$num
				);
		  }
        }
        exit(json_encode($result));
    }

    //删除购物车
    public function del(){
		if(IS_AJAX === false) {
			$gid = $this->_get('gid','intval');
            $where = array('user_id'=>$this->uid,'goods_id'=>$gid);
			$db = D('CartView');
			if($db->delCart($where)){
				$this->success('删除成功',U('Member/Cart/index'));
			}else{
				$this->error('删除失败',U('Member/Cart/index'));
			}
			return;
		};
		$gid = $this->_get('gid','intval');
		/**
		 * 用户没有登录
		 */
		$result = array();
		$result['status'] = false;
		if(is_null($this->uid)){
			foreach ($_SESSION['cart']['goods'] as $k=>$v){
				if($v['id'] == $gid){
					unset($_SESSION['cart']['goods'][$k]);
					$result['status'] = true;
				}
			} 
		}else{	//用户登录了
			$where = array('user_id'=>$this->uid,'goods_id'=>$gid);
			$db = D('CartView');
			if($db->delCart($where)){
				$result['status'] = true;
			}
		}
		
		exit(json_encode($result));
	}

}
?>