<?php

class AreaModel extends Model{

   public function getAreaFind($aid){
      return $this->order('sort ASC')->where(array('aid'=>$aid))->find();
   }

   public function getAreaAll(){
   	  return $this->order('sort ASC')->select();
   }
}
?>