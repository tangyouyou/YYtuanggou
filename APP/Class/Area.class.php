<?php
class Area{
	Static public function unLimitedForLevel($cate,$html='--',$pid = 0 ,$level = 0){

        $arr = array();

        foreach ($cate as $v) 
             if($v['pid'] == $pid){
                $v['pid'] = $v['aid'];
                $v['level'] = $level + 1;
                $v['html']  = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr,self::unLimitedForLevel($cate,$html,$v['aid'],$level + 1));
             }
      return $arr;       
  }
}

?>