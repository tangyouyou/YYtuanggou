<?php
header("Content-type: text/html; charset=utf-8");
class IndexAction extends CommonAction{
	private $cid;
	private $aid;
  private $price;
  private $url;     //检索的url
  private $order;   //排序规则
  public function _auto(){
      $this->cid = $this->_get('cid','intval',null);
      $this->aid = $this->_get('aid','intval',null);
      $this->price = $this->_get('price','',null);
      $this->order = $this->_get('order','',null);
      if(strlen(U('Index/Index/index'))>strlen(__SELF__)){
        $this->url = U('Index/Index/index');
      }else{
        $this->url = url_param_remove('keywords',__SELF__);
      }
      $this->db = D('GoodsView');
  }

	public function index(){
    $this->setPrice();
		$this->setArea();
		$this->setCategory();                     //设置分类模板           
    $this->searchWhere();                     //组合搜索条件
    $this->setOrder();
    $this->hostGoods = $this->getHostGoods(); //实现热卖商品
    $this->setHostGroup();                    //实现热门分组
    $count = $this->db->getGoodsTotal();
    /*
      引入分页类
    */ 
    import('Class.Page',APP_PATH);
    $page = new Page($count,10);
    $test = $page->limit(); 
    $data = $this->db->setSearch($test['limit']);
    foreach ($data as $k=>$v){
      $data[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_310x185',-4,0);
      $data[$k]['sub_title'] = mb_substr($v['sub_title'],0,30,'utf8');
      $data[$k]['main_title'] = mb_substr($v['main_title'],0,15,'utf8');
    } 
    $this->assign('goods',$data);
    $this->assign('page',$page->show());
		$this->display();
	}

  //组合搜索条件
  public function searchWhere(){
     if(isset($_GET['keywords'])){
        $this->db->keywords = $_GET['keywords'];
        return;
      }
     //组合分类条件
     if(!is_null($this->cid)){
       $db = D('Category');
       $sonCids = $db->getChildCategory($this->cid);
       foreach ($sonCids as $v) {
         $this->db->cids['cid'][] = $v['cid'];
       }
       $this->db->cids['cid'][] = $this->cid;
     }

    //组合地区条件
      if(!is_null($this->aid)){
       $db = D('Area');
       $sonaids = $db->getChildArea($this->aid);
       foreach ($sonaids as $v) {
         $this->db->aids['aid'][] = $v['aid'];
       }
       $this->db->aids['aid'][] = $this->aid;
     }

     //组合价格条件
     if(!is_null($this->price)){
       $arr = explode('-', $this->price);
       if(isset($arr[1])){
          $this->db->pricefirst = intval($arr[0]);
          $this->db->priceend = intval($arr[1]);
       }else{
          $this->db->pricefirst = intval($arr[0]);
       }
     }
     $this->setOrderUrl();
     
  }

	//设置分类的模板
	/*第一种情况：无cid 显示顶级分类
	 *第二种情况：有cid 显示顶级分类与子类
	*/
	private function setCategory(){
       $url = url_param_remove('cid',$this->url);
	     $db = D('Category');
	     //无cid情况
       if(is_null($this->cid)){
          $topCategory = $db->getCategoryLevel(0);
          $tmparr = array();
          $tmparr[] = '<a class="active" href = "'.$url.'">全部</a>';
          foreach ($topCategory as $v) {
          	   $tmparr[] =  '<a href = "'. $url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
          }
          $this->assign('topCategory',$tmparr); 
          return;   
       }

       //有cid情况，第一种，cid是顶级，pid =0
       //第二种，cid不是顶级
        $pid = $db->getCategoryPid($this->cid);
        $topCategory = $db->getCategoryLevel(0);
        $tmparr = array();
        $tmparr[] = '<a class="active" href = "'. $url.'">全部</a>';
        foreach ($topCategory as $v) {
	        if($pid == $v['cid'] ||$this->cid == $v['cid']){
	             $tmparr[] =  '<a class="active" href = "'. $url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
	        }else{
	        	   $tmparr[] =  '<a href = "'. $url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
	       	}      	   
        }
        $this->assign('topCategory',$tmparr); 

        if($pid == 0){
              $sonCategory = $db->getCategoryLevel($this->cid);
        }else{
              $sonCategory = $db->getCategoryLevel($pid);
        }
        if(is_null($sonCategory)) return;
        //组合子分类模板
        $tmparr = array();
        if($pid == 0){
             $tmparr[] = '<a class="active" href = "'. $url.'/cid/'.$this->cid.'">全部</a>';
        }else{
             $tmparr[] = '<a href = "'. $url.'/cid/'.$pid.'">全部</a>';
        }

        foreach ($sonCategory as $v ) {
        	if($v['cid'] == $this->cid){
                 $tmparr[] =  '<a class="active" href = "'. $url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
        	}else{
                 $tmparr[] =  '<a  href = "'. $url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
        	}
        }
        $this->assign('sonCategory',$tmparr);
        
	}

    //设置地区筛选模板
	private function setArea(){
       $url = url_param_remove('lid',$this->url);
       $db = D('Area');
       //无aid情况
       if(is_null($this->aid)){
          $topArea = $db->getAreaLevel(0);
          $tmparr = array();
          $tmparr[] = '<a class="active" href = "'.$url.'">全部</a>';
          foreach ($topArea as $v) {
               $tmparr[] =  '<a href = "'. $url.'/aid/'.$v['aid'].'">'.$v['aname'].'</a>';
          }
          $this->assign('topArea',$tmparr); 
          return;   
       }

       //有aid情况，第一种，aid是顶级，pid =0
       //第二种，aid不是顶级
        $pid = $db->getAreaPid($this->aid);
        $topArea = $db->getAreaLevel(0);
        $tmparr = array();
        $tmparr[] = '<a class="active" href = "'. $url.'">全部</a>';
        foreach ($topArea as $v) {
          if($pid == $v['aid'] ||$this->aid == $v['aid']){
               $tmparr[] =  '<a class="active" href = "'. $url.'/aid/'.$v['aid'].'">'.$v['aname'].'</a>';
          }else{
               $tmparr[] =  '<a href = "'. $url.'/aid/'.$v['aid'].'">'.$v['aname'].'</a>';
          }          
        }
        $this->assign('topArea',$tmparr); 

        if($pid == 0){
              $sonArea = $db->getAreaLevel($this->aid);
        }else{
              $sonArea = $db->getAreaLevel($pid);
        }
        if(is_null($sonArea)) return;
        //组合子分类模板
        $tmparr = array();
        if($pid == 0){
             $tmparr[] = '<a class="active" href = "'. $url.'/aid/'.$this->aid.'">全部</a>';
        }else{
             $tmparr[] = '<a href = "'. $url.'/aid/'.$pid.'">全部</a>';
        }

        foreach ($sonArea as $v ) {
          if($v['aid'] == $this->aid){
                 $tmparr[] =  '<a class="active" href = "'. $url.'/aid/'.$v['aid'].'">'.$v['aname'].'</a>';
          }else{
                 $tmparr[] =  '<a  href = "'. $url.'/aid/'.$v['aid'].'">'.$v['aname'].'</a>';
          }
        }
        $this->assign('sonArea',$tmparr);
	}

  //设置价格筛选模板
  private function setPrice(){
        $url = url_param_remove('price',$this->url);
        $db = D('Category');
        $key = '';
        if(is_null($this->cid)){
           $key = 'all';
        }else{
           $pid = $db->getCategoryPid($this->cid);
           $key = $pid?$pid:$this->cid;
        }
        $prices = C('price');
        $price = $prices[$key];
        $tmparr = array();
        if(is_null($this->price)){
          $tmparr[] = '<a class="active" href="'. $url.'">全部</a>';
        }else{
          $tmparr[] = '<a href="'. $url.'">全部</a>';
        }
        foreach ($price as $v) {
          if($this->price == $v[1]){
             $tmparr[] = '<a class="active" href="'. $url.'/price/'.$v[1].'">'.$v[0].'</a>';
          }else{
             $tmparr[] = '<a href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
          }
        }
        $this->assign('price',$tmparr);
  }

  /**
  * 设置排序规则
  */
  private function setOrder(){
    $order = '';
    $arr = explode('-',$this->order);
    switch ($arr[0]){
      case 'd':
        $order = 'begin_time '.$arr[1];
      break;
      case 'b':
        $order = 'buy '.$arr[1];
      break;
      case 'p':
        $order = 'price '.$arr[1];
      break;
      case 't':
        $order = 'begin_time '.$arr[1];
      break;
    }
     $this->db->order = $order;
  }

  /**
  * 设置排序的模板
  */
  private function setOrderUrl(){
  $url = url_param_remove('order',$this->url);
  $orderUrl = array();
  //default 默认排序
  $orderUrl['d'] = $url.'/order/t-desc';  
  //buy 销量降序
  $orderUrl['b'] = $url.'/order/b-desc';
  //price 价格降序
  $orderUrl['p_d'] = $url.'/order/p-desc';
  //price 价格升序
  $orderUrl['p_a'] = $url.'/order/p-asc';
  //begin_time 发表时间，降序
  $orderUrl['t'] = $url.'/order/t-desc';
  $this->assign('orderUrl', $orderUrl);
  }      


  /*
    热卖商品
  */
  private function getHostGoods(){
      if(!$data = S('HostGoods')){
         $data = $this->db->getHostGoods();
         $data = $this->disHostGoods($data);
         S('HostGoods',$data,600);
      }
      return $data;
  }

  /**
   * 处理热卖商品数据
  */
  private function disHostGoods($goods){
    if(empty($goods)) return false;
    foreach ($goods as $k=>$v){
      $goods[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_90x55',-4,0);
    }
    return $goods;
  }

  /*
    设置热门团购
  */
  private function setHostGroup(){
    $this->hostGroup = $this->db->getHostGroup();
  }
}
?>