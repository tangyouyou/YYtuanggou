<?php

	return array(
      'TMPL_PARSE_STRING' => array(
          '__PUBLIC__' => __ROOT__ . '/' . APP_NAME . '/Modules/' .GROUP_NAME . '/Tpl/Public'
      ),
	    //取消伪静态后缀名
	    'URL_HTML_SUFFIX' =>'',
      //开启调试模式
      'SHOW_PAGE_TRACE' => false,
      //用户认证识别号，既用来写入session
      'USER_AUTH_KEY'  =>'uid',
      //SESSION自动开启
      'SESSION_AUTO_START' =>true,
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
      //价格配置
      'price'=>array(
      	 'all'=>array(
            array('100元以下','0-100'),
            array('100元到200元','100-200'),
            array('200元到500元','200-500'),
            array('500元以上','500'),
         ),
         '1'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         ),
         '5'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         ),
         '6'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         ),
         '7'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         ),
         '8'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         ),
         '5'=>array(
            array('100元以下','0-100'),
            array('100元到200元','100-200'),
            array('200元到500元','200-500'),
            array('500元以上','500'),
         ),
         '11'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         ),
         '12'=>array(
            array('50元以下','0-50'),
            array('50元到100元','50-100'),
            array('100元到200元','100-200'),
            array('200元以上','200'),
         )     
      )
	);
?>