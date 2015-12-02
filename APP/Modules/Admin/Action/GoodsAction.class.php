<?php
header("Content-type: text/html; charset=utf-8");
class GoodsAction extends CommonAction{
    private $gid; //商品ID
    public $image; //图片地址
    public function _auto(){
        $this->db = D('GoodsView');
        $this->gid = $this->_get('gid','intval',0);
    }
	public function index(){
	    /*
           引入分页类
	    */		
        import("ORG.Util.Page");
        $count = M('goods')->count();
        $page = new Page($count,25);
        $show = $page->show();
        $list = $this->db->order('gid desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('data',$list);
        $this->assign('page',$show);
		$this->display();
	}

	public function addGoods(){
	    if(IS_GET === true){
	   	   $this->setShops();      //设置商铺信息
	   	   $this->setCategory();   //设置分类信息
	   	   $this->setArea();       //设置地区信息
	   	   $this->goods_server = C('goods_server');
		   $this->display();
		   exit;
	    }         
	}

    //组合数据
	public function getData(){
		  /*
		   *实例化上传类
		  */
        import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload ->autoSub = 'true'; //开启子目录上传
        $upload ->subType = 'date'; //子目录创建方式
        $upload ->dateFormat ='Ymd'; //按照时间的年月
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
		$upload->thumb = true; //设置开启生成缩略图
		$upload->thumbPrefix =  '';// 缩略图前缀
		$upload->thumbSuffix = '_460x280,_200x100,_310x185,_90x55';  //缩略图后缀
		$upload->thumbMaxWidth = '460,200,310,90';// 缩略图最大宽度
        $upload->thumbMaxHeight =  '280,100,185,55';// 缩略图最大高度
        $upload->thumbType = 1;// 缩略图生成方式 1 按设置大小截取 0 按原图等比例缩略
		if(!$upload->upload()) {// 上传错误提示错误信息
		    $this->error($upload->getErrorMsg());
		  }else{// 上传成功 获取上传文件信息
			$image =  $upload->getUploadFileInfo();
		}
		$url = substr($image[0]['savepath'],1).$image[0]['savename'];
        
		//组合数据
        $data = array();     
	    $data['goods']['sid'] = $this->_post('sid','intval');
	    $data['goods']['aid'] = $this->_post('aid','intval');
	    $data['goods']['cid'] = $this->_post('cid','intval');
	    $data['goods']['main_title'] = $this->_post('main_title');
	    $data['goods']['sub_title'] = $this->_post('sub_title');
	    $data['goods']['price'] = $this->_post('price','intval');
	    $data['goods']['old_price'] = $this->_post('old_price','intval');
	    if(isset($image)){
          	if(isset($_POST['old_img'])){
			   $del = ($_POST['old_img']);
			   $oldFiles = array(
		           $del,
		           substr_replace($del,'_460x280',-4,0),
		           substr_replace($del,'_200x100',-4,0),
		           substr_replace($del,'_310x185',-4,0),
		           substr_replace($del,'_90x55',-4,0),
				);
				foreach ($oldFiles as $v) {
					if(file_exists($v)) unlink($v);
				}
          	}
          	$data['goods']['goods_img'] = $url;       
        } 
	    $data['goods']['begin_time'] = $this->_post('begin_time','strtotime');
	    $data['goods']['end_time'] = $this->_post('end_time','strtotime');
	    $data['goods_detail']['detail'] = $this->_post('detail',false);
	    $data['goods_detail']['goods_server'] = serialize($this->_post('goods_server'));
        if($this->db->addGoods($data)){
		   $this->success('插入成功',U(GROUP_NAME . '/Goods/index'));
		}else{
		   $this->error('插入失败');
		}  
	}


	public function edit(){
        if(IS_GET === true){
           $goods = $this->db->getGoodsFind($this->gid);
	   	   $this->setShops();      //设置商铺信息
	   	   $this->setCategory();   //设置分类信息
	   	   $this->setArea();       //设置地区信息
	   	   $this->cid = D('Category')->getCategoryFind($goods['cid']); 
	   	   $this->aid = D('Area')->getAreaFind($goods['aid']);
	   	   $this->server = C('goods_server');
           $goods['goods_server'] = unserialize($goods['goods_server']);         
           $this->assign('goods',$goods);
           $this->display();
           exit;
        }
        $data = $this->getData();
        if($this->db->editGoods($data,$this->gid)){
		   $this->success('编辑成功',U(GROUP_NAME . '/Goods/index'));
		}else{
		   $this->error('编辑失败');
		}  
	}

	public function del(){
        if($this->db->delGoods($this->gid)){
			   $del = SITE_URL.$this->db->delGoods($this->gid);
			   $oldFiles = array(
		           $del,
		           substr_replace($del,'_460x280',-4,0),
		           substr_replace($del,'_200x100',-4,0),
		           substr_replace($del,'_310x185',-4,0),
		           substr_replace($del,'_90x55',-4,0),
				);
				foreach ($oldFiles as $v) {
					if(file_exists($v['goods_img'])) unlink($v['goods_img']);
			   }
			M('goods_detail')->where(array('goods_id'=>$this->gid))->delete();
			M('goods')->where(array('gid'=>$this->gid))->delete();
			$this->success('删除成功!',U(GROUP_NAME .'/Goods/index'));
		}else{
			$this->error('删除失败!');
		}
	}

    //百度编辑器的上传图片类处理
    public function editUpload(){
    	import('ORG.Net.UploadFile');
    	$upload = new UploadFile();  // 实例化上传类
    	$upload ->autoSub = 'true';
        $upload ->subType = 'date';
        $upload ->dateFormat ='Ym';
    	$upload ->maxsize = 2000000; //设置附件上传大小
    	$upload ->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload ->savePath =  './Uploads/';// 设置附件上传目录
    	if(!$upload->upload()) {// 上传错误提示错误信息
			echo json_encode(array(
                'state' => $upload->getErrorMsg()
			));
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			echo json_encode(array(
                    'url' => $info[0]['savename'],
	                'title' => htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
	                'original' =>$info[0]['name'],
	                'state' => 'SUCCESS'
			));
		}
    }

    //设置商铺对应信息
    private function setShops(){
    	$sid = $this->_post('sid','intval',0);
    	$this->shops = D('Shops')->getShops(2);
    }

    //设置分类选择数据
    private function setCategory(){
    	import('Class.Category',APP_PATH);
    	$cate = D('Category')->getCategoryAll();
	   	$this->cate = Category::unLimitedForLevel($cate);
    }

    //设置地区选择数据
    private function setArea(){
    	import('Class.Area',APP_PATH);
    	$area = D('Area')->getAreaAll();
	   	$this->area = Area::unLimitedForLevel($area);
    }
        
  

}
?>