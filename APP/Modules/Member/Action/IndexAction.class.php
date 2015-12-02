<?php
header("Content-type: text/html; charset=utf-8");
class IndexAction extends Action{

    public function _initialize(){
       $this->uid = (int)$_SESSION[C('USER_AUTH_KEY')];
       $db = D('Category');
       $this->nav = $db->getNavCategory(0);
       $this->assign('userIsLogin',isset($_SESSION[C('USER_AUTH_KEY')]));
    }

	  public function collect(){
        $db = D('CollectView');
        $status = $this->_get('status','intval',null);
        $where = array('collect.user_id'=>$this->uid);
        if(!is_null($status)){
          if($status == 1){
             $where = 'collect.user_id ='.$this->uid.' and end_time>='.time();
          }else{
             $where = 'collect.user_id ='.$this->uid.' and end_time<'.time();
          }
        }
        $data = $db->getCollect($where);
        $this->collect = $this->disCollectData($data);
        $this->display();
	  }
    /*
      添加收藏
    */
    public function addCollect(){
        $gid = $this->_get('gid','intval',null);
        $data = array(
            'user_id'=>$this->uid,
            'goods_id'=>$gid
        );
        $result = array();
        $db = D('CollectView');
        if($db->checkCollect($data)){
           $result = array('status'=>true);
        }else{
           if($db->addCollect($data)){
             $result = array('status'=>true);
           }else{
             $result = array('status'=>false);
           }
        }
        $this->ajaxReturn($result,'JSON');
    }
    /*
      处理收藏的数据
    */
    public function disCollectData($data){
      if(!$data) return false;
      foreach ($data as $k=>$v){
        $data[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_90x55',-4,0);
        $data[$k]['end_time'] = $v['end_time']>time()?'进行中':'已结束';
      }   
      return $data;
    }

    /**
     * 删除收藏的商品
     */
    public function delCollect(){
      $where = array(
        'user_id'=>$this->uid,
        'goods_id'=>$this->_get('gid','intval',0)   
      );
      $db = D('CollectView');
      if($db->delCollect($where)){
        $this->success('删除成功!',U('Member/Index/Collect'));
      }else{
        $this->error('删除失败!',U('Member/Index/Collect'));
      }
      
    }

	 /**
     * 获取最近浏览
     */
    public function getRecentView(){
      if(IS_AJAX === false) return false;
      import('Class.Encry',APP_PATH);
      $key = Encry::encrypt('recent-view');     
      $result = array(); 
      if(!isset($_COOKIE[$key])){
        $result['status'] = false;
        $this->ajaxReturn($result,'JSON');
      }
      
      //取得cookie的值
      $value =unserialize(Encry::decrypt($_COOKIE[$key]));  
      $db = D('Goods');
      $data = $db->getGoods($value);
      if($data){
        $data = $this->disData($data);
        $result['status'] = true;
        $result['data'] = $data;
        $this->ajaxReturn($result,'JSON');
      }else{
        $result['status'] = false;
      }
      $this->ajaxReturn($result,'JSON');
    }
    
    private function disData($data){
      foreach ($data as $k=>$v){
        $data[$k]['goods_img'] = substr_replace(SITE_URL.$v['goods_img'],'_90x55',-4,0);
      }
      return $data;
    }
    /**
     * 清空最近浏览
     */
    public function clearRecentView(){
      if(IS_AJAX === false) exit();
      import('Class.Encry',APP_PATH);
      $key = Encry::encrypt('recent-view');
      if(isset($_COOKIE[$key])){
        unset($_COOKIE[$key]);
      }
      setcookie($key,'',1,'/');
    }
  
}
?>