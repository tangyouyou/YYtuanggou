<?php
//构造无限分类
class Category{
  Static public function unLimitedForLevel($cate,$html='--',$pid = 0 ,$level = 0){

        $arr = array();

        foreach ($cate as $v) 
             if($v['pid'] == $pid){
                $v['pid'] = $v['cid'];
                $v['level'] = $level + 1;
                $v['html']  = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr,self::unLimitedForLevel($cate,$html,$v['cid'],$level + 1));
             }
      return $arr;       
  }

}

?>