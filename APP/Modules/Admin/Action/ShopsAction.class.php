<?php
header("Content-type: text/html; charset=utf-8");
class ShopsAction extends CommonAction{

  private $sid; //商铺ID

  public function _auto(){
      $this->db = D('Shops');
      $this->sid = $this->_get('sid','intval',0);
  }

	public function index(){
		 $shops = M('shops');
		 import("ORG.Util.Page");
	   $count = $shops->count();
     $page = new Page($count,25);
     $show = $page->show();
     $list = $shops->limit($page->firstRow.','.$page->listRows)->select();
     $this->assign('list',$list);
     $this->assign('page',$show);
     $this->display();
	}

	public function addShop(){
      //判断是否GET请求显示模板
  		if(IS_GET == true){
  			$this->display();
  			exit;
  		}
      //添加数据
      $data = $this->getData();
      //插入数据
      if($this->db->addShops($data)){
           $this->success('插入成功',U(GROUP_NAME . '/Shops/index'));
      }else{
           $this->error('插入失败');
      }
	}
    
	public function getData(){
       $data = array();
       $data['shopname'] = $this->_post('shopname');
       $data['shopaddress'] = $this->_post('shopaddress');
       $data['metroaddress'] = $this->_post('metroaddress');
       $data['shoptel'] = $this->_post('shoptel','intval');
       $data['shopcoord'] = $this->_post('shopcoord',false);
       $data['sid'] = $this->_post('sid','intval');
       return $data;     
	}

	public function edit(){
	  if(IS_GET == true){
	   $this->shops = $this->db->getShops($this->sid);
		 $this->display();
		 exit;
	  }
	  //添加数据
    $data = $this->getData();
    if(M('shops')->save($data)){
       	 $this->success('编辑成功',U(GROUP_NAME . '/Shops/index'));
    }else{
       	 $this->error('编辑失败');
    }
     
	}

	public function del(){
       $shops = $this->db->delShops($this->sid);
       if($shops){
       	 $this->success('删除成功',U(GROUP_NAME . '/Shops/index'));
       }else{
       	 $this->error('删除失败');
       }
	}


}
?>