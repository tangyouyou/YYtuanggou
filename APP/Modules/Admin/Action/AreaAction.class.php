<?php
header("Content-type: text/html; charset=utf-8");
class AreaAction extends CommonAction{
   //地区管理首页
   public function index(){
       import('Class.Area',APP_PATH);
       $area = M('area')->order('sort ASC')->select();
       $area = Area::unLimitedForLevel($area);
       $this->area = $area;
       $this->display();
   }
   //地区管理添加
   public function addArea(){
       import('Class.Area',APP_PATH);
       $area = M('area')->order('sort ASC')->select();
       $this->area = Area::unLimitedForLevel($area);
       $this->check = M('area')->where(array('aid'=>$_GET['aid']))->find();
       $this->display();
   }
   //地区管理添加分类处理
   public function runAddArea(){
       $data = array();
       $data['pid'] = (int)$_POST['pid'];
       $data['sort'] = (int)$_POST['sort'];
       $data['display'] = (int)$_POST['display'];
       $data['aname'] = I('aname');
       if(M('area')->add($data)){
         $this->success('插入成功',U(GROUP_NAME .'/Area/index'));
       }else{
         $this->errpr('插入失败');
       }
   }
   //地区管理编辑
   public function edit(){
      if(IS_GET){
           import('Class.Area',APP_PATH);
           $area = M('area')->order('sort ASC')->select();
           $this->area = Area::unLimitedForLevel($area);
           $check = M('area')->where(array('aid'=>$_GET['aid']))->find();      
           $parent = M('area')->where(array('aid'=>$check['pid']))->find();   
           if(!$parent){
              $parent['aname'] = '顶级地区';
              $parent['aid'] = 0 ;
           }   
           $this->parent = $parent;
           $this->check = $check;
           $this->display();
           exit;
       }   
           $data = array();
           $data['aid'] = (int)$_POST['aid'];
           $data['pid'] = (int)$_POST['pid'];
           $data['sort'] = (int)$_POST['sort'];
           $data['display'] = (int)$_POST['display'];
           $data['aname'] = I('aname');
           if(M('area')->save($data)){
              $this->success('编辑成功',U(GROUP_NAME . '/Area/index'));
           }else{
              $this->error('编辑失败');
           }
   
   }
   //地区管理删除
   public function del(){
       //首先判断是否存在子类
       $field = array('aid','pid');
       if(M('area')->field($field)->where(array('pid'=>$_GET['aid']))->select()){
          $this->error('该分类下存在子类，无法删除');
       }
       if(M('area')->field('aid')->where(array('aid'=>$_GET['aid']))->delete()){
          $this->success('删除成功',U(GROUP_NAME . '/Area/index'));
       }else{
          $this->error('删除失败');
       }
   	   
   }
}
?>