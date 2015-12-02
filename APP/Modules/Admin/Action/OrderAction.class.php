<?php

class OrderAction extends CommonAction{

	public function _auto(){
		$this->db = D('OrderView');
	}
	
	/**
	 * 显示订单
	 */
	public function index(){
		$where = $this->getWhere();
		/*
           引入分页类
	    */		
        import("ORG.Util.Page");
        $count = $this->db->getOrderTotal($where);
        $page = new Page($count,25);
        $show = $page->show();
        $list = $this->db->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->order = $this->db->getOrder($where);
		$this->display();
	}
	/**
	 * 获取where条件
	 * @return multitype:
	 */
	private  function getWhere(){
		$where = array();
		$status =  $this->_get('status','intval',null);
		if(!is_null($status)){
			$where['status'] = $status;
		}
		return $where;
	}
	/**
	 * 删除订单
	 */
	public function del(){
		$oid=  $this->_get('orderid','intval',null);
		if($this->db->delOrder($oid)){
			$this->success('删除成功!','index');
		}else{
			$this->success('删除失败!','index');
		}
	}
}
?>