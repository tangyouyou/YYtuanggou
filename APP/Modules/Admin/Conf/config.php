<?php

 return array(
    'TMPL_PARSE_STRING' => array(
          '__PUBLIC__' => __ROOT__ . '/' . APP_NAME . '/Modules/' .GROUP_NAME . '/Tpl/Public'
        ),
  
    //取消伪静态后缀名
    'URL_HTML_SUFFIX' =>'',
    //用户认证识别号，既用来写入session
    'USER_AUTH_KEY'  =>'uid',
    //开启调试模式
    //'SHOW_PAGE_TRACE' => true,
    //商品服务
    'goods_server'=>array(
        1=>array(
           'name'=>'假一赔十',
           'img' =>''
        ),
        2=>array(
           'name'=>'支持随时退款',
           'img' =>''
        ),
        3=>array(
           'name'=>'不支持随时退款',
           'img' =>''
        )
    ),
 
  );
?>