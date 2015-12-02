<?php
header("Content-type: text/html; charset=utf-8");
class CategoryModel extends Model{
   //默认操作表
   public $tableName = 'category';

   //获取分类所有数据
   public function getCategoryAll(){
       return $this->select();
   }

   public function addCategory($data){
       return $this->add($data);
   }

   //获取父类信息
   public function getParents($cid){  
   	   $result = $this->field(array('cname','cid'))->where(array('cid'=>$cid))->find();
   	   if($result){
   	   	 return $result;   
   	   }else{
   	   	 return array(
            'cid'=>0,
            'cname'=>'顶级分类'
   	   	 	);
   	   }
   }
   //获取单条的分类数据
   public function getCategoryFind($cid){
       return $this->order('sort ASC')->where(array('cid'=>$cid))->find();
   }
   
   
}
?>