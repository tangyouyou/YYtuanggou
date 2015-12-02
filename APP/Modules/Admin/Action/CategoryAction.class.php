<?php
header("Content-type: text/html; charset=utf-8");

class CategoryAction extends CommonAction{
    private $cid; //分类ID

    public function _auto(){
    	//实例模型
    	$this->db = D('Category');
    	$this->cid = $this->_get('cid','intval',0);  	
    }

    public function index(){
    	$cate = $this->db->getCategoryAll();
        import('Class.Category',APP_PATH);
        $this->cate = Category::unLimitedForLevel($cate);
    	$this->display();
    }

	public function addCate(){
		//判断是否GET请求显示模板
		if(IS_GET == true){
           $cate = $this->db->getCategoryAll();          
           import('Class.Category',APP_PATH);
           $this->cate = Category::unLimitedForLevel($cate);
           $this->check = $this->db->getCategoryFind($this->cid);
           $this->parent = $this->db->getParents($check['pid']);
		   $this->display();
		   exit;
		}
		//添加数据
	
		$data = $this->getData();
		//判断插入数据是否成功
		if($this->db->addCategory($data)){
			$this->success('插入成功',U(GROUP_NAME . '/Category/index'));
		}else{
			$this->error('插入失败');
		}

	}

    //添加分类表单处理
	private function getData(){   
        $data = array();
        $data['cname'] = $this->_post('cname');
 		$data['title'] = $this->_post('title');
 		$data['description'] = $this->_post('description');
 		$data['key_words'] = $this->_post('key_words');
 		$data['sort'] =  $this->_post('sort','intval');
 		$data['display'] =  $this->_post('display','intval');
 		$data['pid'] = $this->_post('pid','intval');
 		return $data;
	}
    //编辑分类表单
	public function edit(){
		if(IS_GET == true){
	        //获取所有分类信息
		    $cate = $this->db->getCategoryAll();
	        import('Class.Category',APP_PATH);
	        $this->cate = Category::unLimitedForLevel($cate);
	        //获取子类信息
			$data = $this->db->getCategoryFind($this->cid);
			$cname = M('category')->field('cname')->where(array('cid'=>$data['pid']))->find();
			if(!$cname){
				$cname['cname'] = '顶级分类';
			}
			$this->data = $data;
			$this->cname = $cname;
			$this->display();
			exit;
		}
		$data = $this->db->getData();
		if(M('category')->save($data)){
			$this->success('编辑成功',U(GROUP_NAME .'/Category/index'));
		}else{
			$this->error('编辑失败');
		} 

		
	}

	//删除分类表单
	public function del(){
		//判断如果有pid等于cid，代表该分类具有子类无法删除
		$pid = M('category')->where(array('pid'=>$_GET['cid']))->count();
	    if($pid){
	    	$this->error('该分类下存在子类无法删除');
	    }
	    
	    if(M('category')->where(array('cid'=>$_GET['cid']))->delete()){
	    	$this->success('删除成功',U(GROUP_NAME . '/Category/index'));
	    }else{
	    	$this->error('删除失败');
	    }   

	}

}
?>