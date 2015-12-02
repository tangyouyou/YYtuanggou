<?php
return array(
	//'配置项'=>'配置值'

	// 配置应用分组
	'APP_GROUP_LIST' =>'Index,Admin,Member',
	'DEFAULT_GROUP'  =>'Index',
	'APP_GROUP_MODE' => 1,
	'APP_GROUP_PATH' =>'Modules',

	// 配置数据库
	'DB_TYPE' =>'mysql',
	'DB_POST' =>'3306',
	'DB_NAME' =>'tuangou',
	'DB_USER' =>'root',
	'DB_PWD'  =>'123456',
	'DB_PREFIX' =>'yy_',
	
    //支持多函数过滤
	'DEFAULT_FILTER'=>'htmlspecialchars,strip_tags',
	/********************************URL设置********************************/
    "HTTPS"                         => FALSE,       //基于https协议
    "URL_REWRITE"                   => 1,           //url重写模式
    "URL_TYPE"                      => 1,           //类型 1:PATHINFO模式 2:普通模式 3:兼容模式
    "PATHINFO_DLI"                  => "/",         //PATHINFO分隔符
    "PATHINFO_VAR"                  => "q",         //兼容模式get变量
    "PATHINFO_HTML"                 => ".html",     //伪静态扩展名
    /********************************url变量********************************/
    "VAR_APP"                       => "a",         //应用变量名，应用组模式有效
    "VAR_CONTROL"                   => "c",         //模块变量
    "VAR_METHOD"                    => "m",         //动作变量
	 /********************************分页处理********************************/
    "PAGE_VAR"                      => "page",      //分页GET变量
    "PAGE_ROW"                      => 10,          //页码数量
    "PAGE_SHOW_ROW"                 => 10,          //每页显示条数
    "PAGE_STYLE"                    => 2,           //页码风格
    "PAGE_DESC"                     => array("pre" => "上一页", "next" => "下一页",//分页文字设置
                                           "first" => "首页", "end" => "尾页", "unit" => "条"), 
    define('SITE_URL',"/YYtuangou/"),                                      
);
?>