<?php

  return array( 
     'TMPL_PARSE_STRING' => array(
          '__PUBLIC__' => __ROOT__ . '/' . APP_NAME . '/Modules/' .GROUP_NAME . '/Tpl/Public'
     ),
     //取消伪静态后缀名
    'URL_HTML_SUFFIX' =>'',
    'DB_PREFIX' =>'yy_',
    //cookie生命周期,设置为三天
    'COOKIE_EXPIRE' => '259200',
    'USER_AUTH_KEY'  =>'uid',       //用户认证识别号，既用来写入session

    //session启动
    'SESSION_AUTO_START' =>true,
    //开启调试模式
    //'SHOW_PAGE_TRACE' => false,

  );
?>