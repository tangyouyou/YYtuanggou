<?php

class UserAction extends CommonAction{

	public function _auto(){
		$this->db  = D('UserView');
	}
	/**
	 * 显示用户列表
	 */
	public function index(){
		 /*
           引入分页类
	    */		
        import("ORG.Util.Page");
        $count = $this->db->getUserTotal();
        $page = new Page($count,25);
        $show = $page->show();
        $list = $this->db->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->user = $this->db->getUser();
		$this->display();
	}
	
	
	public function del(){
		$uid = $this->_get('uid','intval',0);
		if($this->db->delUser($uid)){
			$this->success('删除成功!','index');
		}else{
			$this->error('删除失败!','index');
		}
	}
}
?>